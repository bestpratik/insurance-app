<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RentGuarantee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class RentGuaranteeController extends Controller
{
    function index()
    {
        $rent = RentGuarantee::all();
        return view('admin.rent.index', compact('rent'));
    }

    function create()
    {
        return view('admin.rent.create');
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
            ]
        ]);

        $rent = new RentGuarantee;


        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/rent'), $filename);
            $rent->image = $filename;
        }

        $rent->title = $request['title'];
        $rent->description = $request['description'];
        $rent->button_text = $request['button_text'];
        $rent->button_link = $request['button_link'];
        $rent->phone_number = $request['phone_number'];
        $rent->created_at = date("Y-m-d H:i:s");
        $rent->updated_at = null;

        $rent->save();

        return redirect('rent')->with('success', 'RentGuarantee added successfully');
    }

    function edit($id)
    {
        $rent = RentGuarantee::find($id);
        return view('admin.rent.edit', compact('rent')); 
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $rent = RentGuarantee::find($id);

        if ($request->hasfile('image')) {
            $destination = 'uploads/rent/' . $rent->image;
            $imageName = basename($destination);
            if (File::exists('uploads/rent/' . $imageName)) {
                File::delete('uploads/rent/' . $imageName);
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/rent'), $filename);
            $rent->image = $filename;
        }

        $rent->title = $request['title'];
        $rent->description = $request['description'];
        $rent->button_text = $request['button_text'];
        $rent->button_link = $request['button_link'];
        $rent->phone_number = $request['phone_number'];
        $rent->created_at = null;
        $rent->updated_at = date("Y-m-d H:i:s");

        $rent->update();

        return redirect('rent')->with('success', 'RentGuarantee updated successfully');
    }

    function destroy($id)
    {
        $rent = RentGuarantee::find($id);
        if ($rent) {
            //Delete previous file
            $destinantion = 'public/uploads/' . $rent->image;
            if (File::exists($destinantion)) {
                File::delete($destinantion);
            }

            $rent->delete();
            return redirect('rent')->with('success', 'RentGuarantee deleted successfully');
        } else {
            return redirect('rent')->with('success', 'No RentGuarantee found to delete');
        }
    }
}


