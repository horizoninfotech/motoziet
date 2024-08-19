<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Category; 
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('category')->orderBy('created_at', 'desc')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $categories = Category::all(); // Fetch all categories
        return view('admin.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|max:255',
            'title_ar' => 'required|max:255',
            'title_ur' => 'required|max:255',
            'description' => 'required',
            'description_ar' => 'required',
            'description_ur' => 'required',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $iconName = null;
        if ($request->hasFile('icon')) {
            $iconName = time() . '.' . $request->icon->extension();
            $request->icon->move(public_path('images/icons'), $iconName);
        }

        Service::create([
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
            'title_ar' => $request->input('title_ar'),
            'title_ur' => $request->input('title_ur'),
            'description' => $request->input('description'),
            'description_ar' => $request->input('description_ar'),
            'description_ur' => $request->input('description_ur'),
            'icon' => $iconName,
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    
        public function show(Service $service)
        {
            $service->load('category'); // Eager load the related category
            return view('admin.services.show', compact('service'));
        }


    public function edit(Service $service)
    {
        $categories = Category::all();
        return view('admin.services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|max:255',
            'title_ar' => 'required|max:255',
            'title_ur' => 'required|max:255',
            'description' => 'required',
            'description_ar' => 'required',
            'description_ur' => 'required',
            'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('icon')) {
            if ($service->icon && file_exists(public_path('images/icons/' . $service->icon))) {
                unlink(public_path('images/icons/' . $service->icon));
            }
            $iconName = time() . '.' . $request->icon->extension();
            $request->icon->move(public_path('images/icons'), $iconName);
            $service->icon = $iconName;
        }

        $service->update([
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
            'title_ar' => $request->input('title_ar'),
            'title_ur' => $request->input('title_ur'),
            'description' => $request->input('description'),
            'description_ar' => $request->input('description_ar'),
            'description_ur' => $request->input('description_ur'),
            'icon' => $service->icon,
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        try {
            if ($service->icon && file_exists(public_path('images/icons/' . $service->icon))) {
                unlink(public_path('images/icons/' . $service->icon));
            }
            $service->delete();
            return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.services.index')->with('error', 'Error occurred while deleting the service.');
        }
    }
}
