<?php
namespace App\Http\Controllers;

use App\Models\IhramGuide;
use Illuminate\Http\Request;

class IhramGuideController extends Controller {

    public function index(Request $request) {
        $activeFilter = $request->get('filter', 'all');

        // Saare guides grouped by category
        $allGuides = IhramGuide::active()->get()->groupBy('category');

        // Filter apply karo
        if ($activeFilter !== 'all') {
            $filteredGuides = IhramGuide::active()
                ->where('category', $activeFilter)
                ->get();
        } else {
            $filteredGuides = IhramGuide::active()->get();
        }

        // Counts for filter badges
        $counts = IhramGuide::active()
            ->selectRaw('category, count(*) as total')
            ->groupBy('category')
            ->pluck('total', 'category');

        return view('guides.ihram', compact('allGuides', 'filteredGuides', 'activeFilter', 'counts'));
    }

    public function show(int $id) {
        $guide = IhramGuide::findOrFail($id);

        // Related guides same category se
        $related = IhramGuide::active()
            ->where('category', $guide->category)
            ->where('id', '!=', $id)
            ->take(3)
            ->get();

        return view('guides.ihram-show', compact('guide', 'related'));
    }
}