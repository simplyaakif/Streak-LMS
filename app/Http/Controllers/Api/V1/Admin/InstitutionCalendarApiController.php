<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInstitutionCalendarRequest;
use App\Http\Requests\UpdateInstitutionCalendarRequest;
use App\Http\Resources\Admin\InstitutionCalendarResource;
use App\Models\InstitutionCalendar;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstitutionCalendarApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('institution_calendar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InstitutionCalendarResource(InstitutionCalendar::all());
    }

    public function store(StoreInstitutionCalendarRequest $request)
    {
        $institutionCalendar = InstitutionCalendar::create($request->all());

        return (new InstitutionCalendarResource($institutionCalendar))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(InstitutionCalendar $institutionCalendar)
    {
        abort_if(Gate::denies('institution_calendar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InstitutionCalendarResource($institutionCalendar);
    }

    public function update(UpdateInstitutionCalendarRequest $request, InstitutionCalendar $institutionCalendar)
    {
        $institutionCalendar->update($request->all());

        return (new InstitutionCalendarResource($institutionCalendar))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(InstitutionCalendar $institutionCalendar)
    {
        abort_if(Gate::denies('institution_calendar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutionCalendar->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
