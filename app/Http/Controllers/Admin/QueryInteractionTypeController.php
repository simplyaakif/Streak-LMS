<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyQueryInteractionTypeRequest;
use App\Http\Requests\StoreQueryInteractionTypeRequest;
use App\Http\Requests\UpdateQueryInteractionTypeRequest;
use App\Models\QueryInteractionType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QueryInteractionTypeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('query_interaction_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $queryInteractionTypes = QueryInteractionType::all();

        return view('admin.queryInteractionTypes.index', compact('queryInteractionTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('query_interaction_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.queryInteractionTypes.create');
    }

    public function store(StoreQueryInteractionTypeRequest $request)
    {
        $queryInteractionType = QueryInteractionType::create($request->all());

        return redirect()->route('admin.query-interaction-types.index');
    }

    public function edit(QueryInteractionType $queryInteractionType)
    {
        abort_if(Gate::denies('query_interaction_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.queryInteractionTypes.edit', compact('queryInteractionType'));
    }

    public function update(UpdateQueryInteractionTypeRequest $request, QueryInteractionType $queryInteractionType)
    {
        $queryInteractionType->update($request->all());

        return redirect()->route('admin.query-interaction-types.index');
    }

    public function show(QueryInteractionType $queryInteractionType)
    {
        abort_if(Gate::denies('query_interaction_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.queryInteractionTypes.show', compact('queryInteractionType'));
    }

    public function destroy(QueryInteractionType $queryInteractionType)
    {
        abort_if(Gate::denies('query_interaction_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $queryInteractionType->delete();

        return back();
    }

    public function massDestroy(MassDestroyQueryInteractionTypeRequest $request)
    {
        QueryInteractionType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
