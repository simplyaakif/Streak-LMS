<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyInstitutionCalendarRequest;
use App\Http\Requests\StoreInstitutionCalendarRequest;
use App\Http\Requests\UpdateInstitutionCalendarRequest;
use App\Models\InstitutionCalendar;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstitutionCalendarController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('institution_calendar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutionCalendars = InstitutionCalendar::all();

        return view('frontend.institutionCalendars.index', compact('institutionCalendars'));
    }

    public function create()
    {
        abort_if(Gate::denies('institution_calendar_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.institutionCalendars.create');
    }

    public function store(StoreInstitutionCalendarRequest $request)
    {
        $institutionCalendar = InstitutionCalendar::create($request->all());

        return redirect()->route('frontend.institution-calendars.index');
    }

    public function edit(InstitutionCalendar $institutionCalendar)
    {
        abort_if(Gate::denies('institution_calendar_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.institutionCalendars.edit', compact('institutionCalendar'));
    }

    public function update(UpdateInstitutionCalendarRequest $request, InstitutionCalendar $institutionCalendar)
    {
        $institutionCalendar->update($request->all());

        return redirect()->route('frontend.institution-calendars.index');
    }

    public function show(InstitutionCalendar $institutionCalendar)
    {
        abort_if(Gate::denies('institution_calendar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.institutionCalendars.show', compact('institutionCalendar'));
    }

    public function destroy(InstitutionCalendar $institutionCalendar)
    {
        abort_if(Gate::denies('institution_calendar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutionCalendar->delete();

        return back();
    }

    public function massDestroy(MassDestroyInstitutionCalendarRequest $request)
    {
        InstitutionCalendar::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
