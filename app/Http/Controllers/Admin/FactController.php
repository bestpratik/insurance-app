<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FactController extends Controller
{
    function index()
    {
        $fact = Fact::all();
        return view('admin.fact.index', compact('fact'));
    }

    function create()
    {
        return view('admin.fact.create');
    }

    function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => [
                'required',
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,webp',
                // \Illuminate\Validation\Rule::dimensions()->maxWidth(1200)->maxHeight(900),
            ]         
        ]);

        $fact = new Fact;

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/fact'), $filename);
            $fullPath = url('uploads/fact/' . $filename);
            $fact->image = $fullPath;
        }

        $fact->title = $request['title'];
        $fact->description = $request['description'];
        
        $fact->created_at = date("Y-m-d H:i:s");
        $fact->updated_at = null;

        $fact->save();

        return redirect('fact')->with('success', 'Fact added successfully');
    }

    function edit($id)
    {
        $fact = Fact::find($id);
        return view('admin.fact.edit', compact('fact'));
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $fact = Fact::find($id);

         if ($request->hasfile('image')) {
            $destination = 'uploads/fact/' . $fact->image;
            $imageName = basename($destination);
            if (File::exists('uploads/fact/' . $imageName)) {
                File::delete('uploads/fact/' . $imageName);
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/fact'), $filename);
            $fullPath = url('uploads/fact/' . $filename);
            $fact->image = $fullPath;
        }

        $fact->title = $request['title'];
        $fact->description = $request['description'];

        $fact->created_at = null;
        $fact->updated_at = date("Y-m-d H:i:s");

        $fact->update();

        return redirect('fact')->with('success', 'Fact updated successfully');
    }

    function destroy($id)
    {
        $fact = Fact::find($id);
        if ($fact) {


            $fact->delete();
            return redirect('fact')->with('success', 'Fact deleted successfully');
        } else {
            return redirect('fact')->with('success', 'No Fact found to delete');
        }
    }
}
