<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use App\Models\Country\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $query = Country::query()->orderBy('name', 'ASC'); ;

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('name_ar', 'like', "%{$search}%")
                  ->orWhere('iso_code', 'like', "%{$search}%")
                  ->orWhere('name_ur', 'like', "%{$search}%")
                  ->orWhere('phone_code', 'like', "%{$search}%");
            });
        }

        $countries = $query->paginate(10);

        return view('admin.countries.index', compact('countries'));
    }

    public function create()
    {
        return view('admin.countries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'name_ur' => 'nullable|string|max:255',
            'iso_code' => 'required|string|max:5|unique:countries',
            'phone_code' => 'required|string|max:8',
        ]);

        Country::create($request->all());

        return redirect()->route('admin.countries.index')->with('success', 'Country created successfully.');
    }

    public function edit(Country $country)
    {
        return view('admin.countries.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'name_ur' => 'nullable|string|max:255',
            'iso_code' => 'required|string|max:5|unique:countries,iso_code,' . $country->id,
            'phone_code' => 'required|string|max:8',
        ]);

        $country->update($request->all());

        return redirect()->route('admin.countries.index')->with('success', 'Country updated successfully.');
    }

    public function show(Country $country)
{
    return view('admin.countries.show', compact('country'));
}

    public function destroy(Country $country)
    {
        $country->delete();

        return redirect()->route('admin.countries.index')->with('success', 'Country deleted successfully.');
    }
}
