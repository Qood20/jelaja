<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\DestinationGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Destination $destination)
    {
        Gate::authorize('manage', $destination);
        
        $galleries = $destination->galleries()->latest()->paginate(12);
        return view('operator.galleries.index', compact('destination', 'galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Destination $destination)
    {
        Gate::authorize('manage', $destination);
        
        return view('operator.galleries.create', compact('destination'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Destination $destination)
    {
        Gate::authorize('manage', $destination);
        
        $data = $request->validate([
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
        ]);

        $path = $request->file('photo')->storePublicly('galleries', 'public');
        $destination->galleries()->create([
            'image_url' => '/storage/' . $path,
        ]);

        return redirect()->route('operator.galleries.index', $destination)->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination, DestinationGallery $gallery)
    {
        Gate::authorize('manage', $destination);
        
        if ($gallery->destination_id !== $destination->id) {
            abort(404);
        }

        $gallery->delete();
        return redirect()->route('operator.galleries.index', $destination)->with('success', 'Foto galeri berhasil dihapus.');
    }
}
