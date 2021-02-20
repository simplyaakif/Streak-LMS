<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBatchNotificationRequest;
use App\Http\Requests\UpdateBatchNotificationRequest;
use App\Http\Resources\Admin\BatchNotificationResource;
use App\Models\BatchNotification;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BatchNotificationsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('batch_notification_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BatchNotificationResource(BatchNotification::with(['batches'])->get());
    }

    public function store(StoreBatchNotificationRequest $request)
    {
        $batchNotification = BatchNotification::create($request->all());
        $batchNotification->batches()->sync($request->input('batches', []));

        return (new BatchNotificationResource($batchNotification))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BatchNotification $batchNotification)
    {
        abort_if(Gate::denies('batch_notification_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BatchNotificationResource($batchNotification->load(['batches']));
    }

    public function update(UpdateBatchNotificationRequest $request, BatchNotification $batchNotification)
    {
        $batchNotification->update($request->all());
        $batchNotification->batches()->sync($request->input('batches', []));

        return (new BatchNotificationResource($batchNotification))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BatchNotification $batchNotification)
    {
        abort_if(Gate::denies('batch_notification_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batchNotification->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
