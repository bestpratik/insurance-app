<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogTag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tag = BlogTag::orderBy('id', 'DESC')->get();
        return view('admin.blogtag.index', compact('tag'));
    }

    public function create()
    {
        return view('admin.blogtag.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tag_name' => 'required',
        ]);

        $tag = new BlogTag;
        $tag->tag_name = $request->tag_name;
        $tag->status = 1;
        $tag->is_popular = $request->is_popular ?? 0;

        $tag->save();

        return redirect()->route('blog.tag')->with('message', 'Tag added successfully!');
    }

    public function edit($id)
    {
        $tag = BlogTag::findOrFail($id);
        return view('admin.blogtag.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $tag = BlogTag::findOrFail($id);

        $request->validate([
            'tag_name' => 'required'
        ]);

        $tag->tag_name   = $request->tag_name;
        $tag->status = $request->status ?? 0;
        $tag->is_popular = $request->is_popular ?? 0;

        $tag->save();

        return redirect()->route('blog.tag')->with('message', 'Tag updated successfully!');
    }

    public function destroy($id)
    {
        BlogTag::findOrFail($id)->delete();
        return redirect()->route('blog.tag')->with('message', 'Tag deleted successfully!');
    }

    public function status($id)
    {
        $tag = BlogTag::find($id);
        $tag->status = !$tag->status;
        $tag->save();

        return redirect()->route('blog.tag')->with('success', 'Blog Tag status updated successfully.');
    }

    public function isPopular($id)
    {
        $tag = BlogTag::findOrFail($id);
        $tag->is_popular = !$tag->is_popular;
        $tag->save();

        return redirect()->route('blog.tag')->with('message', 'Tag popularity updated successfully!');
    }
}
