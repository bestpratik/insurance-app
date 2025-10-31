<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function index()
    {
        $claim = Claim::all();
        return view('admin.claim.index', compact('claim'));
    }

    public function create()
    {
        return view('admin.claim.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $claim = new Claim;

        $claim->title = $request['title'];
        $claim->description = $request['description'];
        $claim->created_at = date("Y-m-d H:i:s");
        $claim->updated_at = null;

        $claim->save();

        return redirect('claim')->with('message', 'Claim added successfully');
    }

    public function edit($id)
    {
        $claim = Claim::find($id);
        return view('admin.claim.edit', compact('claim'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $claim = Claim::find($id);

        $claim->title = $request['title'];
        $claim->description = $request['description'];
        $claim->created_at = null;
        $claim->updated_at = date("Y-m-d H:i:s");

        $claim->update();

        return redirect('claim')->with('message', 'Claim updated successfully');
    }

    public function destroy($id)
    {
        $claim = Claim::find($id);
        if ($claim) {
            $claim->delete();
            return redirect('claim')->with('message', 'Claim deleted successfully');
        } else {
            return redirect('claim')->with('message', 'No Claim found to delete');
        }
    }
}
