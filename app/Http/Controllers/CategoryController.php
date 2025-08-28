<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('sort_order')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
{
    // Parent dropdown ke liye saari categories
    $categories = Category::orderBy('category_name')->get();

    // create view ko pass
    return view('admin.categories.create', compact('categories'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name'     => 'required|string|max:255|unique:categories,category_name',
            'parent_id'         => 'nullable|exists:categories,id',
            'seo_url'           => 'required|string|max:255|unique:categories,seo_url',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string',
            'short_content'     => 'nullable|string',
            'description'       => 'nullable|string',
            'media'             => 'nullable|image|max:2048',
        ]);

        $validated['status'] = $request->boolean('status');

        if ($request->hasFile('media')) {
            $validated['media'] = $request->file('media')->store('uploads/categories', 'public');
        }

        $last = Category::max('sort_order') ?? 0;
        $validated['sort_order'] = $last + 1;

        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category created.');
    }

    public function edit(Category $category)
{
    // Khud ko parent list se exclude karo
    $categories = Category::where('id', '!=', $category->id)
                    ->orderBy('category_name')
                    ->get();

    // edit view ko category + categories dono pass
    return view('admin.categories.edit', compact('category', 'categories'));
}

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'category_name'     => 'required|string|max:255|unique:categories,category_name,' . $category->id,
            'parent_id'         => 'nullable|exists:categories,id',
            'seo_url'           => 'required|string|max:255|unique:categories,seo_url,' . $category->id,
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string',
            'short_content'     => 'nullable|string',
            'description'       => 'nullable|string',
            'media'             => 'nullable|image|max:2048',
        ]);

        $validated['status'] = $request->boolean('status');

        if ($request->hasFile('media')) {
            if ($category->media && Storage::disk('public')->exists($category->media)) {
                Storage::disk('public')->delete($category->media);
            }
            $validated['media'] = $request->file('media')->store('uploads/categories', 'public');
        }

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated.');
    }

public function destroy($id)
{
    $category = Category::findOrFail($id);

    if ($category->media && Storage::disk('public')->exists($category->media)) {
        Storage::disk('public')->delete($category->media);
    }

    $category->delete();

    return back()->with('success', 'Category deleted successfully.');
}

public function bulkDelete(Request $request)
{
    $ids = $request->ids;

    // yeh sahi hai na?

    if (!$ids || count($ids) === 0) {
        return back()->with('error', 'No categories selected.');
    }

    $categories = Category::whereIn('id', $ids)->get();

    foreach ($categories as $category) {
        if ($category->media && Storage::disk('public')->exists($category->media)) {
            Storage::disk('public')->delete($category->media);
        }
        $category->delete();
    }

    return back()->with('success', 'Selected categories deleted successfully.');
}








    public function reorder(Request $request)
    {
        $request->validate([
            'order'              => 'required|array',
            'order.*.id'         => 'required|integer|exists:categories,id',
            'order.*.sort_order' => 'required|integer|min:1',
        ]);

        foreach ($request->order as $item) {
            Category::where('id', $item['id'])->update(['sort_order' => $item['sort_order']]);
        }

        return response()->json(['status' => 'success']);
    }
}
