<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ClientController extends Controller
{
    function index()
    {
        $client = Client::all();
        return view('admin.client.index', compact('client'));
    }

    function create()
    {
        return view('admin.client.create');
    }

    function store(Request $request)
    {
        $request->validate([
            'image' => [
                'required',
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,webp',
                // \Illuminate\Validation\Rule::dimensions()->maxWidth(1200)->maxHeight(900),
            ]
        ]);

        $client = new Client;

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/client'), $filename);
            $fullPath = url('uploads/client/' . $filename);
            $client->image = $fullPath;
        }

        $client->title = $request['title'];
        
        $client->created_at = date("Y-m-d H:i:s");
        $client->updated_at = null;

        $client->save();

        return redirect('client')->with('success', 'Client added successfully');
    }

    function edit($id)
    {
        $client = Client::find($id);
        return view('admin.client.edit', compact('client'));
    }

    function update(Request $request, $id)
    {
        // $request->validate([
        //     'title' => 'required',
        //     'sub_title' => 'required'
        // ]);

        $client = Client::find($id);

        if ($request->hasfile('image')) {
            $destination = 'uploads/client/' . $client->image;
            $imageName = basename($destination);
            if (File::exists('uploads/client/' . $imageName)) {
                File::delete('uploads/client/' . $imageName);
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/client'), $filename);
            $fullPath = url('uploads/client/' . $filename);
            $client->image = $fullPath;
        }

        $client->title = $request['title'];
       
        $client->created_at = null;
        $client->updated_at = date("Y-m-d H:i:s");

        $client->update();

        return redirect('client')->with('success', 'Client updated successfully');
    }

    function destroy($id)
    {
        $client = Client::find($id);
        if ($client) {
            //Delete previous file
            $destinantion = 'uploads/client/' . $client->image;
            if (File::exists($destinantion)) {
                File::delete($destinantion);
            }

            $client->delete();
            return redirect('client')->with('success', 'Client deleted successfully');
        } else {
            return redirect('client')->with('success', 'No Client found to delete');
        }
    }
}

