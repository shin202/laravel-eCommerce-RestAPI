<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FirebaseStorageService
{
    /**
     * Store image to Firebase Storage.
     * 
     * @param \Illuminate\Http\UploadedFile|\Illuminate\Http\UploadedFile[]|array|null $request
     * @param string $collection Name of firebase collection.
     * @param string $name Name of the image.
     * @return string  Return an image path.
     */
    public function storeImage($request, $collection, $name)
    {
        $storage = app('firebase.storage');
        $defaultBucket = $storage->getBucket();
        $ext = $request->getClientOriginalExtension();
        $filename = $name . '-' . Str::random(10) . time() . '.' . $ext;
        $firebasePath = $collection . '/' . $name;
        $firebaseImagePath = $firebasePath . '/' . $filename;

        $storeInLocal = Storage::disk('public')->put($collection, $request);
        $fileUrl = public_path() . Storage::url($storeInLocal);
        $fileUrl = preg_replace('/\//', '\\', $fileUrl);

        if ($storeInLocal) {
            $uploadedFile = fopen($fileUrl, 'r');
            $defaultBucket->upload($uploadedFile, [
                'name' => $firebaseImagePath,
            ]);

            Storage::disk('public')->deleteDirectory($collection);
        }

        return $firebaseImagePath;
    }

    /**
     * Fetch an image from firebase storage.
     * 
     * @param string $imagePath
     * @return array  Return an image's url and its expires.
     */
    public function fetchImage($imagePath)
    {
        $storage = app('firebase.storage');
        $defaultBucket = $storage->getBucket();
        $expiresAt = now()->addDay(60);
        $imageReference = $defaultBucket->object($imagePath);

        $imageUrl = $imageReference->exists() ? $imageReference->signedUrl($expiresAt) : null;

        return [
            'url' => $imageUrl,
            'expires_at' => $expiresAt,
        ];
    }
}
