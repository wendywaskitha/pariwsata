<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function show($id): View
    {
        // Ambil destination dengan relasi
        $destination = Destination::with([
            'category',
            'reviews.user'  // Jika Anda memiliki relasi review dengan user
        ])->findOrFail($id);

        // Destinasi serupa (optional)
        $similarDestinations = Destination::where('category_id', $destination->category_id)
            ->where('id', '!=', $destination->id)
            ->limit(3)
            ->get();

        return view('destinations.detail', [
            'destination' => $destination,
            'similarDestinations' => $similarDestinations
        ]);
    }

    // Method untuk index/list destinasi
    public function index()
    {
        $destinations = Destination::with('category')
            ->withCount('reviews')
            ->paginate(9);

        return view('destinations.index', [
            'destinations' => $destinations
        ]);
    }
}
