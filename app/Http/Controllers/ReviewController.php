<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function index() {
        $reviews = Review::orderBy('id', 'desc')->get();

        return view('admin.reviews.index', compact('reviews'));
    }

    public function store(Service $service, Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'comment' => 'required',
            'rating' => 'required',
        ]);

        $data = $request->all();
        $data['service_id'] = $service->id;

        if(Auth::check()) {
            $data['user_id'] = Auth::id();
        }

        Review::create($data);

        return redirect()->back()->with('success', 'Review saved successfully');
    }

    public function update(Review $review) {
        $review->update(['is_approved' => !$review->is_approved]);

        return redirect()->back()->with('success', 'Review visibility updated successfully');
    }
}
