<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SiteSetting;

class SiteSettingController extends Controller
{
    public function index()  // for fetching
    {
        $sitesettings = SiteSetting::all()->pluck('value', 'key');
        return view('sitesettings.index', compact('sitesettings'));
    }

    // public function create() // for creating a new setting
    // {
    //     return view('backend.create');
    // }

    public function store(Request $request) // for store
{
    try {
        $image = '';
        if ($request->image && $request->hasFile('image')) {
            $file = $request->image;
            $filename = time() . '-' . rand(1000, 100000) . '-' . $file->getClientOriginalName();
            $path = public_path('/site_setting_upload'); 
            $file->move($path, $filename);
            $image = $filename;
        }

        // Set the settings
        SiteSetting::set('header_logo', $image); // Store image path
        SiteSetting::set('footer_logo', $request->footer);
        SiteSetting::set('contact_number', $request->contact);
        SiteSetting::set('copyright', $request->email);
       
        $request->session()->flash('success', 'Data inserted successfully');
        return redirect()->route('sitesettings.index');

    } catch (\Exception $e) {
        $request->session()->flash('error', 'Something went wrong');
        return redirect()->route('sitesettings.index');
    }
}

    public function edit($id) // for editing
    {
        $sitesetting = SiteSetting::find($id);
        if ($sitesetting) {
            return view('sitesettings.index', compact('sitesetting'));
        }
        return redirect()->back();
    }

    public function delete($id) // for deleting
    {
        $sitesetting = SiteSetting::find($id);
        if ($sitesetting) {
            $sitesetting->delete();
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function update(Request $request, $id) // for updating
    {
        $sitesetting = SiteSetting::find($id);
        if ($sitesetting) {
            $data = [
                'key' => $request->get('key'),
                'value' => $request->get('value'),
            ];
            SiteSetting::where('id', $id)->update($data);
            return redirect()->route('backend.index');
        }
        return redirect()->back();
    }
}
