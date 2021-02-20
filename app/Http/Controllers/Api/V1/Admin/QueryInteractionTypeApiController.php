<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQueryInteractionTypeRequest;
use App\Http\Requests\UpdateQueryInteractionTypeRequest;
use App\Http\Resources\Admin\QueryInteractionTypeResource;
use App\Models\QueryInteractionType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QueryInteractionTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('query_interaction_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new QueryInteractionTypeResource(QueryInteractionType::all());
    }

    public function store(StoreQueryInteractionTypeRequest $request)
    {
        $queryInteractionType = QueryInteractionType::create($request->all());

        return (new QueryInteractionTypeResource($queryInteractionType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(QueryInteractionType $queryInteractionType)
    {
        abort_if(Gate::denies('query_interaction_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new QueryInteractionTypeResource($queryInteractionType);
    }

    public function update(UpdateQueryInteractionTypeRequest $request, QueryInteractionType $queryInteractionType)
    {
        $queryInteractionType->update($request->all());

        return (new QueryInteractionTypeResource($queryInteractionType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(QueryInteractionType $queryInteractionType)
    {
        abort_if(Gate::denies('query_interaction_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $queryInteractionType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
