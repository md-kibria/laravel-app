<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Variation;
use App\Models\VariationType;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    public function variation_types(Service $service)
    {
        $variation_types = VariationType::where('service_id', $service->id)->get();

        return view('admin.variation.variation-types', compact('service', 'variation_types'));
    }

    public function variation_types_store(Request $request, Service $service)
    {
        $request->validate([
            'name.en' => 'required|string',
            'name.ro' => 'required|string',
            'type' => 'required|string',
        ]);
        $data = $request->all();
        $data['service_id'] = $service->id;

        VariationType::create($data);

        return redirect()->back()->with('success', 'Variation type created successfully.');
    }

    public function variation_types_edit(VariationType $variation_type)
    {
        return view('admin.variation.variation-type-edit', compact('variation_type'));
    }

    public function variation_types_update(Request $request, VariationType $variation_type)
    {
        $request->validate([
            'name.en' => 'required|string',
            'name.ro' => 'required|string',
            'type' => 'required|string',
        ]);

        $variation_type->update($request->all());

        return redirect('/admin/services/' . $variation_type->service_id . '/variation-types')->with('success', 'Variation type updated successfully.');
    }

    public function variation_types_destroy(VariationType $variation_type)
    {
        $variation_type->delete();

        return redirect()->back()->with('success', 'Variation type deleted successfully.');
    }

    public function variations(VariationType $variation_type)
    {
        $variations = Variation::where('variation_type_id', $variation_type->id)->get();

        return view('admin.variation.variations', compact('variation_type', 'variations'));
    }

    public function variations_store(Request $request, VariationType $variation_type)
    {
        $request->validate([
            'name.en' => 'required|string',
            'name.ro' => 'required|string',
            'price' => 'nullable|numeric',
            'type' => 'nullable|string',
        ]);
        $data = $request->all();
        $data['variation_type_id'] = $variation_type->id;

        Variation::create($data);

        return redirect()->back()->with('success', 'Variation created successfully.');
    }

    public function variations_edit(Variation $variation)
    {
        return view('admin.variation.variation-edit', compact('variation'));
    }

    public function variations_update(Request $request, Variation $variation)
    {
        $request->validate([
            'name.en' => 'required|string',
            'name.ro' => 'required|string',
            'price' => 'nullable|numeric',
            'type' => 'nullable|string',
        ]);

        $variation->update($request->all());

        return redirect('/admin/services/variation-types/' . $variation->variation_type_id . '/variations')->with('success', 'Variation updated successfully.');
    }

    public function variations_destroy(Variation $variation)
    {
        $variation->delete();

        return redirect()->back()->with('success', 'Variation deleted successfully.');
    }
}
