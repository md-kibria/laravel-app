<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Service;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function create(Service $service) {
        $faqs = Faq::where('service_id', $service->id)->get();
        
        return view('admin.faqs.create', compact('service', 'faqs'));
    }

    public function store(Request $request) {
        $request->validate([
            'question.en' => 'required|string',
            'question.ro' => 'required|string',
            'answer.en' => 'required|string',
            'answer.ro' => 'required|string',
            'service_id' => 'required'
        ]);

        $data = $request->all();

        Faq::create($data);

        return back()->with('success', 'FAQ added successfully');
    }

    public function edit(Faq $faq) {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq) {
        $request->validate([
            'question.en' => 'required|string',
            'question.ro' => 'required|string',
            'answer.en' => 'required|string',
            'answer.ro' => 'required|string',
        ]);

        $data = $request->all();

        $faq->update($data);

        return redirect('admin/services/'. $faq->service_id .'/faq')->with('success', 'FAQ Updated Successfully');
    }

    public function destroy(Faq $faq) {
        $faq->delete();

        return redirect()->back()->with('success', 'FAQ Deleted');
    }
}
