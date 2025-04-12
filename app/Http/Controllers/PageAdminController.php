<?php

namespace App\Http\Controllers;

use App\Models\HomepageContent;
use App\Models\Page;
use App\Models\Service;
use App\Models\Slider;
use Illuminate\Http\Request;

class PageAdminController extends Controller
{
    /**
     * This controller for controll the client side `pages`
     */

    public function adminSliders() {
        $sliders = Slider::get();

        return view('admin.pages.sliders', compact('sliders'));
    }

    public function sliderStore(Request $request) {
        $request->validate([
            'main-text' => 'required',
            'button-text' => 'required',
            'button-link' => 'required',
            'main-image' => 'required',
        ]);

        $data = $request->all();

        if($request->hasFile('main-image')) {
            $data['main-image'] = $request->file('main-image')->store('main-image', 'public');
        }
        
        if($request->hasFile('bg-image')) {
            $data['bg-image'] = $request->file('bg-image')->store('bg-image', 'public');
        }

        Slider::create($data);

        return redirect()->back()->with('success', 'Slider created successfully');
    }

    public function home() {
        $homepage_content = HomepageContent::get();

        $services = Service::where('status', 'published')->orderBy('id', 'desc')->get();

        $featured_services_id = HomepageContent::where('section', 'featured_services')->first();
        $decoded = json_decode($featured_services_id->data, true);
        $values = array_values($decoded);
        $featured_services = Service::whereIn('id', $values)->get();
        
        return view('admin.pages.home', compact('homepage_content', 'services', 'featured_services'));
    }

    public function insta() {
        $insta = HomepageContent::where('type', 'insta')->orderBy('id', 'desc')->get();

        return view('admin.pages.home-insta', compact('insta'));
    }

    public function about() {
        $page = Page::where('slug', 'about')->first();

        return view('admin.pages.about', compact('page'));
    }
    
    public function termsConditions() {
        $page = Page::where('slug', 'terms-conditions')->first();

        return view('admin.pages.terms-conditions', compact('page'));
    }
    
    public function refundPolicy() {
        $page = Page::where('slug', 'refund-policy')->first();

        return view('admin.pages.refund-policy', compact('page'));
    }

    public function store_page(Request $request) {
        $page = Page::where('slug', $request->input('slug'))->first();

        $data = $request->except(['_method', '_token']); // Exclude unnecessary fields

        if(!$page) {
            Page::create($data);
        } else {
            $page->update($data);
        }

        return redirect()->back()->with('success', 'Updated successfully');
    }
}
