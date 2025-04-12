<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $services = Service::orderBy('id', 'desc')->paginate(10);
        $services = Service::query()->withAvg('reviews', 'rating')->orderBy('id', 'desc')->paginate(10);
        
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        
        // Return the create service form page
        return view('admin.services.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name.en' => 'required|string',
            'name.ro' => 'required|string',
            'slug' => 'required|unique:services,slug',
            'description.en' => 'required',
            'description.ro' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ]);
        
        $data = $request->all();

        // dd($data);

        if($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnail', 'public');
        } else {
            $data['thumbnail'] = null;
        }

        $service = Service::create($data);

        return redirect('/admin/services/'. $service->id .'/faq')->with('success', 'Service created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::find($id);
        $categories = Category::all();

        return view('admin.services.edit', compact('service', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service = Service::find($id);

        $request->validate([
            'name.en' => 'required|string',
            'name.ro' => 'required|string',
            'slug' => [
                'required',
                Rule::unique('posts', 'slug')->ignore($service->id),
            ],
            'description.en' => 'required',
            'description.ro' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ]);
        
        $data = $request->all();

        // dd($data);

        if($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('categories', 'public');

            if($service->thumbnail) {
                Storage::disk('public')->delete($service->thumbnail);
            }
        }

        $service->update($data);

        return redirect('/admin/services/'. $service->id .'/faq')->with('success', 'Service updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::find($id);
        
        // Delete the image
        if($service->thumbnail) {
            Storage::disk('public')->delete($service->thumbnail);
        }

        $service->delete();

        // Redirect to the services page with a success message
        return redirect('/admin/services')->with('success', 'Service deleted successfully');
    }
}
