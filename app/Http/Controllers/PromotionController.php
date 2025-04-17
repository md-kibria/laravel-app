<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromotionController extends Controller
{
    public function create()
    {
        $promotions = Promotion::orderBy('id', 'desc')->get();

        return view('admin.promotion.create', compact('promotions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sub_title.en' => 'required|string',
            'sub_title.ro' => 'required|string',
            'title.en' => 'required|string',
            'title.ro' => 'required|string',
        ]);

        $data = $request->all();

        if (request('image')) {
            $data['image'] = request('image')->store('promotions', 'public');
        }

        Promotion::create($data);

        return redirect()->back()->with('success', 'Promotion created successfully.');
    }

    public function edit(Promotion $promotion)
    {
        return view('admin.promotion.edit', compact('promotion'));
    }
    
    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            'sub_title.en' => 'required|string',
            'sub_title.ro' => 'required|string',
            'title.en' => 'required|string',
            'title.ro' => 'required|string',
        ]);

        $data = $request->all();

        if (request('image')) {
            $data['image'] = request('image')->store('promotions', 'public');

            if ($promotion->image) {
                Storage::disk('public')->delete($promotion->image);
            }
        }

        $promotion->update($data);

        return redirect('/admin/promotions')->with('success', 'Promotion updated successfully.');
    }

    public function destroy(Promotion $promotion)
    {
        if ($promotion->image) {
            Storage::disk('public')->delete($promotion->image);
        }

        $promotion->delete();

        return redirect()->back()->with('success', 'Promotion deleted successfully.');
    }

    
}
