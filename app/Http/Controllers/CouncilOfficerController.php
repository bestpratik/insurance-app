<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Councilofficer;
use App\Models\Council;
use App\Models\Usertype;
use App\Models\User;
use Hash;

class CouncilOfficerController extends Controller
{
    
    public function index()
    {
        $CouncilOfficers = Councilofficer::with(['user', 'council'])->where('status', 1)->get();
        // dd($CouncilOfficers);
        return view('councilofficer.index', compact('CouncilOfficers'));
    }

    
    public function create()
    {
        $councils = Council::where('status', 1)->get();
        return view('councilofficer.create', compact('councils'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => 'required|confirmed|min:8',
        ]);

        
        $usertype = Usertype::where('slug', 'council-officer')->first();
        // dd($usertype);

        $user = new User;
        $user->name = $request->name ;
        $user->email = $request->email;
        $user->type = $usertype->id;
        $user->council_id = $request->council_id;
        $user->password = Hash::make($request->password);
        $user->save();

        $councilofficer = new Councilofficer;
        $councilofficer->user_id = $user->id;
        $councilofficer->council_id = $user->council_id;
        $councilofficer->save();

        return redirect('council-officers')->with('success', 'Council Officer created successfully');

    }

    
    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        //
    }

    
    public function update(Request $request, string $id)
    {
        //
    }

    
    public function destroy(string $id)
    {
        //
    }
}
