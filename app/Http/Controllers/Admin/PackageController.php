<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::orderBy('created_at', 'desc')->get();
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/packages'), $imageName);
    
        $package = Package::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imageName,
        ]);
    
        if ($package) {
            return redirect()->route('admin.packages.index')->with('success', 'Package created successfully!');
        } else {
            return redirect()->route('admin.packages.create')->with('error', 'Failed to create package. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        return view('admin.packages.show', compact('package'));
    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/packages'), $imageName);
    
            // Delete the old image
            if ($package->image && file_exists(public_path('images/packages/' . $package->image))) {
                unlink(public_path('images/packages/' . $package->image));
            }
    
            $package->update([
                'image' => $imageName,
            ]);
        }
    
        $package->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);
    
        return redirect()->route('admin.packages.index')->with('success', 'Package updated successfully!');
    }
    

    public function destroy(Package $package)
    {
        $package->delete();

        return redirect()->route('admin.packages.index')->with('status', 'Package deleted successfully!');
    }
}
