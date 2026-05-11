<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = request()->user();

        $query = Destination::query()->latest();

        // Admin bisa melihat semua destinasi, operator hanya miliknya sendiri
        if ($user?->role !== 'admin') {
            $query->where('operator_id', $user->id);
        }

        $destinations = $query->paginate(12);

        return view('operator.destinations.index', compact('destinations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('operator.destinations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:1000'],
            'opening_hours' => ['required', 'string', 'max:255'],
            'opening_time' => ['required', 'date_format:H:i'],
            'closing_time' => ['required', 'date_format:H:i'],
            'description' => ['required', 'string', 'max:5000'],
            'location_maps_url' => ['required', 'url'],
            'contact_phone' => ['required', 'string', 'max:30'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
            'social_media.instagram' => ['nullable', 'string', 'max:255'],
            'social_media.facebook' => ['nullable', 'string', 'max:255'],
            'social_media.twitter' => ['nullable', 'string', 'max:255'],
            'social_media.tiktok' => ['nullable', 'string', 'max:255'],
        ]);

        $data['image_url'] = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storePublicly('destinations', 'public');
            $data['image_url'] = '/storage/' . $path;
        }

        // Clean up social media - remove empty values
        if (isset($data['social_media'])) {
            $data['social_media'] = array_filter($data['social_media'], fn($v) => !empty($v));
        }

        Destination::create([
            ...$data,
            'operator_id' => $request->user()->id,
        ]);

        return redirect()->route('operator.destinations.index')->with('success', 'Destinasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Destination $destination)
    {
        $user = request()->user();
        abort_unless($user?->role === 'admin' || $destination->operator_id === $user->id, 403);
        return view('operator.destinations.show', compact('destination'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Destination $destination)
    {
        $user = request()->user();
        abort_unless($user?->role === 'admin' || $destination->operator_id === $user->id, 403);
        return view('operator.destinations.edit', compact('destination'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Destination $destination)
    {
        $user = $request->user();
        abort_unless($user?->role === 'admin' || $destination->operator_id === $user->id, 403);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:1000'],
            'opening_hours' => ['required', 'string', 'max:255'],
            'opening_time' => ['required', 'date_format:H:i'],
            'closing_time' => ['required', 'date_format:H:i'],
            'description' => ['required', 'string', 'max:5000'],
            'location_maps_url' => ['required', 'url'],
            'contact_phone' => ['required', 'string', 'max:30'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
            'social_media.instagram' => ['nullable', 'string', 'max:255'],
            'social_media.facebook' => ['nullable', 'string', 'max:255'],
            'social_media.twitter' => ['nullable', 'string', 'max:255'],
            'social_media.tiktok' => ['nullable', 'string', 'max:255'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->storePublicly('destinations', 'public');
            $data['image_url'] = '/storage/' . $path;
        }

        // Clean up social media - remove empty values
        if (isset($data['social_media'])) {
            $data['social_media'] = array_filter($data['social_media'], fn($v) => !empty($v));
        }

        $destination->update($data);
        return redirect()->route('operator.destinations.index')->with('success', 'Destinasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination)
    {
        $user = request()->user();
        abort_unless($user?->role === 'admin' || $destination->operator_id === $user->id, 403);
        $destination->delete();
        return redirect()->route('operator.destinations.index')->with('success', 'Destinasi berhasil dihapus.');
    }
}
