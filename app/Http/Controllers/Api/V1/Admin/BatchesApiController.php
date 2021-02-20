<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBatchRequest;
use App\Http\Requests\UpdateBatchRequest;
use App\Http\Resources\Admin\BatchResource;
use App\Models\Batch;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BatchesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('batch_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BatchResource(Batch::with(['course', 'instructors'])->get());
    }

    public function store(StoreBatchRequest $request)
    {
        $batch = Batch::create($request->all());
        $batch->instructors()->sync($request->input('instructors', []));

        if ($request->input('batch_content', false)) {
            $batch->addMedia(storage_path('tmp/uploads/' . $request->input('batch_content')))->toMediaCollection('batch_content');
        }

        if ($request->input('batch_thumbnail', false)) {
            $batch->addMedia(storage_path('tmp/uploads/' . $request->input('batch_thumbnail')))->toMediaCollection('batch_thumbnail');
        }

        return (new BatchResource($batch))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Batch $batch)
    {
        abort_if(Gate::denies('batch_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BatchResource($batch->load(['course', 'instructors']));
    }

    public function update(UpdateBatchRequest $request, Batch $batch)
    {
        $batch->update($request->all());
        $batch->instructors()->sync($request->input('instructors', []));

        if ($request->input('batch_content', false)) {
            if (!$batch->batch_content || $request->input('batch_content') !== $batch->batch_content->file_name) {
                if ($batch->batch_content) {
                    $batch->batch_content->delete();
                }

                $batch->addMedia(storage_path('tmp/uploads/' . $request->input('batch_content')))->toMediaCollection('batch_content');
            }
        } elseif ($batch->batch_content) {
            $batch->batch_content->delete();
        }

        if ($request->input('batch_thumbnail', false)) {
            if (!$batch->batch_thumbnail || $request->input('batch_thumbnail') !== $batch->batch_thumbnail->file_name) {
                if ($batch->batch_thumbnail) {
                    $batch->batch_thumbnail->delete();
                }

                $batch->addMedia(storage_path('tmp/uploads/' . $request->input('batch_thumbnail')))->toMediaCollection('batch_thumbnail');
            }
        } elseif ($batch->batch_thumbnail) {
            $batch->batch_thumbnail->delete();
        }

        return (new BatchResource($batch))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Batch $batch)
    {
        abort_if(Gate::denies('batch_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batch->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
