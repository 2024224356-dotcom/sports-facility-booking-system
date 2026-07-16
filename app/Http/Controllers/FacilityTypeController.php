<?php

namespace App\Http\Controllers;

use App\Models\FacilityType;
use Illuminate\Http\Request;

class FacilityTypeController extends Controller
{
    public function index()
    {
        $types = FacilityType::latest()->get();

        return view('facility-types.index', compact('types'));
    }

    public function create()
    {
        return view('facility-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_name' => 'required|unique:facility_types,type_name',
            'description' => 'nullable'
        ]);

        FacilityType::create($request->all());

        return redirect()
            ->route('facility-types.index')
            ->with('success','Facility Type added successfully.');
    }

    public function edit(FacilityType $facilityType)
    {
        return view('facility-types.edit', compact('facilityType'));
    }

    public function update(Request $request, FacilityType $facilityType)
    {
        $request->validate([
            'type_name'=>'required|unique:facility_types,type_name,'.$facilityType->id,
            'description'=>'nullable'
        ]);

        $facilityType->update($request->all());

        return redirect()
            ->route('facility-types.index')
            ->with('success','Facility Type updated successfully.');
    }

    public function destroy(FacilityType $facilityType)
    {
        $facilityType->delete();

        return redirect()
            ->route('facility-types.index')
            ->with('success','Facility Type deleted successfully.');
    }
}