<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyInstitutionCalendarRequest;
use App\Http\Requests\StoreInstitutionCalendarRequest;
use App\Http\Requests\UpdateInstitutionCalendarRequest;
use App\Models\InstitutionCalendar;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class InstitutionCalendarController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('institution_calendar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = InstitutionCalendar::query()->select(sprintf('%s.*', (new InstitutionCalendar)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'institution_calendar_show';
                $editGate      = 'institution_calendar_edit';
                $deleteGate    = 'institution_calendar_delete';
                $crudRoutePart = 'institution-calendars';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : "";
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.institutionCalendars.index');
    }

    public function create()
    {
        abort_if(Gate::denies('institution_calendar_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.institutionCalendars.create');
    }

    public function store(StoreInstitutionCalendarRequest $request)
    {
        $institutionCalendar = InstitutionCalendar::create($request->all());

        return redirect()->route('admin.institution-calendars.index');
    }

    public function edit(InstitutionCalendar $institutionCalendar)
    {
        abort_if(Gate::denies('institution_calendar_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.institutionCalendars.edit', compact('institutionCalendar'));
    }

    public function update(UpdateInstitutionCalendarRequest $request, InstitutionCalendar $institutionCalendar)
    {
        $institutionCalendar->update($request->all());

        return redirect()->route('admin.institution-calendars.index');
    }

    public function show(InstitutionCalendar $institutionCalendar)
    {
        abort_if(Gate::denies('institution_calendar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.institutionCalendars.show', compact('institutionCalendar'));
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
