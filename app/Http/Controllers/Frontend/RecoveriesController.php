<?php

namespace App\Http\Controllers\Frontend;

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

class RecoveriesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('recovery_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $recoveries = Recovery::with(['student', 'batch', 'payment_type'])->get();

        return view('frontend.recoveries.index', compact('recoveries'));
    }

    public function create()
    {
        abort_if(Gate::denies('recovery_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = Student::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $batches = Batch::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_types = PaymentType::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.recoveries.create', compact('students', 'batches', 'payment_types'));
    }

    public function store(StoreRecoveryRequest $request)
    {
        $recovery = Recovery::create($request->all());

        return redirect()->route('frontend.recoveries.index');
    }

    public function edit(Recovery $recovery)
    {
        abort_if(Gate::denies('recovery_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = Student::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $batches = Batch::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_types = PaymentType::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $recovery->load('student', 'batch', 'payment_type');

        return view('frontend.recoveries.edit', compact('students', 'batches', 'payment_types', 'recovery'));
    }

    public function update(UpdateRecoveryRequest $request, Recovery $recovery)
    {
        $recovery->update($request->all());

        return redirect()->route('frontend.recoveries.index');
    }

    public function show(Recovery $recovery)
    {
        abort_if(Gate::denies('recovery_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $recovery->load('student', 'batch', 'payment_type');

        return view('frontend.recoveries.show', compact('recovery'));
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
