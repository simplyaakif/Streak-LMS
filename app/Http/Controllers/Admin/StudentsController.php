<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyStudentRequest;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StudentsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('student_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Student::with(['user'])->select(sprintf('%s.*', (new Student)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'student_show';
                $editGate      = 'student_edit';
                $deleteGate    = 'student_delete';
                $crudRoutePart = 'students';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('dp', function ($row) {
                return $row->dp ? '<a href="' . $row->dp->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('father_name', function ($row) {
                return $row->father_name ? $row->father_name : "";
            });
            $table->editColumn('gender', function ($row) {
                return $row->gender ? Student::GENDER_SELECT[$row->gender] : '';
            });
            $table->editColumn('nationality', function ($row) {
                return $row->nationality ? $row->nationality : "";
            });
            $table->editColumn('place_of_birth', function ($row) {
                return $row->place_of_birth ? $row->place_of_birth : "";
            });
            $table->editColumn('first_language', function ($row) {
                return $row->first_language ? $row->first_language : "";
            });

            $table->editColumn('cnic_passport', function ($row) {
                return $row->cnic_passport ? $row->cnic_passport : "";
            });
            $table->editColumn('mobile', function ($row) {
                return $row->mobile ? $row->mobile : "";
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : "";
            });
            $table->editColumn('landline', function ($row) {
                return $row->landline ? $row->landline : "";
            });
            $table->editColumn('admission_form', function ($row) {
                if (!$row->admission_form) {
                    return '';
                }

                $links = [];

                foreach ($row->admission_form as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'dp', 'user', 'admission_form']);

            return $table->make(true);
        }

        return view('admin.students.index');
    }

    public function create()
    {
        abort_if(Gate::denies('student_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.students.create', compact('users'));
    }

    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->all());

        if ($request->input('dp', false)) {
            $student->addMedia(storage_path('tmp/uploads/' . $request->input('dp')))->toMediaCollection('dp');
        }

        foreach ($request->input('admission_form', []) as $file) {
            $student->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('admission_form');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $student->id]);
        }

        return redirect()->route('admin.students.index');
    }

    public function edit(Student $student)
    {
        abort_if(Gate::denies('student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $student->load('user');

        return view('admin.students.edit', compact('users', 'student'));
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->all());

        if ($request->input('dp', false)) {
            if (!$student->dp || $request->input('dp') !== $student->dp->file_name) {
                if ($student->dp) {
                    $student->dp->delete();
                }

                $student->addMedia(storage_path('tmp/uploads/' . $request->input('dp')))->toMediaCollection('dp');
            }
        } elseif ($student->dp) {
            $student->dp->delete();
        }

        if (count($student->admission_form) > 0) {
            foreach ($student->admission_form as $media) {
                if (!in_array($media->file_name, $request->input('admission_form', []))) {
                    $media->delete();
                }
            }
        }

        $media = $student->admission_form->pluck('file_name')->toArray();

        foreach ($request->input('admission_form', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $student->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('admission_form');
            }
        }

        return redirect()->route('admin.students.index');
    }

    public function show(Student $student)
    {
        abort_if(Gate::denies('student_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student->load('user');

        return view('admin.students.show', compact('student'));
    }

    public function destroy(Student $student)
    {
        abort_if(Gate::denies('student_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student->delete();

        return back();
    }

    public function massDestroy(MassDestroyStudentRequest $request)
    {
        Student::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('student_create') && Gate::denies('student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Student();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
