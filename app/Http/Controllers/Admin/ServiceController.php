<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $service = Service::all();
        return view('admin.service.index', compact('service'));
    }

    public function create()
    {
        return view('admin.service.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'sub_title' => 'required',
            'image' => [
                'required',
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,webp',
                // \Illuminate\Validation\Rule::dimensions()->maxWidth(1200)->maxHeight(900),
            ]
        ]);

        $service = new Service;

        if ($request->hasFile('image')) {
            if ($service->image) {
                $oldImagePath = public_path('uploads/service/' . basename($service->image));
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $file = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/service'), $filename);
            $service->image = url('uploads/service/' . $filename);
        }

        $page_slug = Str::slug($request['title']);
        $service->title = $request['title'];
        $service->sub_title = $request['sub_title'];
        $service->page_slug = $page_slug;
        $service->description = $request['description'];
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = null;

        $service->save();
        return redirect('services')->with('success', 'Service added successfully');
    }

    public function edit($id)
    {
        $service = Service::find($id);
        return view('admin.service.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'sub_title' => 'required'
        ]);
        $service = Service::find($id);

        if ($request->hasFile('image')) {
            if ($service->image) {
                $oldImagePath = public_path('uploads/service/' . basename($service->image));
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $file = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/service'), $filename);
            $service->image = url('uploads/service/' . $filename);
        }

        $page_slug = Str::slug($request['title']);
        $service->title = $request['title'];
        $service->page_slug = $page_slug;
        $service->sub_title = $request['sub_title'];
        $service->description = $request['description'];
        $service->updated_at = date('Y-m-d H:i:s');

        $service->update();
        return redirect('services')->with('success', 'Service updated successfully');
    }

    public function destroy($id)
    {
        $service = Service::find($id);

        if ($service) {
            $destinantion = 'uploads/service/' . $service->image;
            if (File::exists($destinantion)) {
                File::delete($destinantion);
            }

            $service->delete();
            return redirect('services')->with('success', 'Service deleted successfully');
        } else {
            return redirect('services')->with('success', 'No Service found to delete!!');
        }
    }
    
}

