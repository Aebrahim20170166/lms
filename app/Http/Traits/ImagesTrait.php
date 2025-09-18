<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

trait ImagesTrait
{
    /**
     * Upload image to storage/app/public/{path}
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $fileName
     * @param string $path
     * @param string|null $oldFile
     * @return void
     */
    private function uploadImage($file, $fileName, $path, $oldFile = null)
    {
        // Ensure symbolic link exists: public/storage → storage/app/public
        if (!is_link(public_path('storage'))) {
            Artisan::call('storage:link');
        }

        // Ensure directory exists in storage/app/public/{path}
        $fullPath = storage_path('app/public/' . $path);
        if (!File::exists($fullPath)) {
            File::makeDirectory($fullPath, 0755, true);
        }

        // Upload the file
        $file->storeAs('public/' . $path, $fileName);
        // Delete old file if exists
        if (!is_null($oldFile) && Storage::exists('public/' . $path . '/'  . $oldFile)) {
            Storage::delete('public/' . $path . '/'  . $oldFile);
        }
    }
    private function deleteImage($path, $fileName)
    {
        Storage::delete('public/' . $path . '/'  . $fileName);
    }
}
