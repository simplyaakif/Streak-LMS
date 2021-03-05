<?php

namespace App\Http\Controllers\Frontend;

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

class QueriesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('query_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $queries = Query::with(['courses', 'dealt_by', 'interaction_type', 'status'])->get();

        return view('frontend.queries.index', compact('queries'));
    }

    public function create()
    {
        abort_if(Gate::denies('query_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::all()->pluck('title', 'id');

        $dealt_bies = Employee::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $interaction_types = QueryInteractionType::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = QueryStatus::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.queries.create', compact('courses', 'dealt_bies', 'interaction_types', 'statuses'));
    }

    public function store(StoreQueryRequest $request)
    {
        $query = Query::create($request->all());
        $query->courses()->sync($request->input('courses', []));

        return redirect()->route('frontend.queries.index');
    }

    public function edit(Query $query)
    {
        abort_if(Gate::denies('query_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::all()->pluck('title', 'id');

        $dealt_bies = Employee::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $interaction_types = QueryInteractionType::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = QueryStatus::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $query->load('courses', 'dealt_by', 'interaction_type', 'status');

        return view('frontend.queries.edit', compact('courses', 'dealt_bies', 'interaction_types', 'statuses', 'query'));
    }

    public function update(UpdateQueryRequest $request, Query $query)
    {
        $query->update($request->all());
        $query->courses()->sync($request->input('courses', []));

        return redirect()->route('frontend.queries.index');
    }

    public function show(Query $query)
    {
        abort_if(Gate::denies('query_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $query->load('courses', 'dealt_by', 'interaction_type', 'status');

        return view('frontend.queries.show', compact('query'));
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
