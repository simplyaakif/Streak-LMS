<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRecoveryRequest;
use App\Http\Requests\StoreRecoveryRequest;
use App\Http\Requests\UpdateRecoveryRequest;
use App\Models\Batch;
use App\Models\PaymentType;
use App\Models\Recovery;
use App\Models\Student;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RecoveriesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('recovery_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Recovery::with(['student', 'batch', 'payment_type'])->select(sprintf('%s.*', (new Recovery)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'recovery_show';
                $editGate      = 'recovery_edit';
                $deleteGate    = 'recovery_delete';
                $crudRoutePart = 'recoveries';

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
            $table->addColumn('student_name', function ($row) {
                return $row->student ? $row->student->name : '';
            });

            $table->addColumn('batch_title', function ($row) {
                return $row->batch ? $row->batch->title : '';
            });

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : "";
            });
            $table->editColumn('is_paid', function ($row) {
                return $row->is_paid ? Recovery::IS_PAID_RADIO[$row->is_paid] : '';
            });

            $table->addColumn('payment_type_title', function ($row) {
                return $row->payment_type ? $row->payment_type->title : '';
            });

            $table->editColumn('reference_number', function ($row) {
                return $row->reference_number ? $row->reference_number : "";
            });
            $table->editColumn('comments', function ($row) {
                return $row->comments ? $row->comments : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'student', 'batch', 'payment_type']);

            return $table->make(true);
        }

        return view('admin.recoveries.index');
    }

    public function create()
    {
        abort_if(Gate::denies('recovery_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = Student::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $batches = Batch::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_types = PaymentType::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.recoveries.create', compact('students', 'batches', 'payment_types'));
    }

    public function store(StoreRecoveryRequest $request)
    {
        $recovery = Recovery::create($request->all());

        return redirect()->route('admin.recoveries.index');
    }

    public function edit(Recovery $recovery)
    {
        abort_if(Gate::denies('recovery_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = Student::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $batches = Batch::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_types = PaymentType::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $recovery->load('student', 'batch', 'payment_type');

        return view('admin.recoveries.edit', compact('students', 'batches', 'payment_types', 'recovery'));
    }

    public function update(UpdateRecoveryRequest $request, Recovery $recovery)
    {
        $recovery->update($request->all());

        return redirect()->route('admin.recoveries.index');
    }

    public function show(Recovery $recovery)
    {
        abort_if(Gate::denies('recovery_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $recovery->load('student', 'batch', 'payment_type');

        return view('admin.recoveries.show', compact('recovery'));
    }

    public function destroy(Recovery $recovery)
    {
        abort_if(Gate::denies('recovery_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $recovery->delete();

        return back();
    }

    public function massDestroy(MassDestroyRecoveryRequest $request)
    {
        Recovery::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
