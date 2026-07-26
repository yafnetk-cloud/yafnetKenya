<?php

if (!function_exists('cloudinary_image_url')) {
    function cloudinary_image_url($path)
    {
        if (!$path) {
            return null;
        }
        try {
            return \Illuminate\Support\Facades\Storage::disk('cloudinary')->url($path);
        } catch (\Throwable $e) {
            return null;
        }
    }
}