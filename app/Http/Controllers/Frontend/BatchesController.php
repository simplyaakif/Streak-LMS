<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBatchRequest;
use App\Http\Requests\StoreBatchRequest;
use App\Http\Requests\UpdateBatchRequest;
use App\Models\Batch;
use App\Models\Course;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BatchesController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('batch_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batches = Batch::with(['course', 'instructors', 'media'])->get();

        return view('frontend.batches.index', compact('batches'));
    }

    public function create()
    {
        abort_if(Gate::denies('batch_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $instructors = User::all()->pluck('name', 'id');

        return view('frontend.batches.create', compact('courses', 'instructors'));
    }

    public function store(StoreBatchRequest $request)
    {
        $batch = Batch::create($request->all());
        $batch->instructors()->sync($request->input('instructors', []));

        foreach ($request->input('batch_content', []) as $file) {
            $batch->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('batch_content');
        }

        if ($request->input('batch_thumbnail', false)) {
            $batch->addMedia(storage_path('tmp/uploads/' . $request->input('batch_thumbnail')))->toMediaCollection('batch_thumbnail');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $batch->id]);
        }

        return redirect()->route('frontend.batches.index');
    }

    public function edit(Batch $batch)
    {
        abort_if(Gate::denies('batch_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $instructors = User::all()->pluck('name', 'id');

        $batch->load('course', 'instructors');

        return view('frontend.batches.edit', compact('courses', 'instructors', 'batch'));
    }

    public function update(UpdateBatchRequest $request, Batch $batch)
    {
        $batch->update($request->all());
        $batch->instructors()->sync($request->input('instructors', []));

        if (count($batch->batch_content) > 0) {
            foreach ($batch->batch_content as $media) {
                if (!in_array($media->file_name, $request->input('batch_content', []))) {
                    $media->delete();
                }
            }
        }

        $media = $batch->batch_content->pluck('file_name')->toArray();

        foreach ($request->input('batch_content', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $batch->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('batch_content');
            }
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

        return redirect()->route('frontend.batches.index');
    }

    public function show(Batch $batch)
    {
        abort_if(Gate::denies('batch_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batch->load('course', 'instructors');

        return view('frontend.batches.show', compact('batch'));
    }

    public function destroy(Batch $batch)
    {
        abort_if(Gate::denies('batch_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $batch->delete();

        return back();
    }

    public function massDestroy(MassDestroyBatchRequest $request)
    {
        Batch::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('batch_create') && Gate::denies('batch_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Batch();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
