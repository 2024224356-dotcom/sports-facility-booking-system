<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\OperatingHour;
use Illuminate\Http\Request;

class OperatingHourController extends Controller
{
    public function index()
    {
        $hours = OperatingHour::with('facility')->latest()->get();

        return view('operating-hours.index', compact('hours'));
    }

    public function create()
    {
        $facilities = Facility::orderBy('facility_name')->get();

        return view('operating-hours.create', compact('facilities'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'facility_id'=>'required',

            'day_of_week'=>'required',

            'open_time'=>'required',

            'close_time'=>'required'

        ]);

        OperatingHour::create($request->all());

        return redirect()
            ->route('operating-hours.index')
            ->with('success','Operating hour added successfully.');
    }

    public function edit(OperatingHour $operatingHour)
    {
        $facilities = Facility::orderBy('facility_name')->get();

        return view('operating-hours.edit', compact('operatingHour','facilities'));
    }

    public function update(Request $request, OperatingHour $operatingHour)
    {
        $request->validate([

            'facility_id'=>'required',

            'day_of_week'=>'required',

            'open_time'=>'required',

            'close_time'=>'required'

        ]);

        $operatingHour->update($request->all());

        return redirect()
            ->route('operating-hours.index')
            ->with('success','Operating hour updated successfully.');
    }

    public function destroy(OperatingHour $operatingHour)
    {
        $operatingHour->delete();

        return redirect()
            ->route('operating-hours.index')
            ->with('success','Operating hour deleted successfully.');
    }
}