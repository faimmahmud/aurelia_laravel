<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('sort_order')
            ->orderBy('name')
            ->paginate(10);

        return view('admin.countries.index', compact('countries'));
    }

    public function create()
    {
        return view('admin.countries.create', ['country' => new Country()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:150',
            'iso2'            => 'nullable|string|max:5',
            'iso3'            => 'nullable|string|max:5',
            'phone_code'      => 'nullable|string|max:10',
            'currency'        => 'nullable|string|max:10',
            'flag'            => 'nullable|image|max:2048',
            'hero_image'      => 'nullable|image|max:4096',
            'description'     => 'nullable|string',
            'status'          => 'nullable',
            'sort_order'      => 'nullable|integer',
            'seo_title'       => 'nullable|string|max:180',
            'seo_description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['status'] = $request->has('status');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('flag')) {
            $validated['flag'] = $request->file('flag')->store('countries', 'public');
        }

        if ($request->hasFile('hero_image')) {
            $validated['hero_image'] = $request->file('hero_image')->store('countries', 'public');
        }

        Country::create($validated);

        return redirect()
            ->route('admin.countries.index')
            ->with('success', 'Country created successfully.');
    }

    public function show(Country $country)
    {
        return redirect()->route('admin.countries.index');
    }

    public function edit(Country $country)
    {
        return view('admin.countries.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:150',
            'iso2'            => 'nullable|string|max:5',
            'iso3'            => 'nullable|string|max:5',
            'phone_code'      => 'nullable|string|max:10',
            'currency'        => 'nullable|string|max:10',
            'flag'            => 'nullable|image|max:2048',
            'hero_image'      => 'nullable|image|max:4096',
            'description'     => 'nullable|string',
            'status'          => 'nullable',
            'sort_order'      => 'nullable|integer',
            'seo_title'       => 'nullable|string|max:180',
            'seo_description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['status'] = $request->has('status');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('flag')) {
            if ($country->flag) {
                Storage::disk('public')->delete($country->flag);
            }
            $validated['flag'] = $request->file('flag')->store('countries', 'public');
        }

        if ($request->hasFile('hero_image')) {
            if ($country->hero_image) {
                Storage::disk('public')->delete($country->hero_image);
            }
            $validated['hero_image'] = $request->file('hero_image')->store('countries', 'public');
        }

        $country->update($validated);

        return redirect()
            ->route('admin.countries.index')
            ->with('success', 'Country updated successfully.');
    }

    public function destroy(Country $country)
    {
        if ($country->flag) {
            Storage::disk('public')->delete($country->flag);
        }

        if ($country->hero_image) {
            Storage::disk('public')->delete($country->hero_image);
        }

        $country->delete();

        return redirect()
            ->route('admin.countries.index')
            ->with('success', 'Country deleted successfully.');
    }
}
