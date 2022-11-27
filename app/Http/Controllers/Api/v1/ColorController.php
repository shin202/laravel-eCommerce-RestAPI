<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreColorRequest;
use App\Http\Requests\Product\UpdateColorRequest;
use App\Http\Resources\Product\ColorCollection;
use App\Http\Resources\Product\ColorResource;
use App\Models\Color;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    use ApiResponser;

    protected $color;

    public function __construct(Color $color)
    {
        $this->color = $color;
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
            'message' => 'Lấy thành công danh sách màu sắc sản phẩm.',
        ];

        return (new ColorCollection($this->color->paginate(10)))->additional($data)->response();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\StoreColorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreColorRequest $request)
    {
        $this->color->create($request->validated());

        $responseData = null;
        $message = 'Thêm màu sản phẩm thành công.';

        return $this->successCreatedResponse($responseData, $message);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Color $color
     * @return \Illuminate\Http\Response
     */
    public function show(Color $color)
    {
        $color = new ColorResource($this->color->findOrFail($color->id));
        $message = 'Lấy thông tin màu sản phẩm thành công.';

        return $this->successReponse($color, $message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\UpdateColorRequest  $request
     * @param  \App\Models\Color $color
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateColorRequest $request, Color $color)
    {
        $this->color->findOrFail($color->id)->updateOrFail($request->validated());

        $responseData = null;
        $message = 'Cập nhật màu sắc sản phẩm thành công.';

        return $this->successReponse($responseData, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Color $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        $this->color->findOrFail($color->id)->deleteOrFail();

        $responseData = null;
        $message = 'Xóa màu sắc sản phẩm thành công.';

        return $this->successReponse($responseData, $message);
    }
}
