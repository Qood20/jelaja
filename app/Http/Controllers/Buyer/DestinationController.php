<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $query = Destination::query()->latest();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $destinations = $query->paginate(12)->withQueryString();
        return view('buyer.destinations.index', compact('destinations', 'search'));
    }

    public function show(Destination $destination)
    {
        return view('buyer.destinations.show', compact('destination'));
    }
}
