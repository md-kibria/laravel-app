<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'slug' => 'required'
        ]);

        $data = $request->all();

        if($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        Category::create($data);

        return back()->with('success', 'Category created successfully');
    }

    public function edit(Category $category) {

        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'slug' => 'required'
        ]);

        $data = $request->all();

        if($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
            
            if($category->image) {
                Storage::disk('public')->delete($category->image);
            }

        }

        $category->update($data);

        return redirect('/admin/categories')->with('success', 'Category Updated');
    }

    public function destroy(Category $category) {
        if($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect('/admin/categories')->with('success', 'Category Deleted');
    }
}
