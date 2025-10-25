<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{


    public function index()
    {
        $faqs = Faq::all();
        return view('admin.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);

        $faqs = new Faq;

        $faqs->question = $request['question'];
        $faqs->answer = $request['answer'];
        $faqs->created_at = date("Y-m-d H:i:s");
        $faqs->updated_at = null;

        $faqs->save();

        return redirect('faq')->with('message', 'FAQ added successfully');
    }

    public function edit(string $id)
    {
        $faqs = Faq::find($id);
        return view('admin.faq.edit', compact('faqs'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);

        $faqs = Faq::find($id);

        $faqs->question = $request['question'];
        $faqs->answer = $request['answer'];
        $faqs->created_at = null;
        $faqs->updated_at = date("Y-m-d H:i:s");

        $faqs->update();

        return redirect('faq')->with('message', 'FAQ updated successfully');
    }

    public function destroy(string $id)
    {
        $faqs = Faq::find($id);
        if ($faqs) {
            $faqs->delete();
            return redirect('faq')->with('message', 'FAQ deleted successfully');
        } else {
            return redirect('faq')->with('message', 'No FAQ found to delete');
        }
    }
}
