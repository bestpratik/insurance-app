<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    function index()
    {
        $banner = Banner::all();
        return view('admin.banner.index', compact('banner'));
    }

    function create()
    {
        return view('admin.banner.create');
    }

    function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'sub_title' => 'required',
            'image' => [
                'required',
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,webp',
                \Illuminate\Validation\Rule::dimensions()->maxWidth(1200)->maxHeight(900),
            ]
        ]);

        $banner = new Banner;

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/banner'), $filename);
            $fullPath = url('uploads/banner/' . $filename);
            $banner->image = $fullPath;
        }

        $banner->title = $request['title'];
        $banner->sub_title = $request['sub_title'];
        $banner->button_text= $request['button_text'];
        $banner->button_link = $request['button_link'];
        $banner->created_at = date("Y-m-d H:i:s");
        $banner->updated_at = null;

        $banner->save();

        return redirect('banner')->with('success', 'Banner added successfully');
    }

    function edit($id)
    {
        $banner = Banner::find($id);
        return view('admin.banner.edit', compact('banner'));
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'sub_title' => 'required'
        ]);

        $banner = Banner::find($id);

        if ($request->hasfile('image')) {
            $destination = 'uploads/banner/' . $banner->image;
            $imageName = basename($destination);
            if (File::exists('uploads/banner/' . $imageName)) {
                File::delete('uploads/banner/' . $imageName);
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/banner'), $filename);
            $fullPath = url('uploads/banner/' . $filename);
            $banner->image = $fullPath;
        }

        $banner->title = $request['title'];
        $banner->sub_title = $request['sub_title'];
        $banner->button_text = $request['button_text'];
        $banner->button_link = $request['button_link'];
        $banner->created_at = null;
        $banner->updated_at = date("Y-m-d H:i:s");

        $banner->update();

        return redirect('banner')->with('success', 'Banner updated successfully');
    }

    function destroy($id)
    {
        $banner = Banner::find($id);
        if ($banner) {
            //Delete previous file
            $destinantion = 'uploads/banner/' . $banner->image;
            if (File::exists($destinantion)) {
                File::delete($destinantion);
            }

            $banner->delete();
            return redirect('banner')->with('success', 'Banner deleted successfully');
        } else {
            return redirect('banner')->with('success', 'No banner found to delete');
        }
    }
}
