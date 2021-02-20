<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyQueryStatusRequest;
use App\Http\Requests\StoreQueryStatusRequest;
use App\Http\Requests\UpdateQueryStatusRequest;
use App\Models\QueryStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QueryStatusController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('query_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $queryStatuses = QueryStatus::all();

        return view('frontend.queryStatuses.index', compact('queryStatuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('query_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.queryStatuses.create');
    }

    public function store(StoreQueryStatusRequest $request)
    {
        $queryStatus = QueryStatus::create($request->all());

        return redirect()->route('frontend.query-statuses.index');
    }

    public function edit(QueryStatus $queryStatus)
    {
        abort_if(Gate::denies('query_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.queryStatuses.edit', compact('queryStatus'));
    }

    public function update(UpdateQueryStatusRequest $request, QueryStatus $queryStatus)
    {
        $queryStatus->update($request->all());

        return redirect()->route('frontend.query-statuses.index');
    }

    public function show(QueryStatus $queryStatus)
    {
        abort_if(Gate::denies('query_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.queryStatuses.show', compact('queryStatus'));
    }

    public function destroy(QueryStatus $queryStatus)
    {
        abort_if(Gate::denies('query_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $queryStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyQueryStatusRequest $request)
    {
        QueryStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
