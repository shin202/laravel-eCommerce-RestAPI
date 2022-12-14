<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Product;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\DeleteProductImageRequest;
use App\Http\Requests\Product\StoreProductImageRequest;
use App\Http\Resources\Image\ImageResource;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Traits\ApiResponser;
use App\Services\ProductService;

class ProductController extends Controller
{
    use ApiResponser;
    
    protected $product;
    protected $productService;
    protected $exceptRequest;

    public function __construct(Product $product, ProductService $productService)
    {
        $this->product = $product->with(['categories', 'colors', 'images', 'manufacture', 'reviews', 'sizes', 'types']);
        $this->productService = $productService;
        $this->exceptRequest = ['categories', 'types', 'sizes', 'images', 'colors'];
    }

    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'status' => 'success',
            'message' => 'Lấy danh sách sản phẩm thành công.',
        ];

        return (new ProductCollection($this->product->paginate(10)))->additional($data)->response();
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \App\Http\Requests\Product\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $this->authorize('create');

        $product = $this->product->create($this->filterRequest($request));

        // Assign product's data.
        $validated = $request->validated();
        $product->categories()->attach($validated['categories']);
        $product->types()->attach($validated['types']);
        $product->sizes()->attach($validated['sizes']);
        $product->colors()->attach($validated['colors']);

        $images = $this->productService->handleUploadedImage($validated['images'], $validated['slug']);
        $product->images()->createMany($images);

        $responseData = null;
        $message = 'Thêm sản phẩm thành công.';

        return $this->successCreatedResponse($responseData, $message);
    }

    /**
     * Display the specified product.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product = new ProductResource($this->product->findOrFail($product->id));
        $message = 'Lấy thông tin sản phẩm thành công.';

        return $this->successReponse($product, $message);
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \App\Http\Requests\Product\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);

        $product = $this->product->findOrFail($product->id);

        $validated = $request->validated();
        $product->categories()->sync($validated['categories']);
        $product->types()->sync($validated['types']);
        $product->sizes()->sync($validated['sizes']);
        $product->colors()->sync($validated['colors']);

        $product->updateOrFail($this->filterRequest($request));

        $responseData = null;
        $message = 'Cập nhật sản phẩm thành công.';

        return $this->successReponse($responseData, $message);
    }

    /**
     * Remove the specified product from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        $this->product->findOrFail($product->id)->deleteOrFail();
        
        $responseData = null;
        $message = 'Xóa sản phẩm thành công.';

        return $this->successReponse($responseData, $message);
    }

    protected function filterRequest($request) {
        $filteredRequest = $request->safe()->except($this->exceptRequest);

        return $filteredRequest;
    }

    public function search($name) {
        $data = [
            'status' => 'success',
            'message' => 'Lấy danh sách sản phẩm thành công có tên là: '.$name,
        ];

        $products = $this->product->where('name', 'like', '%'.$name.'%')->paginate(10);

        return (new ProductCollection($products))->additional($data)->response();
    }

    public function addImage(StoreProductImageRequest $request, Product $product) {
        $this->authorize('manageImage', $product);

        $validated = $request->validated();
        $product = $this->product->findOrFail($product->id);
        $images = $this->productService->handleUploadedImage($validated['images'], $product->slug);
        $product->images()->createMany($images);
        $result = $product->images;

        $responseData = ImageResource::collection($result);
        $message = 'Thêm ảnh sản phẩm thành công.';

        return $this->successCreatedResponse($responseData, $message);
    }

    public function deleteImage(DeleteProductImageRequest $request, Product $product) {
        $this->authorize('manageImage', $product);

        $validated = $request->validated();
        $product = $this->product->findOrFail($product->id);
        $product->images()->whereIn('id', $validated['images'])->delete();

        $responseData = null;
        $message = 'Xóa thành công ảnh sản phẩm.';

        return $this->successReponse($responseData, $message);
    }
}
