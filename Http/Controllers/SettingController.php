<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Setting\Models\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('setting::index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit(Setting $setting)
    {
        return view('setting::edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, Setting $setting)
    {
        // Checkbox
        if ($setting->type == 'checkbox') {
            $request->value = $request->has('value');
        }

        // File
        if ($setting->type == 'file') {
            $file = $request->file('value');
            $fileName = $setting->key . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fileName);

            $request->value = $file ? $fileName : $setting->value;
        }

        $setting->update(['value' => $request->value]);

        cache()->forget('settings');

        return back()->withSuccess('Successfully saved');
    }
}
