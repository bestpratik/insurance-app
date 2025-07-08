<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::all();
        return view('admin.content.index', compact('contents'));
    }

    public function create()
    {
        return view('admin.content.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([            
            'title' => 'required'
        ]);

        $contents = new Content;

        $page_slug = Str::slug($request['title']);
        $contents->title = $request['title'];
        $contents->page_slug = $page_slug;
        $contents->description = $request['description'];
        $contents->created_at = date("Y-m-d H:i:s");
        $contents->updated_at = null;

        $contents->save();

        return redirect('content')->with('message', 'Content added successfully');

    }

    public function edit(string $id)
    {
        $contents = Content::find($id);
        return view('admin.content.edit', compact('contents'));
    }
    
    public function update(Request $request, string $id)
    {
        $request->validate([       
            'title' => 'required'
        ]);

        $contents = Content::find($id);

        $page_slug = Str::slug($request['title']);
        $contents->title = $request['title'];
        $contents->page_slug = $page_slug;
        $contents->description = $request['description'];
        $contents->created_at = null;
        $contents->updated_at = date("Y-m-d H:i:s");

        $contents->update();

        return redirect('content')->with('message', 'Content updated successfully');
    }

    public function destroy(string $id)
    {
        $contents = Content::find($id);
        if($contents)
        {
            $contents->delete();
            return redirect('content')->with('message', 'Content deleted successfully');
        }
        else
        {
            return redirect('content')->with('message', 'No Content found to delete');
        }
    }
}

