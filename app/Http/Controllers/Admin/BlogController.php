<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    function index()
    {
        $blog = Blog::with(['categories', 'tags'])->latest()->get();
        return view('admin.blog.index', compact('blog'));
    }

    function create()
    {
        $categories = BlogCategory::all();
        $tags = BlogTag::all();
        return view('admin.blog.create', compact('categories', 'tags'));
    }

    function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'image_alt'    => 'required',
            'img_alt'      => 'required',
            'description'  => 'nullable|longtext',
            'image'        => 'required|image|mimes:jpg,jpeg,png,webp',
            'author_image' => 'required|image|mimes:jpg,jpeg,png,webp',
            'blog_author'  => 'nullable|string|max:255',
            'date'         => 'nullable|date',
            'type'         => 'required|in:blog,resource',
            'categories'   => 'nullable|array',
            'tags'         => 'nullable|array',
        ]);

        $blog = new Blog;

        if ($request->hasFile('image')) {
            $imageName = 'blog-' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/blogs'), $imageName);
            $blog->image = $imageName;
        }

        // Upload author image
        if ($request->hasFile('author_image')) {
            $authorImageName = 'author-' . time() . '.' . $request->author_image->extension();
            $request->author_image->move(public_path('uploads/blogs'), $authorImageName);
            $blog->author_image = $authorImageName;
        }

        $slug = Str::slug($request['title']);
        $blog->title = $request['title'];
        $blog->slug = $slug;
        $blog->image_alt = $request['image_alt'];
        $blog->description = $request['description'];
        $blog->status = 1;
        $blog->img_alt = $request['img_alt'];
        $blog->blog_author = $request['blog_author'];
        $blog->date = $request['date'];
        $blog->type = $request['type'];
        $blog->created_at = date("Y-m-d H:i:s");
        $blog->updated_at = null;

        $blog->save();

        // Attach categories and tags (pivot)
        if ($request->has('categories')) {
            $blog->categories()->sync($request->categories);
        }
        if ($request->has('tags')) {
            $blog->tags()->sync($request->tags);
        }

        return redirect('blog-index')->with('success', 'Blog added successfully');
    }

    function edit($id)
    {
        $blog = Blog::with(['categories', 'tags'])->findOrFail($id);
        $categories = BlogCategory::all();
        $tags = BlogTag::all();
        $selectedCategories = $blog->categories->pluck('id')->toArray();
        $selectedTags = $blog->tags->pluck('id')->toArray();
        return view('admin.blog.edit', compact('blog', 'categories', 'tags', 'selectedCategories', 'selectedTags'));
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'author_image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'blog_author'  => 'nullable|string|max:255',
            'date'         => 'nullable|date',
            'type'         => 'required|in:blog,resource',
            'categories'   => 'nullable|array',
            'tags'         => 'nullable|array',
        ]);

        $blog = Blog::find($id);

        if ($request->hasFile('image')) {
            if ($blog->image && File::exists(public_path($blog->image))) {
                File::delete(public_path($blog->image));
            }
            $imageName = 'blog-' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/blogs'), $imageName);
            $blog->image = $imageName;
        }

        // Replace author image if new one uploaded
        if ($request->hasFile('author_image')) {
            if ($blog->author_image && File::exists(public_path($blog->author_image))) {
                File::delete(public_path($blog->author_image));
            }
            $authorImageName = 'author-' . time() . '.' . $request->author_image->extension();
            $request->author_image->move(public_path('uploads/blogs'), $authorImageName);
            $blog->author_image = $authorImageName;
        }

        $slug = Str::slug($request['title']);
        $blog->title = $request['title'];
        $blog->slug = $slug;
        $blog->image_alt = $request['image_alt'];
        $blog->description = $request['description'];
        $blog->status = 1;
        $blog->img_alt = $request['img_alt'];
        $blog->blog_author = $request['blog_author'];
        $blog->date = $request['date'];
        $blog->type = $request['type'];
        $blog->created_at = null;
        $blog->updated_at = date("Y-m-d H:i:s");

        $blog->update();

        // Sync categories and tags
        $blog->categories()->sync($request->categories ?? []);
        $blog->tags()->sync($request->tags ?? []);

        return redirect('blog-index')->with('success', 'Blog updated successfully');
    }

    function destroy($id)
    {
        $blog = Blog::find($id);

        if ($blog->image && File::exists(public_path($blog->image))) {
            File::delete(public_path($blog->image));
        }
        if ($blog->author_image && File::exists(public_path($blog->author_image))) {
            File::delete(public_path($blog->author_image));
        }

        // Delete relations
        $blog->categories()->detach();
        $blog->tags()->detach();

        $blog->delete();
        return redirect('blog-index')->with('success', 'Blog deleted successfully');
    }

    function status($id)
    {
        $blog = Blog::find($id);
        $blog->status = !$blog->status;
        $blog->save();

        return redirect('blog-index')->with('success', 'Blog status updated successfully!');
    }
}
