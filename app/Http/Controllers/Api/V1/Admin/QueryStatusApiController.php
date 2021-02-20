<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQueryStatusRequest;
use App\Http\Requests\UpdateQueryStatusRequest;
use App\Http\Resources\Admin\QueryStatusResource;
use App\Models\QueryStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QueryStatusApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('query_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new QueryStatusResource(QueryStatus::all());
    }

    public function store(StoreQueryStatusRequest $request)
    {
        $queryStatus = QueryStatus::create($request->all());

        return (new QueryStatusResource($queryStatus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(QueryStatus $queryStatus)
    {
        abort_if(Gate::denies('query_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new QueryStatusResource($queryStatus);
    }

    public function update(UpdateQueryStatusRequest $request, QueryStatus $queryStatus)
    {
        $queryStatus->update($request->all());

        return (new QueryStatusResource($queryStatus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(QueryStatus $queryStatus)
    {
        abort_if(Gate::denies('query_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $queryStatus->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
