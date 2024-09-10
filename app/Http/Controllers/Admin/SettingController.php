<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        return view('backend.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'nullable|string',
            'site_title' => 'nullable|string',
            'site_short_description' => 'nullable|string',
            'site_description' => 'nullable|string',
            'keyword' => 'nullable|string',
            'site_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'site_share_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'site_favicon' => 'nullable|image|mimes:ico,png|max:1024'
        ]);

        $settings = Setting::first();

        if ($request->hasFile('site_image')) {
            // Delete the old image if it exists
            if ($settings->site_image && Storage::exists($settings->site_image)) {
                Storage::delete($settings->site_image);
            }

            // Process the new image
            $image = $request->file('site_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
         

            // Resize and save the image using Intervention Image
            $img = Image::make($image)->resize(800, 600)->save(public_path('images/siteimage/' . $filename));
            
            // Store the filename in the database
            $settings->site_image = $filename;

            // Store the image path
           
        }

        if ($request->hasFile('site_share_image')) {
            // Delete the old image if it exists
            if ($settings->site_share_image && Storage::exists($settings->site_share_image)) {
                Storage::delete($settings->site_share_image);
            }

            // Process the new image
            $image = $request->file('site_share_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
           // Resize and save the image using Intervention Image
           $img = Image::make($image)->resize(800, 600)->save(public_path('images/siteimage/' . $filename));
            
           // Store the filename in the database
           $settings->site_share_image = $filename;

           // Store the image path

            // Store the image path
            
        }

        if ($request->hasFile('site_favicon')) {
            // Delete the old favicon if it exists
            if ($settings->site_favicon && Storage::exists($settings->site_favicon)) {
                Storage::delete($settings->site_favicon);
            }

            // Process the new favicon
            $image = $request->file('site_favicon');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $filepath = 'images/siteimage/' . $filename;

            // Resize and save the favicon
            $img = Image::make($image)->resize(800, 600)->save(public_path('images/siteimage/' . $filename));
            
           // Store the filename in the database
           $settings->site_favicon = $filename;
        
        }

        // Update other settings fields
        $settings->site_name = $request->input('site_name');
        $settings->site_title = $request->input('site_title');
        $settings->site_short_description = $request->input('site_short_description');
        $settings->site_description = $request->input('site_description');
        $settings->keyword = $request->input('keyword');

        $settings->save();

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully');
    }
}
