<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomepageContent;
use Illuminate\Support\Facades\Storage;

class HomepageContentController extends Controller
{
    public function update(Request $request)
    {

        $request->validate([
            // 'sub_title.en' => 'required|string',
            // 'sub_title.ro' => 'required|string',
            // 'title.en' => 'required|string',
            // 'title.ro' => 'required|string',
            // // 'section' => 'required|unique:homepage_contents,section',
            // 'description.en' => 'required',
            // 'description.ro' => 'required',
        ]);

        // $data = $request->all();
        $data = $request->except(['_method', '_token']); // Exclude unnecessary fields

        $homepage_content = HomepageContent::where('section', $request->input('section'))->first();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('homepage-image', 'public');

            if ($homepage_content->image) {
                Storage::disk('public')->delete($homepage_content->image);
            }
        }

        if ($data['featured_service']) {
            $data['data'] = json_encode($data['featured_service']);
        }

        if (!$homepage_content) {
            HomepageContent::create($data);
        } else {
            $homepage_content->update($data);
        }

        return redirect()->back()->with('success', 'Data updated successfully');
    }

    public function insta_update(Request $request)
    {

        // $data = $request->all();
        $data = $request->except(['_method', '_token']); // Exclude unnecessary fields


        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('insta-image', 'public');
        }


        HomepageContent::create($data);

        return redirect()->back()->with('success', 'Data updated successfully');
    }

    public function insta_delete($id) {
        $item = HomepageContent::findOrFail($id);

        if($item->image) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();

        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
