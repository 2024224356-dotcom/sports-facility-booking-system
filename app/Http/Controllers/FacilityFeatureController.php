<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\FacilityFeature;
use Illuminate\Http\Request;

class FacilityFeatureController extends Controller
{
    public function index()
    {
        $features = FacilityFeature::with('facility')->latest()->get();

        return view('facility-features.index', compact('features'));
    }

    public function create()
    {
        $facilities = Facility::orderBy('facility_name')->get();

        return view('facility-features.create', compact('facilities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'facility_id' => 'required',
            'feature_name' => 'required',
            'description' => 'nullable'
        ]);

        FacilityFeature::create($request->all());

        return redirect()
            ->route('facility-features.index')
            ->with('success','Feature added successfully.');
    }

    public function edit(FacilityFeature $facilityFeature)
    {
        $facilities = Facility::orderBy('facility_name')->get();

        return view('facility-features.edit',
            compact('facilityFeature','facilities'));
    }

    public function update(Request $request, FacilityFeature $facilityFeature)
    {
        $request->validate([
            'facility_id' => 'required',
            'feature_name' => 'required',
            'description' => 'nullable'
        ]);

        $facilityFeature->update($request->all());

        return redirect()
            ->route('facility-features.index')
            ->with('success','Feature updated successfully.');
    }

    public function destroy(FacilityFeature $facilityFeature)
    {
        $facilityFeature->delete();

        return redirect()
            ->route('facility-features.index')
            ->with('success','Feature deleted successfully.');
    }
}