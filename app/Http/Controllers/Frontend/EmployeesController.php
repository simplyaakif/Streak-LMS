<?php

namespace App\Http\Controllers\Frontend;

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

class EmployeesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('employee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::with(['user', 'media'])->get();

        return view('frontend.employees.index', compact('employees'));
    }

    public function create()
    {
        abort_if(Gate::denies('employee_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.employees.create', compact('users'));
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

        return redirect()->route('frontend.employees.index');
    }

    public function edit(Employee $employee)
    {
        abort_if(Gate::denies('employee_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employee->load('user');

        return view('frontend.employees.edit', compact('users', 'employee'));
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

        return redirect()->route('frontend.employees.index');
    }

    public function show(Employee $employee)
    {
        abort_if(Gate::denies('employee_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employee->load('user');

        return view('frontend.employees.show', compact('employee'));
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
