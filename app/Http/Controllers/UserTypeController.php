<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usertype;

class UserTypeController extends Controller
{
    public function index()
    {
        $usertypes = Usertype::where('status', 1)->get();
        return view('usertype.index', compact('usertypes'));
    }

    public function create()
    {
        return view('usertype.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_name' => 'required|unique:usertypes,type_name',
       ]);

       $usertype = new Usertype;
       $usertype->type_name = $request->type_name;
       $usertype->save();

        return redirect('usertypes')->with('success', 'User type created successfully');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $usertype = Usertype::find($id);
        return view('usertype.edit', compact('usertype'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'type_name' => 'required|unique:usertypes,type_name,' . $id,
       ]);

       $usertype = Usertype::find($id);
       $usertype->type_name = $request->type_name;
    //    dd($usertype);
       $usertype->update();

       return redirect('usertypes')->with('success', 'User type updated successfully');
    }

    public function destroy(string $id)
    {
         $usertype = Usertype::find($id);
        if($usertype){
            $usertype->delete();
            return redirect('usertypes')->with('success', 'User type deleted Successfully');
        }else{
            return redirect('usertypes')->with('success', 'No data find to delete'); 
        }
    }
}
