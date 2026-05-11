<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::query()->latest()->paginate(12);
        return view('buyer.destinations.index', compact('destinations'));
    }

    public function show(Destination $destination)
    {
        return view('buyer.destinations.show', compact('destination'));
    }
}
