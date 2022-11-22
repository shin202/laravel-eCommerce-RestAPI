<?php

namespace App\Services;

use App\Services\FirebaseStorageService;

class ImageService
{
    protected $firebaseStorage;

    public function __construct(FirebaseStorageService $firebaseStorage)
    {
        $this->firebaseStorage = $firebaseStorage;
    }

    /**
     * 
     * @param mixed $request
     * @param string $collection Name of collection in firebase storage.
     * @param string $foldername
     * @return array
     */
    public function handleUploadedImage($request, $collection, $foldername) {
        $imagePath = $this->firebaseStorage->storeImage($request, $collection, $foldername);
        $imageData = $this->firebaseStorage->fetchImage($imagePath);

        return $imageData;
    }
}
