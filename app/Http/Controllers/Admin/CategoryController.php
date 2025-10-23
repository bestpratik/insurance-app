<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::orderBy('id', 'DESC')->get();
        return view('admin.blogcategory.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.blogcategory.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required',
        ]);

        BlogCategory::create([
            'title'   => $request->title,
            'status' => $request->status ?? 0,
        ]);

        return redirect()->route('blog.category')->with('message', 'Category added successfully!');
    }

    public function edit($id)
    {
        $category = BlogCategory::findOrFail($id);
        return view('admin.blogcategory.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = BlogCategory::findOrFail($id);

        $request->validate([
            'title' => 'required',
        ]);

        $category->title   = $request->title;
        $category->status = $request->status ?? 0;
        $category->save();

        return redirect()->route('blog.category')->with('message', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        BlogCategory::findOrFail($id)->delete();
        return redirect()->route('blog.category')->with('message', 'Category deleted successfully!');
    }

    public function status($id)
    {
        $category = BlogCategory::find($id);
        $category->status = !$category->status;
        $category->save();

        return redirect()->route('blog.category')->with('success', 'Blog Category status updated successfully.');
    }
}
