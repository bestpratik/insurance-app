<?php

namespace App\Http\Controllers;

use App\Models\Contactform;
use Illuminate\Http\Request;

class ContactformController extends Controller
{
    public function index()
    {
        $contactform_list = Contactform::all();
        return view('admin.contactform_list.index', compact('contactform_list'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|min:10|max:15',
            'email' => 'required|email',
            'comment' => 'nullable|string',
        ]);

        Contactform::create($request->only([
            'name',
            'phone',
            'email',
            'comment'
        ]));

        return response()->json(['message' => 'Your comment has been submitted successfully!']);
    }
}
