<?php
namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class SettingsController extends Controller
{
    //
    // public function index()
    // {
    //     // Tab-wise grouping for the view
    //     $settings = Setting::all()->groupBy('group');

    //     return view('admin.settings.index', [
    //         'general'  => $settings['general'] ?? collect(),
    //         'branding' => $settings['branding'] ?? collect(),
    //         'email'    => $settings['email'] ?? collect(),
    //     ]);
    // }

    public function index()
    {
        return view('admin.settings.index');
    }

    public function update(Request $request)
    {
        // validate
        $data = $request->validate([
            'site_name'       => 'nullable|string|max:191',
            'theme_color'     => 'nullable|string|max:30',
            'from_email'      => 'nullable|email',
            'from_name'       => 'nullable|string|max:191',
            'footer_text'     => 'nullable|string',
            'email_signature' => 'nullable|string',
            'facebook'        => 'nullable|url',
            'linkedin'        => 'nullable|url',
            'twitter'         => 'nullable|url',
            'site_logo'       => 'nullable|image|max:4096', // up to 4MB
            'favicon'         => 'nullable|image|max:2048',
        ]);

        // 1) scalar settings
        foreach (['site_name', 'theme_color', 'from_email', 'from_name', 'footer_text', 'email_signature'] as $k) {
            if (array_key_exists($k, $data) && $data[$k] !== null) {
                Setting::updateOrCreate(['key' => $k], ['value' => $data[$k], 'group' => 'general']);
            }
        }

        // 2) social links as json
        $social = [
            'facebook' => $data['facebook'] ?? null,
            'linkedin' => $data['linkedin'] ?? null,
            'twitter'  => $data['twitter'] ?? null,
        ];
        Setting::updateOrCreate(['key' => 'social_links'], ['value' => $social, 'group' => 'footer']);

        // 3) file uploads stored in public/logo and public/favicon (directly)
        if ($request->hasFile('site_logo')) {
            $file   = $request->file('site_logo');
            $name   = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $folder = 'logos';
            $dest   = public_path($folder);
            if (! File::exists($dest)) {
                File::makeDirectory($dest, 0755, true);
            }

            // delete old if exists
            $old = setting('site_logo');
            if ($old && File::exists(public_path($old))) {
                @unlink(public_path($old));
            }
            // move file
            $file->move($dest, $name);
            $value = $folder . '/' . $name;
            Setting::updateOrCreate(['key' => 'site_logo'], ['value' => $value, 'group' => 'branding']);
        }

        if ($request->hasFile('favicon')) {
            $file   = $request->file('favicon');
            $name   = 'favicon_' . time() . '.' . $file->getClientOriginalExtension();
            $folder = 'favicons';
            $dest   = public_path($folder);
            if (! File::exists($dest)) {
                File::makeDirectory($dest, 0755, true);
            }

            $old = setting('favicon');
            if ($old && File::exists(public_path($old))) {
                @unlink(public_path($old));
            }
            $file->move($dest, $name);
            $value = $folder . '/' . $name;
            Setting::updateOrCreate(['key' => 'favicon'], ['value' => $value, 'group' => 'branding']);
        }

        // clear settings cache so helper picks up new values
        Cache::forget('settings.all');

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
