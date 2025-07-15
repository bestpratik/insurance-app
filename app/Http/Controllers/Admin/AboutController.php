<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    function index()
    {
        $about = About::all();
        return view('admin.about.index', compact('about'));
    }

    function create()
    {
        return view('admin.about.create');
    }

    function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => [
                'required',
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,webp',
                // \Illuminate\Validation\Rule::dimensions()->maxWidth(1200)->maxHeight(900),
            ]
        ]);

        $about = new About;


        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/about'), $filename);
            // $fullPath = url('uploads/about/' . $filename);
            $about->image = $filename;
        }

        $about->title = $request['title'];
        $about->sub_title = $request['sub_title'];
        $about->description = $request['description'];
        $about->created_at = date("Y-m-d H:i:s");
        $about->updated_at = null;

        $about->save();

        return redirect('about')->with('success', 'About added successfully');
    }

    function edit($id)
    {
        $about = About::find($id);
        return view('admin.about.edit', compact('about')); 
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $about = About::find($id);

        if ($request->hasfile('image')) {
            $destination = 'uploads/about/' . $about->image;
            $imageName = basename($destination);
            if (File::exists('uploads/about/' . $imageName)) {
                File::delete('uploads/about/' . $imageName);
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/about'), $filename);
            // $fullPath = url('uploads/about/' . $filename);
            $about->image = $filename;
        }

        $about->title = $request['title'];
        $about->sub_title = $request['sub_title'];
        $about->description = $request['description'];
        $about->created_at = null;
        $about->updated_at = date("Y-m-d H:i:s");

        $about->update();

        return redirect('about')->with('success', 'About updated successfully');
    }

    function destroy($id)
    {
        $about = About::find($id);
        if ($about) {
            //Delete previous file
            $destinantion = 'public/uploads/' . $about->image;
            if (File::exists($destinantion)) {
                File::delete($destinantion);
            }

            $about->delete();
            return redirect('about')->with('success', 'About deleted successfully');
        } else {
            return redirect('about')->with('success', 'No about found to delete');
        }
    }
}
