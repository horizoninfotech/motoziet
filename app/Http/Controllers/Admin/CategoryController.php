<?php // app/Http/Controllers/Admin/CategoryController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    $categories = Category::query()
        ->when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%")
                         ->orWhere('name_ar', 'LIKE', "%{$search}%")
                         ->orWhere('name_ur', 'LIKE', "%{$search}%");
        })
        ->orderBy('created_at', 'desc') // Order by created_at descending
        ->paginate(10);

    return view('admin.categories.index', compact('categories', 'search'));
}

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $iconName = null;
        if ($request->hasFile('icon')) {
            $iconName = time() . '.' . $request->icon->extension();
            $request->icon->move(public_path('images/icons'), $iconName);
        }

        Category::create([
            'name' => $request->input('name'),
            'name_ar' => $request->input('name_ar'),
            'name_ur' => $request->input('name_ur'),
            'description' => $request->input('description'),
            'description_ar' => $request->input('description_ar'),
            'description_ur' => $request->input('description_ur'),
            'icon' => $iconName,
        ]);


        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:255',
            'name_ar' => 'required|max:255',
            'name_ur' => 'required|max:255',
            'description' => 'required',
            'description_ar' => 'required',
            'description_ur' => 'required',
            'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('icon')) {
            if ($category->icon && file_exists(public_path('images/icons/' . $category->icon))) {
                unlink(public_path('images/icons/' . $category->icon));
            }
            $iconName = time() . '.' . $request->icon->extension();
            $request->icon->move(public_path('images/icons'), $iconName);
            $category->icon = $iconName;
        }


        $category->update([
            'name' => $request->input('name'),
            'name_ar' => $request->input('name_ar'),
            'name_ur' => $request->input('name_ur'),
            'description' => $request->input('description'),
            'description_ar' => $request->input('description_ar'),
            'description_ur' => $request->input('description_ur'),
            'icon' => $category->icon,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        if ($category->services()->exists()) {
            return redirect()->route('admin.categories.index')->with('error', 'Category cannot be deleted because it has associated services.');
        }

        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
