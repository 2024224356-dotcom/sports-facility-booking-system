<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\FacilityType;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::with('facilityType')->get();
        return view('facilities.index', compact('facilities'));
    }

    public function create()
    {
        $facilityTypes = FacilityType::all();
        return view('facilities.create', compact('facilityTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'facility_name' => 'required',
            'facility_type_id' => 'required',
            'availability_status' => 'required',
        ]);

        Facility::create($request->all());

        return redirect()->route('facilities.index')
            ->with('success', 'Facility added successfully.');
    }

    public function edit(Facility $facility)
    {
        $facilityTypes = FacilityType::all();

        return view('facilities.edit', compact('facility', 'facilityTypes'));
    }

    public function update(Request $request, Facility $facility)
    {
        $request->validate([
            'facility_name' => 'required',
            'facility_type_id' => 'required',
            'availability_status' => 'required',
        ]);

        $facility->update($request->all());

        return redirect()->route('facilities.index')
            ->with('success', 'Facility updated successfully.');
    }

    public function destroy(Facility $facility)
    {
        $facility->delete();

        return redirect()->route('facilities.index')
            ->with('success', 'Facility deleted successfully.');
    }
}