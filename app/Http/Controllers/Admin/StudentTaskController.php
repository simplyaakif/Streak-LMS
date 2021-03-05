<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyStudentTaskRequest;
use App\Http\Requests\StoreStudentTaskRequest;
use App\Http\Requests\UpdateStudentTaskRequest;
use App\Models\BatchStudent;
use App\Models\Employee;
use App\Models\StudentTask;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StudentTaskController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('student_task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = StudentTask::with(['assigned_by', 'students'])->select(sprintf('%s.*', (new StudentTask)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'student_task_show';
                $editGate      = 'student_task_edit';
                $deleteGate    = 'student_task_delete';
                $crudRoutePart = 'student-tasks';

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
            $table->editColumn('task', function ($row) {
                return $row->task ? $row->task : "";
            });
            $table->editColumn('files', function ($row) {
                if (!$row->files) {
                    return '';
                }

                $links = [];

                foreach ($row->files as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->addColumn('assigned_by_name', function ($row) {
                return $row->assigned_by ? $row->assigned_by->name : '';
            });

            $table->editColumn('students', function ($row) {
                $labels = [];

                foreach ($row->students as $student) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $student->sessions_start_date);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'files', 'assigned_by', 'students']);

            return $table->make(true);
        }

        return view('admin.studentTasks.index');
    }

    public function create()
    {
        abort_if(Gate::denies('student_task_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assigned_bies = Employee::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = BatchStudent::all()->pluck('sessions_start_date', 'id');

        return view('admin.studentTasks.create', compact('assigned_bies', 'students'));
    }

    public function store(StoreStudentTaskRequest $request)
    {
        $studentTask = StudentTask::create($request->all());
        $studentTask->students()->sync($request->input('students', []));

        foreach ($request->input('files', []) as $file) {
            $studentTask->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('files');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $studentTask->id]);
        }

        return redirect()->route('admin.student-tasks.index');
    }

    public function edit(StudentTask $studentTask)
    {
        abort_if(Gate::denies('student_task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assigned_bies = Employee::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = BatchStudent::all()->pluck('sessions_start_date', 'id');

        $studentTask->load('assigned_by', 'students');

        return view('admin.studentTasks.edit', compact('assigned_bies', 'students', 'studentTask'));
    }

    public function update(UpdateStudentTaskRequest $request, StudentTask $studentTask)
    {
        $studentTask->update($request->all());
        $studentTask->students()->sync($request->input('students', []));

        if (count($studentTask->files) > 0) {
            foreach ($studentTask->files as $media) {
                if (!in_array($media->file_name, $request->input('files', []))) {
                    $media->delete();
                }
            }
        }

        $media = $studentTask->files->pluck('file_name')->toArray();

        foreach ($request->input('files', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $studentTask->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('files');
            }
        }

        return redirect()->route('admin.student-tasks.index');
    }

    public function show(StudentTask $studentTask)
    {
        abort_if(Gate::denies('student_task_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentTask->load('assigned_by', 'students');

        return view('admin.studentTasks.show', compact('studentTask'));
    }

    public function destroy(StudentTask $studentTask)
    {
        abort_if(Gate::denies('student_task_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentTask->delete();

        return back();
    }

    public function massDestroy(MassDestroyStudentTaskRequest $request)
    {
        StudentTask::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('student_task_create') && Gate::denies('student_task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new StudentTask();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
