<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\Category;
use Illuminate\View\View;
use App\Models\Destination;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(): View
    {
        // Ambil semua hero
    $heroes = Hero::all();

    // Jika tidak ada hero, buat default
    if ($heroes->isEmpty()) {
        $heroes = collect([
            new Hero([
                'name' => 'Explore Amazing Destinations',
                'description' => 'Discover incredible places around the world',
                'image' => 'default-hero.jpg'
            ])
        ]);
    }

    $destinations = Destination::with([
        'category',
        'reviews'])
        ->withCount('reviews')  // Hitung jumlah reviews
        ->latest()
        ->paginate(9);
    $categories = Category::all();

    return view('welcome', [
        'destinations' => $destinations,
        'heroes' => $heroes,
        'categories' => $categories
    ]);
    }
}
