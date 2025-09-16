<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (! function_exists('setting')) {
    /**
     * Return setting value by key. If value is JSON it returns decoded array.
     */
   function setting(string $key, $default = null)
{
    $all = Cache::rememberForever('settings.all', function () {
        return Setting::pluck('value', 'key')->toArray();
    });

    if (! array_key_exists($key, $all)) {
        return $default;
    }

    $val = $all[$key];

    // safety check: only decode if it's a string
    if (is_string($val)) {
        $decoded = json_decode($val, true);
        return json_last_error() === JSON_ERROR_NONE ? $decoded : $val;
    }

    return $val; // agar already array hai to waise ka waise return karo
}
}

