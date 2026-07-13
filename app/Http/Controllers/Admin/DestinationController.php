<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $destinations = Destination::latest()->paginate(10);

        return view('admin.destinations.index', compact('destinations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.destinations.form', [
            'destination' => null,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:150',
            'country' => 'required|max:120',
            'thumbnail' => 'nullable|max:2000',
            'short_description' => 'nullable',
            'description' => 'nullable',
            'featured' => 'nullable',
            'status' => 'nullable',
        ]);

        Destination::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'country' => $validated['country'],
            'thumbnail' => $validated['thumbnail'] ?? '',
            'short_description' => $validated['short_description'] ?? '',
            'description' => $validated['description'] ?? '',
            'featured' => $request->has('featured'),
            'status' => $request->has('status'),
            'sort_order' => 0,
        ]);

        return redirect()
            ->route('admin.destinations.index')
            ->with('success', 'Destination created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Destination $destination)
    {
        return redirect()->route('admin.destinations.index');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Destination $destination)
    {
        return view('admin.destinations.form', compact('destination'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Destination $destination)
    {
        $validated = $request->validate([
            'name' => 'required|max:150',
            'country' => 'required|max:120',
            'thumbnail' => 'nullable|max:2000',
            'short_description' => 'nullable',
            'description' => 'nullable',
        ]);

        $destination->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'country' => $validated['country'],
            'thumbnail' => $validated['thumbnail'] ?? '',
            'short_description' => $validated['short_description'] ?? '',
            'description' => $validated['description'] ?? '',
            'featured' => $request->has('featured'),
            'status' => $request->has('status'),
        ]);

        return redirect()
            ->route('admin.destinations.index')
            ->with('success', 'Destination updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination)
    {
        $destination->delete();

        return redirect()
            ->route('admin.destinations.index')
            ->with('success', 'Destination deleted successfully.');
    }
}
