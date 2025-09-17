<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::ordered()->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'description' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'author' => 'nullable|string|max:255',
            'status' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'slug' => 'required|string|unique:blogs,slug'
        ]);

        $data = $request->all();
        
        // Handle status (checkbox to string conversion)
        $data['status'] = $request->has('status') && $request->status === 'published' ? 'published' : 'draft';
        
        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('blog_images', $imageName, 'public');
            $data['featured_image'] = $imagePath;
        }

        Blog::create($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('admin.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'description' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'author' => 'nullable|string|max:255',
            'status' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'slug' => 'required|string|unique:blogs,slug,' . $blog->id
        ]);

        $data = $request->all();
        
        // Handle status (checkbox to string conversion)
        $data['status'] = $request->has('status') && $request->status === 'published' ? 'published' : 'draft';
        
        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            
            $image = $request->file('featured_image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('blog_images', $imageName, 'public');
            $data['featured_image'] = $imagePath;
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        // Delete featured image
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post deleted successfully!');
    }

    /**
     * Bulk delete blogs
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:blogs,id'
        ]);

        $blogs = Blog::whereIn('id', $request->ids);
        
        // Delete featured images
        foreach ($blogs->get() as $blog) {
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
        }

        $blogs->delete();

        return response()->json(['success' => true, 'message' => 'Selected blog posts deleted successfully!']);
    }

    /**
     * Reorder blogs
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'blogs' => 'required|array',
            'blogs.*.id' => 'required|exists:blogs,id',
            'blogs.*.sort_order' => 'required|integer|min:0'
        ]);

        foreach ($request->blogs as $blogData) {
            Blog::where('id', $blogData['id'])->update(['sort_order' => $blogData['sort_order']]);
        }

        return response()->json(['success' => true, 'message' => 'Blog order updated successfully!']);
    }
}
