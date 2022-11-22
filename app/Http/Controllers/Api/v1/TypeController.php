<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreTypeRequest;
use App\Http\Requests\Product\UpdateTypeRequest;
use App\Http\Resources\Product\TypeCollection;
use App\Http\Resources\Product\TypeResource;
use App\Models\Type;
use App\Traits\ApiResponser;

class TypeController extends Controller
{
    use ApiResponser;

    protected $type;

    public function __construct(Type $type)
    {
        $this->type = $type;
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
            'message' => 'Lấy thành công danh sách loại sản phẩm.'
        ];

        return (new TypeCollection($this->type->paginate(10)))->additional($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\StoreTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTypeRequest $request)
    {
        $validated = $request->validated();
        $type = $this->type->create($request->safe()->except('sizes'));
        $request->has('sizes') && $type->sizes()->attach($validated['sizes']);

        $responseData = null;
        $message = 'Thêm loại sản phẩm thành công.';

        return $this->successCreatedResponse($responseData, $message);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Type $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        $type = new TypeResource($this->type->findOrFail($type->id));
        $message = 'Lấy thành công loại sản phẩm.';

        return $this->successReponse($type, $message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\UpdateTypeRequest  $request
     * @param  \App\Models\Type $type
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        $validated = $request->validated();
        $type = $this->type->findOrFail($type->id);
        $request->has('sizes') && $type->sizes()->sync($validated['sizes']);
        $type->updateOrFail($request->safe()->except('sizes'));
            
        $responseData = null;
        $message = 'Cập nhật loại sản phẩm thành công.';
        return $this->successReponse($responseData, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type = $this->type->findOrFail($type->id);
        $type->sizes()->detach();
        $type->deleteOrFail();

        $responseData = null;
        $message = 'Xóa loại sản phẩm thành công.';

        return $this->successReponse($responseData, $message);
    }
}
