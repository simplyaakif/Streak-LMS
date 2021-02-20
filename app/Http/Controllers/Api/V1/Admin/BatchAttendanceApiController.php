<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBatchAttendanceRequest;
use App\Http\Requests\UpdateBatchAttendanceRequest;
use App\Http\Resources\Admin\BatchAttendanceResource;
use App\Models\BatchAttendance;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BatchAttendanceApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('batch_attendance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BatchAttendanceResource(BatchAttendance::with(['batch', 'students'])->get());
    }

    public function store(StoreBatchAttendanceRequest $request)
    {
        $batchAttendance = BatchAttendance::create($request->all());
        $batchAttendance->students()->sync($request->input('students', []));

        return (new BatchAttendanceResource($batchAttendance))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BatchAttendance $batchAttendance)
    {
        abort_if(Gate::denies('batch_attendance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BatchAttendanceResource($batchAttendance->load(['batch', 'students']));
    }

    public function update(UpdateBatchAttendanceRequest $request, BatchAttendance $batchAttendance)
    {
        $batchAttendance->update($request->all());
        $batchAttendance->students()->sync($request->input('students', []));

        return (new BatchAttendanceResource($batchAttendance))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BatchAttendance $batchAttendance)
    {
        abort_if(Gate::denies('batch_attendance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batchAttendance->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
