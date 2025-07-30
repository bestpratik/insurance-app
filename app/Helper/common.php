<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

function contactHelper(){
    return $contact=DB::table('contact')->first();
}

// function termsConditions()
// {
//     $terms = DB::table('contents')->first();
//     return view('terms_conditions', compact('terms'));
// }