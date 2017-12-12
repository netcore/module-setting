<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Setting\Models\Setting;
use Netcore\Translator\Helpers\TransHelper;
use Nwidart\Modules\Facades\Module;

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
     * @param Setting $setting
     * @return Response
     */
    public function edit(Setting $setting)
    {
        $mediaModule = Module::find('media');

        return view('setting::edit', compact('setting', 'mediaModule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param Setting  $setting
     * @return Response
     */
    public function update(Request $request, Setting $setting)
    {
        $translations = $request->get('translations', []);

        // Set universal value across all languages
        if (!$setting->is_translatable && !$setting->is('file')) {
            foreach (TransHelper::getAllLanguages() as $language) {
                $translations[$language->iso_code] = [
                    'value' => $request->get('value', '')
                ];
            }
        }

        // Checkbox
        if ($setting->is('checkbox')) {
            foreach ($translations as $languageId => &$data) {
                $data['value'] = array_get($data, 'value', 0) ?: 0;
            }
        }

        // File
        if ($setting->is('file')) {
            $files = $setting->is_translatable ? $request->file('translations') : $request->file('value');

            $path = public_path(config('setting.upload_path'));
            if (!\File::exists($path)) {
                \File::makeDirectory($path, 0775, true);
            }

            if ($setting->is_translatable) {
                foreach (TransHelper::getAllLanguages() as $language) {
                    $file = isset($files[$language->iso_code]) ? $files[$language->iso_code]['value'] : null;
                    if (!$file) {
                        continue;
                    }

                    $fileName = str_slug($setting->key) . '-' . $language->iso_code . '.' . $file->getClientOriginalExtension();
                    $file->move($path, $fileName);

                    $translations[$language->iso_code] = [
                        'value' => $fileName
                    ];
                }
            } else {
                $file = $files;
                if (!$file) {
                    return back()->withErrors('File is required.');
                }

                $fileName = str_slug($setting->key) . '.' . $file->getClientOriginalExtension();
                $file->move($path, $fileName);

                foreach (TransHelper::getAllLanguages() as $language) {
                    $translations[$language->iso_code] = [
                        'value' => $fileName
                    ];
                }
            }
        }

        $setting->updateTranslations($translations);

        setting()->clear_cache();

        return back()->withSuccess('Successfully saved');
    }
}
