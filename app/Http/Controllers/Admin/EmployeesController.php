<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEmployeeRequest;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EmployeesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('employee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Employee::with(['user'])->select(sprintf('%s.*', (new Employee)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'employee_show';
                $editGate      = 'employee_edit';
                $deleteGate    = 'employee_delete';
                $crudRoutePart = 'employees';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('dp', function ($row) {
                if ($photo = $row->dp) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('mobile', function ($row) {
                return $row->mobile ? $row->mobile : "";
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : "";
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : "";
            });
            $table->editColumn('city', function ($row) {
                return $row->city ? $row->city : "";
            });

            $table->editColumn('gender', function ($row) {
                return $row->gender ? Employee::GENDER_SELECT[$row->gender] : '';
            });
            $table->editColumn('marital_status', function ($row) {
                return $row->marital_status ? Employee::MARITAL_STATUS_SELECT[$row->marital_status] : '';
            });
            $table->editColumn('job_title', function ($row) {
                return $row->job_title ? $row->job_title : "";
            });
            $table->editColumn('cnic_passport', function ($row) {
                return $row->cnic_passport ? $row->cnic_passport : "";
            });
            $table->editColumn('qualification', function ($row) {
                return $row->qualification ? $row->qualification : "";
            });
            $table->editColumn('experience', function ($row) {
                return $row->experience ? $row->experience : "";
            });
            $table->editColumn('relegion', function ($row) {
                return $row->relegion ? $row->relegion : "";
            });
            $table->editColumn('documents_cv_experience', function ($row) {
                if (!$row->documents_cv_experience) {
                    return '';
                }

                $links = [];

                foreach ($row->documents_cv_experience as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->editColumn('earning_type', function ($row) {
                return $row->earning_type ? Employee::EARNING_TYPE_SELECT[$row->earning_type] : '';
            });
            $table->editColumn('basic_salary', function ($row) {
                return $row->basic_salary ? $row->basic_salary : "";
            });
            $table->editColumn('medical', function ($row) {
                return $row->medical ? $row->medical : "";
            });
            $table->editColumn('conveyance', function ($row) {
                return $row->conveyance ? $row->conveyance : "";
            });
            $table->editColumn('deduction_leave', function ($row) {
                return $row->deduction_leave ? $row->deduction_leave : "";
            });
            $table->editColumn('deduction_loan', function ($row) {
                return $row->deduction_loan ? $row->deduction_loan : "";
            });
            $table->editColumn('deduction_tax', function ($row) {
                return $row->deduction_tax ? $row->deduction_tax : "";
            });
            $table->editColumn('deduction_other', function ($row) {
                return $row->deduction_other ? $row->deduction_other : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'dp', 'user', 'documents_cv_experience']);

            return $table->make(true);
        }

        return view('admin.employees.index');
    }

    public function create()
    {
        abort_if(Gate::denies('employee_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.employees.create', compact('users'));
    }

    public function store(StoreEmployeeRequest $request)
    {
        $employee = Employee::create($request->all());

        if ($request->input('dp', false)) {
            $employee->addMedia(storage_path('tmp/uploads/' . $request->input('dp')))->toMediaCollection('dp');
        }

        foreach ($request->input('documents_cv_experience', []) as $file) {
            $employee->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('documents_cv_experience');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $employee->id]);
        }

        return redirect()->route('admin.employees.index');
    }

    public function edit(Employee $employee)
    {
        abort_if(Gate::denies('employee_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employee->load('user');

        return view('admin.employees.edit', compact('users', 'employee'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->all());

        if ($request->input('dp', false)) {
            if (!$employee->dp || $request->input('dp') !== $employee->dp->file_name) {
                if ($employee->dp) {
                    $employee->dp->delete();
                }

                $employee->addMedia(storage_path('tmp/uploads/' . $request->input('dp')))->toMediaCollection('dp');
            }
        } elseif ($employee->dp) {
            $employee->dp->delete();
        }

        if (count($employee->documents_cv_experience) > 0) {
            foreach ($employee->documents_cv_experience as $media) {
                if (!in_array($media->file_name, $request->input('documents_cv_experience', []))) {
                    $media->delete();
                }
            }
        }

        $media = $employee->documents_cv_experience->pluck('file_name')->toArray();

        foreach ($request->input('documents_cv_experience', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $employee->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('documents_cv_experience');
            }
        }

        return redirect()->route('admin.employees.index');
    }

    public function show(Employee $employee)
    {
        abort_if(Gate::denies('employee_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employee->load('user');

        return view('admin.employees.show', compact('employee'));
    }

    public function destroy(Employee $employee)
    {
        abort_if(Gate::denies('employee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employee->delete();

        return back();
    }

    public function massDestroy(MassDestroyEmployeeRequest $request)
    {
        Employee::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('employee_create') && Gate::denies('employee_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Employee();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
