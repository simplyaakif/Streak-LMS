<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyQueryRequest;
use App\Http\Requests\StoreQueryRequest;
use App\Http\Requests\UpdateQueryRequest;
use App\Models\Course;
use App\Models\Employee;
use App\Models\Query;
use App\Models\QueryInteractionType;
use App\Models\QueryStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class QueriesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('query_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Query::with(['courses', 'dealt_by', 'interaction_type', 'status'])->select(sprintf('%s.*', (new Query)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'query_show';
                $editGate      = 'query_edit';
                $deleteGate    = 'query_delete';
                $crudRoutePart = 'queries';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('mobile_number', function ($row) {
                return $row->mobile_number ? $row->mobile_number : "";
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : "";
            });
            $table->editColumn('courses', function ($row) {
                $labels = [];

                foreach ($row->courses as $course) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $course->title);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('dealt_by_name', function ($row) {
                return $row->dealt_by ? $row->dealt_by->name : '';
            });

            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : "";
            });
            $table->editColumn('comments_remarks', function ($row) {
                return $row->comments_remarks ? $row->comments_remarks : "";
            });
            $table->addColumn('interaction_type_title', function ($row) {
                return $row->interaction_type ? $row->interaction_type->title : '';
            });

            $table->addColumn('status_title', function ($row) {
                return $row->status ? $row->status->title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'courses', 'dealt_by', 'interaction_type', 'status']);

            return $table->make(true);
        }

        return view('admin.queries.index');
    }

    public function create()
    {
        abort_if(Gate::denies('query_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::all()->pluck('title', 'id');

        $dealt_bies = Employee::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $interaction_types = QueryInteractionType::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = QueryStatus::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.queries.create', compact('courses', 'dealt_bies', 'interaction_types', 'statuses'));
    }

    public function store(StoreQueryRequest $request)
    {
//        dd($request->all());

        $query = Query::create($request->all());
        $query->courses()->sync($request->input('courses', []));

        return redirect()->route('admin.queries.index');
    }

    public function edit(Query $query)
    {
        abort_if(Gate::denies('query_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::all()->pluck('title', 'id');

        $dealt_bies = Employee::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $interaction_types = QueryInteractionType::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = QueryStatus::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $query->load('courses', 'dealt_by', 'interaction_type', 'status');

        return view('admin.queries.edit', compact('courses', 'dealt_bies', 'interaction_types', 'statuses', 'query'));
    }

    public function update(UpdateQueryRequest $request, Query $query)
    {
        $query->update($request->all());
        $query->courses()->sync($request->input('courses', []));

        return redirect()->route('admin.queries.index');
    }

    public function show(Query $query)
    {
        abort_if(Gate::denies('query_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $query->load('courses', 'dealt_by', 'interaction_type', 'status');

        return view('admin.queries.show', compact('query'));
    }

    public function destroy(Query $query)
    {
        abort_if(Gate::denies('query_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $query->delete();

        return back();
    }

    public function massDestroy(MassDestroyQueryRequest $request)
    {
        Query::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
