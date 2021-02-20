<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCourseMaterialRequest;
use App\Http\Requests\UpdateCourseMaterialRequest;
use App\Http\Resources\Admin\CourseMaterialResource;
use App\Models\CourseMaterial;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseMaterialApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('course_material_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourseMaterialResource(CourseMaterial::with(['course', 'batches'])->get());
    }

    public function store(StoreCourseMaterialRequest $request)
    {
        $courseMaterial = CourseMaterial::create($request->all());
        $courseMaterial->batches()->sync($request->input('batches', []));

        if ($request->input('content', false)) {
            $courseMaterial->addMedia(storage_path('tmp/uploads/' . $request->input('content')))->toMediaCollection('content');
        }

        return (new CourseMaterialResource($courseMaterial))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CourseMaterial $courseMaterial)
    {
        abort_if(Gate::denies('course_material_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourseMaterialResource($courseMaterial->load(['course', 'batches']));
    }

    public function update(UpdateCourseMaterialRequest $request, CourseMaterial $courseMaterial)
    {
        $courseMaterial->update($request->all());
        $courseMaterial->batches()->sync($request->input('batches', []));

        if ($request->input('content', false)) {
            if (!$courseMaterial->content || $request->input('content') !== $courseMaterial->content->file_name) {
                if ($courseMaterial->content) {
                    $courseMaterial->content->delete();
                }

                $courseMaterial->addMedia(storage_path('tmp/uploads/' . $request->input('content')))->toMediaCollection('content');
            }
        } elseif ($courseMaterial->content) {
            $courseMaterial->content->delete();
        }

        return (new CourseMaterialResource($courseMaterial))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CourseMaterial $courseMaterial)
    {
        abort_if(Gate::denies('course_material_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseMaterial->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
