<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

function contactHelper(){
    return $contact=DB::table('contact')->first();
}