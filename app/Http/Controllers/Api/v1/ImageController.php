<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Image\StoreImageRequest;
use App\Models\Image;
use App\Models\Manufacture;
use App\Models\Product;
use App\Models\User;
use App\Traits\ApiResponser;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    use ApiResponser;

    protected $image;
    protected $imageService;
    protected $product;
    protected $manufacture;
    protected $user;

    public function __construct(Image $image, ImageService $imageService, Product $product, Manufacture $manufacture, User $user)
    {
        $this->image = $image;
        $this->imageService = $imageService;
        $this->product = $product;
        $this->manufacture = $manufacture;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $images = $this->image->filter($request);

        return $images;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Image\StoreImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImageRequest $request)
    {
        $validated = $request->validated();
        $slug = 'anonymous';

        switch ($validated['imageable_type']) {
            case 'product':
                $product = $this->product->findOrFail($validated['imageable_id']);
                $slug = $product->slug;
                break;
            
            case 'manufacture':
                $manufacture = $this->manufacture->findOrFail($validated['imageable_id']);
                $slug = $manufacture->slug;
                break;
            
            case 'user':
                $user = $this->user->findOrFail($validated['imageable_id']);
                $slug = $user->username;
                break;
            
            default:
                # code...
                break;
        }

        $uploadedImage = $this->imageService->handleUploadedImage($validated['image'], $validated['imageable_type'], $slug);
        $image = $this->image->create([
            'url' => $uploadedImage['url'],
            'expires_at' => $uploadedImage['expires_at'],
            'imageable_id' => $validated['imageable_id'],
            'imageable_type' => $validated['imageable_type'],
        ]);
        $message = 'Upload ???nh th??nh c??ng.';

        return $this->successCreatedResponse($image, $message);
    }

    /**
     * Remove the specified image from storage.
     *
     * @param  \App\Models\Image $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        $this->image->findOrFail($image->id)->deleteOrFail();
        $responseData = null;
        $message = 'X??a ???nh th??nh c??ng.';

        return $this->successReponse($responseData, $message);
    }

    /**
     * Remove all images.
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroyAll() {
        $this->image->truncate();
        $responseData = null;
        $message = 'X??a th??nh c??ng to??n b??? ???nh.';

        return $this->successReponse($responseData, $message);
    }

    /**
     * Remove multiple image by given ids.
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function destroyMany(Request $request) {
        $ids = $request->ids;
        $images = $this->image->whereIn('id', $ids);
        $images->delete();

        $responseData = null;
        $message = 'X??a th??nh c??ng ' . $images->count() . ' ???nh.';

        return $this->successReponse($responseData, $message);
    }
}
