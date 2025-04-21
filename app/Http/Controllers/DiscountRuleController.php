<?php

namespace App\Http\Controllers;

use App\Models\DiscountRule;
use App\Models\Service;
use Illuminate\Http\Request;

class DiscountRuleController extends Controller
{
    public function index() 
    {
        // Fetch all discount rules from the database
        $discountRules = DiscountRule::all();

        // $services = Service::with('variationTypes')->with('variationTypes.variations')->orderBy('id', 'desc')->get();
        $services = Service::with('variationTypes.variations')->orderBy('id', 'desc')->get();
        
        // Return the discount rules as a JSON response
        return view('admin.discounts.index', compact('discountRules', 'services'));
    }

    /* this function is not using */
    public function show($id) 
    {
        // Fetch a specific discount rule by ID
        $discountRule = DiscountRule::findOrFail($id);

        // Return the discount rule as a JSON response
        return response()->json($discountRule);
    }
    public function store(Request $request) 
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'service_id' => 'required|exists:services,id',
            'variation_type_id' => 'required|exists:variation_types,id',
            'variation_id' => 'required|exists:variations,id|unique:discount_rules,variation_id,NULL,id,service_id,' . $request->service_id . ',variation_type_id,' . $request->variation_type_id,
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric',
        ]);

        // Create a new discount rule
        DiscountRule::create($validatedData);

        // Return the created discount rule as a JSON response
        return redirect()->back()->with('success', 'Discount rule created successfully.');
    }

    /* this function is not using */
    public function update(Request $request, $id) 
    {
        // Fetch the discount rule by ID
        $discountRule = DiscountRule::findOrFail($id);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'service_id' => 'sometimes|required|exists:services,id',
            'variation_id' => 'sometimes|required|exists:variations,id',
            'type' => 'sometimes|required|in:percentage,fixed',
            'value' => 'sometimes|required|numeric',
        ]);

        // Update the discount rule with the validated data
        $discountRule->update($validatedData);

        // Return the updated discount rule as a JSON response
        return response()->json($discountRule);
    }

    public function destroy($id) 
    {
        // Fetch the discount rule by ID
        $discountRule = DiscountRule::findOrFail($id);

        // Delete the discount rule
        $discountRule->delete();

        // Return a success response
        return redirect()->back()->with('success', 'Discount rule deleted successfully.');
    }
    
    public function applyDiscount(Request $request) 
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'service_id' => 'required|exists:services,id',
            'variation_id' => 'required|exists:variations,id',
            'price' => 'required|numeric',
        ]);

        // Fetch the discount rules for the specified service and variation
        $discountRules = DiscountRule::where('service_id', $validatedData['service_id'])
            ->where('variation_id', $validatedData['variation_id'])
            ->get();

        // Calculate the final price after applying discounts
        $finalPrice = $validatedData['price'];
        foreach ($discountRules as $rule) {
            if ($rule->type === 'percentage') {
                $finalPrice -= ($finalPrice * ($rule->value / 100));
            } elseif ($rule->type === 'fixed') {
                $finalPrice -= $rule->value;
            }
        }

        // Return the final price as a JSON response
        return response()->json(['final_price' => $finalPrice]);
    }
}
