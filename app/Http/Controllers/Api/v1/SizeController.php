<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreSizeRequest;
use App\Http\Requests\Product\UpdateSizeRequest;
use App\Http\Resources\Product\SizeCollection;
use App\Http\Resources\Product\SizeResource;
use App\Models\Size;
use App\Traits\ApiResponser;

class SizeController extends Controller
{
    use ApiResponser;

    protected $size;

    public function __construct(Size $size)
    {
        $this->size = $size;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'status' => 'success',
            'message' => 'Lấy thành công danh sách size sản phẩm.',
        ];

        return (new SizeCollection($this->size->paginate(10)))->additional($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\StoreSizeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSizeRequest $request)
    {
        $this->size->create($request->validated());

        $responseData = null;
        $message = 'Thêm thành công size sản phẩm.';

        return $this->successCreatedResponse($responseData, $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Size
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size)
    {
        $size = new SizeResource($this->size->findOrFail($size));
        $message = 'Lấy thành công thông tin size sản phẩm.';

        return $this->successReponse($size, $message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\UpdateSizeRequest  $request
     * @param  \App\Models\Size
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSizeRequest $request, Size $size)
    {
        $this->size->findOrFail($size)->updateOrFail($request->validated());

        $responseData = null;
        $message = 'Cập nhật thành công thông tin size sản phẩm.';

        return $this->successReponse($responseData, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Size
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size)
    {
        $this->size->findOrFail($size)->deleteOrFail();

        $responseData = null;
        $message = 'Xóa thành công size sản phẩm.';

        return $this->successReponse($responseData, $message);
    }
}
