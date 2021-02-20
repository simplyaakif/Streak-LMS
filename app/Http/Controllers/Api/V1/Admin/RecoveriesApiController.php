<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRecoveryRequest;
use App\Http\Requests\UpdateRecoveryRequest;
use App\Http\Resources\Admin\RecoveryResource;
use App\Models\Recovery;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RecoveriesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('recovery_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RecoveryResource(Recovery::with(['student', 'batch', 'payment_type'])->get());
    }

    public function store(StoreRecoveryRequest $request)
    {
        $recovery = Recovery::create($request->all());

        return (new RecoveryResource($recovery))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Recovery $recovery)
    {
        abort_if(Gate::denies('recovery_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RecoveryResource($recovery->load(['student', 'batch', 'payment_type']));
    }

    public function update(UpdateRecoveryRequest $request, Recovery $recovery)
    {
        $recovery->update($request->all());

        return (new RecoveryResource($recovery))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Recovery $recovery)
    {
        abort_if(Gate::denies('recovery_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $recovery->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
