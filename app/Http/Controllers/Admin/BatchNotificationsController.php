<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBatchNotificationRequest;
use App\Http\Requests\StoreBatchNotificationRequest;
use App\Http\Requests\UpdateBatchNotificationRequest;
use App\Models\Batch;
use App\Models\BatchNotification;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BatchNotificationsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('batch_notification_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batchNotifications = BatchNotification::with(['batches'])->get();

        return view('admin.batchNotifications.index', compact('batchNotifications'));
    }

    public function create()
    {
        abort_if(Gate::denies('batch_notification_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batches = Batch::all()->pluck('title', 'id');

        return view('admin.batchNotifications.create', compact('batches'));
    }

    public function store(StoreBatchNotificationRequest $request)
    {
        $batchNotification = BatchNotification::create($request->all());
        $batchNotification->batches()->sync($request->input('batches', []));

        return redirect()->route('admin.batch-notifications.index');
    }

    public function edit(BatchNotification $batchNotification)
    {
        abort_if(Gate::denies('batch_notification_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batches = Batch::all()->pluck('title', 'id');

        $batchNotification->load('batches');

        return view('admin.batchNotifications.edit', compact('batches', 'batchNotification'));
    }

    public function update(UpdateBatchNotificationRequest $request, BatchNotification $batchNotification)
    {
        $batchNotification->update($request->all());
        $batchNotification->batches()->sync($request->input('batches', []));

        return redirect()->route('admin.batch-notifications.index');
    }

    public function show(BatchNotification $batchNotification)
    {
        abort_if(Gate::denies('batch_notification_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batchNotification->load('batches');

        return view('admin.batchNotifications.show', compact('batchNotification'));
    }

    public function destroy(BatchNotification $batchNotification)
    {
        abort_if(Gate::denies('batch_notification_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batchNotification->delete();

        return back();
    }

    public function massDestroy(MassDestroyBatchNotificationRequest $request)
    {
        BatchNotification::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
