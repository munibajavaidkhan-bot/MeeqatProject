<?php
namespace App\Http\Controllers;

use App\Models\Dua;

class HomeController extends Controller {
    public function index() {
        $featuredDuas = Dua::where('is_featured', true)
            ->where('is_active', true)
            ->with('category')
            ->take(6)
            ->get();

        return view('home', compact('featuredDuas'));
    }

    public function about() {
        return view('about');
    }
}