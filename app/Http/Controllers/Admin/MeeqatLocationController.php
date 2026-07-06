<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MeeqatLocation;
use Illuminate\Http\Request;

class MeeqatLocationController extends Controller {

    public function index() {
        $locations = MeeqatLocation::orderBy('sort_order')->get();
        return view('admin.meeqat-locations.index', compact('locations'));
    }

    public function create() {
        return view('admin.meeqat-locations.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name_en'   => 'required|string|max:150',
            'name_ar'   => 'required|string|max:150',
            'latitude'  => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);
        MeeqatLocation::create($request->all());
        return redirect()->route('admin.meeqat-locations.index')->with('success', 'Meeqat location created!');
    }

    public function edit(MeeqatLocation $meeqatLocation) {
        return view('admin.meeqat-locations.edit', compact('meeqatLocation'));
    }

    public function update(Request $request, MeeqatLocation $meeqatLocation) {
        $meeqatLocation->update($request->all());
        return redirect()->route('admin.meeqat-locations.index')->with('success', 'Location updated!');
    }

    public function destroy(MeeqatLocation $meeqatLocation) {
        $meeqatLocation->delete();
        return redirect()->route('admin.meeqat-locations.index')->with('success', 'Location deleted!');
    }
}