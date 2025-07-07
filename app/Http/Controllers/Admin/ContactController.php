<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    function index()
    {
        $contact = Contact::all();
        return view('admin.contact.index', compact('contact'));
    }

    function create()
    {
        return view('admin.contact.create');
    }

    function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'link1' => 'nullable|url',
            'link2' => 'nullable|url',
            'link3' => 'nullable|url',
            'link4' => 'nullable|url'
        ]);

        $contact = new Contact;

        $contact->address = $request['address'];
        $contact->phone = $request['phone'];
        $contact->email = $request['email'];
        $contact->link1 = $request['link1'];
        $contact->link2 = $request['link2'];
        $contact->link3 = $request['link3'];
        $contact->link4 = $request['link4'];


        $contact->created_at = date("Y-m-d H:i:s");
        $contact->updated_at = null;

        $contact->save();

        return redirect('contact')->with('message', 'Contact added successfully');
    }

    function edit($id)
    {
        $contact = Contact::find($id);
        return view('admin.contact.edit', compact('contact'));
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required'

        ]);

        $contact = Contact::find($id);

        $contact->address = $request['address'];
        $contact->phone = $request['phone'];
        $contact->email = $request['email'];
        $contact->link1 = $request['link1'];
        $contact->link2 = $request['link2'];
        $contact->link3 = $request['link3'];
        $contact->link4 = $request['link4'];


        $contact->created_at = null;
        $contact->updated_at = date("Y-m-d H:i:s");

        $contact->update();

        return redirect('contact')->with('message', 'Contact updated successfully');
    }

    function destroy($id)
    {
        $contact = Contact::find($id);
        if ($contact) {


            $contact->delete();
            return redirect('contact')->with('message', 'Contact deleted successfully');
        } else {
            return redirect('contact')->with('message', 'No Contact found to delete');
        }
    }
}
