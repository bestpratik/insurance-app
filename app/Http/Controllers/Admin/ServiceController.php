<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Insurance;
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
        
        $insurances = Insurance::where('purchase_mode', 'Online')->get();
        return view('admin.service.create', compact('insurances'));
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

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/service/'), $filename);
            // $fullPath = url('uploads/fact/' . $filename);
            $service->image = $filename;
        }


        $page_slug = Str::slug($request['title']);
        $service->title = $request['title'];
        $service->insurance_id = $request['insurance_id'];
        $service->sub_title = $request['sub_title'];
        $service->page_slug = $page_slug;
        $service->description = $request['description'];
        $service->offer = $request['offer'];
        $service->created_at = date('Y-m-d H:i:s');
        $service->updated_at = null;

        $service->save();
        return redirect('services')->with('success', 'Service added successfully');
    }

    public function edit($id)
    {
        $service = Service::find($id);
        $insurances = Insurance::where('purchase_mode', 'Online')->get();
        return view('admin.service.edit', compact('service', 'insurances'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'sub_title' => 'required'
        ]);
        $service = Service::find($id);

        if ($request->hasfile('image')) {
            $destination = 'uploads/service/' . $service->image;
            $imageName = basename($destination);
            if (File::exists('uploads/service/' . $imageName)) {
                File::delete('uploads/service/' . $imageName);
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/service/'), $filename);
            // $fullPath = url('uploads/fact/' . $filename);
            $service->image = $filename;
        }

       

        $page_slug = Str::slug($request['title']);
        $service->title = $request['title'];
        $service->insurance_id = $request['insurance_id'];
        $service->page_slug = $page_slug;
        $service->sub_title = $request['sub_title'];
        $service->offer = $request['offer'];
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

