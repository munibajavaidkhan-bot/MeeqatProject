<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller {

    public function index() {
        $settings = Setting::orderBy('group')->get()->groupBy('group');
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request) {
        foreach ($request->except(['_token', '_method']) as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }
        return back()->with('success', 'Settings saved successfully!');
    }
}