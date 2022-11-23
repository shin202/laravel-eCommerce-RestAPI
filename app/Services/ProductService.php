<?php

namespace App\Services;

use App\Services\FirebaseStorageService;

class ProductService
{

    protected $firebaseStorage;

    public function __construct(FirebaseStorageService $firebaseStorage)
    {
        $this->firebaseStorage = $firebaseStorage;
    }


    /**
     * 
     * @param array $images
     * @param mixed $foldername 
     * @return array
     */
    public function handleUploadedImage($images, $foldername)
    {
        $data = [];
        foreach ($images as $image) {
            $imagePath = $this->firebaseStorage->storeImage($image, 'product', $foldername);
            $imageData = $this->firebaseStorage->fetchImage($imagePath);

            $data[] = $imageData;
        }

        return $data;
    }
}
