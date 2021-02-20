<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCourseMaterialRequest;
use App\Http\Requests\StoreCourseMaterialRequest;
use App\Http\Requests\UpdateCourseMaterialRequest;
use App\Models\Batch;
use App\Models\Course;
use App\Models\CourseMaterial;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CourseMaterialController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('course_material_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CourseMaterial::with(['course', 'batches'])->select(sprintf('%s.*', (new CourseMaterial)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'course_material_show';
                $editGate      = 'course_material_edit';
                $deleteGate    = 'course_material_delete';
                $crudRoutePart = 'course-materials';

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
            $table->addColumn('course_title', function ($row) {
                return $row->course ? $row->course->title : '';
            });

            $table->editColumn('batch', function ($row) {
                $labels = [];

                foreach ($row->batches as $batch) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $batch->title);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('chapter_number', function ($row) {
                return $row->chapter_number ? $row->chapter_number : "";
            });
            $table->editColumn('chapter_name', function ($row) {
                return $row->chapter_name ? $row->chapter_name : "";
            });
            $table->editColumn('content', function ($row) {
                if (!$row->content) {
                    return '';
                }

                $links = [];

                foreach ($row->content as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->editColumn('position', function ($row) {
                return $row->position ? $row->position : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'course', 'batch', 'content']);

            return $table->make(true);
        }

        return view('admin.courseMaterials.index');
    }

    public function create()
    {
        abort_if(Gate::denies('course_material_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $batches = Batch::all()->pluck('title', 'id');

        return view('admin.courseMaterials.create', compact('courses', 'batches'));
    }

    public function store(StoreCourseMaterialRequest $request)
    {
        $courseMaterial = CourseMaterial::create($request->all());
        $courseMaterial->batches()->sync($request->input('batches', []));

        foreach ($request->input('content', []) as $file) {
            $courseMaterial->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('content');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $courseMaterial->id]);
        }

        return redirect()->route('admin.course-materials.index');
    }

    public function edit(CourseMaterial $courseMaterial)
    {
        abort_if(Gate::denies('course_material_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $batches = Batch::all()->pluck('title', 'id');

        $courseMaterial->load('course', 'batches');

        return view('admin.courseMaterials.edit', compact('courses', 'batches', 'courseMaterial'));
    }

    public function update(UpdateCourseMaterialRequest $request, CourseMaterial $courseMaterial)
    {
        $courseMaterial->update($request->all());
        $courseMaterial->batches()->sync($request->input('batches', []));

        if (count($courseMaterial->content) > 0) {
            foreach ($courseMaterial->content as $media) {
                if (!in_array($media->file_name, $request->input('content', []))) {
                    $media->delete();
                }
            }
        }

        $media = $courseMaterial->content->pluck('file_name')->toArray();

        foreach ($request->input('content', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $courseMaterial->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('content');
            }
        }

        return redirect()->route('admin.course-materials.index');
    }

    public function show(CourseMaterial $courseMaterial)
    {
        abort_if(Gate::denies('course_material_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseMaterial->load('course', 'batches');

        return view('admin.courseMaterials.show', compact('courseMaterial'));
    }

    public function destroy(CourseMaterial $courseMaterial)
    {
        abort_if(Gate::denies('course_material_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseMaterial->delete();

        return back();
    }

    public function massDestroy(MassDestroyCourseMaterialRequest $request)
    {
        CourseMaterial::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('course_material_create') && Gate::denies('course_material_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new CourseMaterial();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
