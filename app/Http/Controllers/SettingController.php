<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::pluck('value', 'key');
        return view('settings.index', compact('settings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $logo = '';
        if ($request->hasFile('logo')) {
            $logo = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('storage/settings/logo'), $logo);
        }
        $settings = $request->except(['logo', '_token']);
        if(!empty($request->logo)){
            $settings['logo'] = $logo;
        }
        foreach ($settings as $key => $value) {
            $setting = Setting::where('key', '=', $key)->first();
            if (is_null($setting)) {
                $setting = new Setting();
            }
            $setting->key = $key;
            $setting->value = $value;
            $setting->save();
        }
        return redirect()->route('settings.index')->with('message', 'Settings added Successfully.');
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
    public function edit($id)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
