<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Database\QueryException;

class LandingController extends Controller
{
    public function __invoke()
    {
        try {
            $destinations = Destination::query()->latest()->take(8)->get();
        } catch (QueryException) {
            $destinations = collect();
        }

        return view('landing', compact('destinations'));
    }
}
