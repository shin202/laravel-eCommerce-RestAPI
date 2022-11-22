<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Category\CategoryResource;
use App\Traits\ApiResponser;
use App\Models\Category;

class CategoryController extends Controller
{
    use ApiResponser;
    
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    /**
     * Display a listing of the category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'status' => 'success',
            'message' => 'Lấy thành công toàn bộ danh mục sản phẩm'
        ];

        return (new CategoryCollection($this->category->paginate(10)))->additional($data);
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \App\Http\Requests\Category\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $this->category->create($request->validated());

        $responseData = null;
        $message = 'Thêm danh mục sản phẩm thành công.';

        return $this->successCreatedResponse($responseData, $message);
    }

    /**
     * Display the specified category.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $category = new CategoryResource($this->category->findOrFail($category->id));
        $message = 'Lấy thành công danh mục sản phẩm.';

        return $this->successReponse($category, $message);
    }

    /**
     * Update the specified category in storage.
     *
     * @param  \App\Http\Requests\Category\UpdateCategoryRequest  $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $this->category->findOrFail($category->id)->updateOrFail($request->validated());

        $response_data = null;
        $message = 'Cập nhật thành công danh mục sản phẩm.';

        return $this->successReponse($response_data, $message);
    }

    /**
     * Remove the specified category from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->category->findOrFail($category->id)->deleteOrFail();

        $response_data = null;
        $message = 'Xóa thành công danh mục sản phẩm.';

        return $this->successReponse($response_data, $message);
    }
}
