<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCertificateRequest;
use App\Http\Requests\StoreCertificateRequest;
use App\Http\Requests\UpdateCertificateRequest;
use App\Models\Batch;
use App\Models\Certificate;
use App\Models\Student;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CertificateController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('certificate_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Certificate::with(['student', 'course_batch_session'])->select(sprintf('%s.*', (new Certificate)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'certificate_show';
                $editGate      = 'certificate_edit';
                $deleteGate    = 'certificate_delete';
                $crudRoutePart = 'certificates';

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
            $table->editColumn('certificate_number', function ($row) {
                return $row->certificate_number ? $row->certificate_number : "";
            });
            $table->addColumn('student_name', function ($row) {
                return $row->student ? $row->student->name : '';
            });

            $table->addColumn('course_batch_session_title', function ($row) {
                return $row->course_batch_session ? $row->course_batch_session->title : '';
            });

            $table->editColumn('grade', function ($row) {
                return $row->grade ? $row->grade : "";
            });
            $table->editColumn('comment', function ($row) {
                return $row->comment ? $row->comment : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'student', 'course_batch_session']);

            return $table->make(true);
        }

        return view('admin.certificates.index');
    }

    public function create()
    {
        abort_if(Gate::denies('certificate_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = Student::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $course_batch_sessions = Batch::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.certificates.create', compact('students', 'course_batch_sessions'));
    }

    public function store(StoreCertificateRequest $request)
    {
        $certificate = Certificate::create($request->all());

        return redirect()->route('admin.certificates.index');
    }

    public function edit(Certificate $certificate)
    {
        abort_if(Gate::denies('certificate_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = Student::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $course_batch_sessions = Batch::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $certificate->load('student', 'course_batch_session');

        return view('admin.certificates.edit', compact('students', 'course_batch_sessions', 'certificate'));
    }

    public function update(UpdateCertificateRequest $request, Certificate $certificate)
    {
        $certificate->update($request->all());

        return redirect()->route('admin.certificates.index');
    }

    public function show(Certificate $certificate)
    {
        abort_if(Gate::denies('certificate_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $certificate->load('student', 'course_batch_session');

        return view('admin.certificates.show', compact('certificate'));
    }

    public function destroy(Certificate $certificate)
    {
        abort_if(Gate::denies('certificate_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $certificate->delete();

        return back();
    }

    public function massDestroy(MassDestroyCertificateRequest $request)
    {
        Certificate::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
