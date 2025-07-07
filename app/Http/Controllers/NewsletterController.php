<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function index()
    {
        $newsletter_list = Newsletter::all();
        return view('admin.newsletter_list.index', compact('newsletter_list'));
    }
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email_id' => 'required|email|unique:newsletters,email_id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first('email_id')
            ]);
        }
        Newsletter::create([
            'email_id' => $request->email_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for subscribing!'
        ]);
    }
}
