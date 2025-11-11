<?php

namespace App\Http\Controllers;

use App\Models\Contactform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ContactformController extends Controller
{
    public function index()
    {
        $contactform_list = Contactform::all();
        return view('admin.contactform_list.index', compact('contactform_list'));
    }

    public function store(Request $request)
    {
        // Use Validator instead of $request->validate()
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'g-recaptcha-response' => 'required',
        ], [
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.'
        ]);

        if ($validator->fails()) {
            // Return JSON response for AJAX
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Verify Google reCAPTCHA
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
        ]);

        if (!$response->json('success')) {
            return response()->json([
                'errors' => ['g-recaptcha-response' => ['Invalid reCAPTCHA. Please try again.']]
            ], 422);
        }

        // Save form
        $contactform_list = new Contactform();
        $contactform_list->name = $request->name;
        $contactform_list->phone = $request->phone;
        $contactform_list->email = $request->email;
        $contactform_list->comment = $request->comment;
        $contactform_list->save();

        return response()->json(['message' => 'Your comment has been submitted successfully!']);
    }

    public function contactform_destroy($id)
    {
        $contactform_list = Contactform::find($id);
        if ($contactform_list) {
            $contactform_list->delete();
            return redirect()->back()->with('message', 'Form deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'No data found to delete.');
        }
    }
}
