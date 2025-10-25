<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonial = Testimonial::all();
        return view('admin.testimonial.index', compact('testimonial'));
    }

    public function create()
    {
        return view('admin.testimonial.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
        ]);

        $testimonial = new Testimonial;

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/testimonial'), $filename);
            $testimonial->image = $filename;
        }

        $testimonial->name = $request['name'];
        $testimonial->location = $request['location'];
        $testimonial->review = $request['review'];
        $testimonial->created_at = date("Y-m-d H:i:s");
        $testimonial->updated_at = null;

        $testimonial->save();

        return redirect('testimonial')->with('message', 'Testimonial added successfully');
    }

    public function edit($id)
    {
        $testimonial = Testimonial::find($id);
        return view('admin.testimonial.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $testimonial = Testimonial::find($id);

        if ($request->hasfile('image')) {
            $destination = 'uploads/testimonial/' . $testimonial->image;
            $imageName = basename($destination);
            if (File::exists('uploads/testimonial/' . $imageName)) {
                File::delete('uploads/testimonial/' . $imageName);
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/testimonial'), $filename);
            $testimonial->image = $filename;
        }

        $testimonial->name = $request['name'];
        $testimonial->location = $request['location'];
        $testimonial->review = $request['review'];
        $testimonial->created_at = null;
        $testimonial->updated_at = date("Y-m-d H:i:s");

        $testimonial->update();

        return redirect('testimonial')->with('message', 'Testimonial updated successfully');
    }

    public function destroy($id)
    {
        $testimonial = testimonial::find($id);
        if ($testimonial) {
            //Delete previous file
            $destination = 'public/uploads/' . $testimonial->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $testimonial->delete();
            return redirect('testimonial')->with('message', 'Testimonial deleted successfully');
        } else {
            return redirect('testimonial')->with('message', 'No Testimonial found to delete');
        }
    }
}
