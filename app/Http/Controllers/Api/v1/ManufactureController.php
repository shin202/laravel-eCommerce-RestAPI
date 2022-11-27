<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manufacture\StoreManufactureRequest;
use App\Http\Requests\Manufacture\UpdateManufactureRequest;
use App\Http\Resources\Manufacture\ManufactureCollection;
use App\Http\Resources\Manufacture\ManufactureResource;
use App\Models\Manufacture;
use App\Traits\ApiResponser;
use App\Services\ImageService;

class ManufactureController extends Controller
{
    use ApiResponser;
    
    protected $manufacture;
    protected $imageService;

    public function __construct(Manufacture $manufacture, ImageService $imageService)
    {
        $this->manufacture = $manufacture;
        $this->imageService = $imageService;
    }

    /**
     * Display a listing of the manufacture.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'status' => 'success',
            'message' => 'Lấy thành công danh sách nhà sản xuất.',
        ];

        return (new ManufactureCollection($this->manufacture->paginate(10)))->additional($data)->response();
    }

    /**
     * Store a newly created manufacture in storage.
     *
     * @param  \App\Http\Requests\Manufacture\StoreManufactureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreManufactureRequest $request)
    {
        $this->authorize('create');

        $validated = $request->validated();
        $manufacture = $this->manufacture->create($request->safe()->except('logo'));
        $logo = $this->imageService->handleUploadedImage($validated['logo'], 'manufacture', $validated['slug']);
        $manufacture->image()->create($logo);

        $responseData = null;
        $message = 'Thêm nhà sản xuất thành công.';

        return $this->successCreatedResponse($responseData, $message);
    }

    /**
     * Display the specified manufacture.
     *
     * @param  \App\Models\Manufacture $manufacture
     * @return \Illuminate\Http\Response
     */
    public function show(Manufacture $manufacture)
    {
        $manufacture = new ManufactureResource($this->manufacture->findOrFail($manufacture->id));
        $message = 'Lấy thông tin nhà sản xuất thành công.';

        return $this->successReponse($manufacture, $message);
    }

    /**
     * Update the specified manufacture in storage.
     *
     * @param  \App\Http\Requests\Manufacture\UpdateManufactureRequest  $request
     * @param  \App\Models\Manufacture $manufacture
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateManufactureRequest $request, Manufacture $manufacture)
    {
        $this->authorize('update', $manufacture);

        $validated = $request->validated();
        $manufacture = $this->manufacture->findOrFail($manufacture->id);
        
        if ($request->has('newLogo')) {
            $manufacture->image()->delete();
            $logo = $this->imageService->handleUploadedImage($validated['newLogo'], 'manufacture', $validated['slug']);
            $manufacture->image()->create($logo);
        }

        $manufacture->updateOrFail($request->safe()->except('newLogo'));

        $responseData = null;
        $message = 'Cập nhật nhà sản xuất thành công.';

        return $this->successReponse($responseData, $message);
    }

    /**
     * Remove the specified manufacture from storage.
     *
     * @param  \App\Models\Manufacture $manufacture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manufacture $manufacture)
    {
        $this->authorize('delete', $manufacture);

        $this->manufacture->findOrFail($manufacture->id)->deleteOrFail();

        $responseData = null;
        $message = 'Xóa nhà sản xuất thành công.';

        return $this->successReponse($responseData, $message);
    }

    public function search($name) {
        $data = [
            'status' => 'success',
            'message' => 'Lấy thành công danh sách nhà sản xuất có tên là: '.$name,
        ];

        $manufactures = $this->manufacture->where('name', 'like', '%'.$name.'%')->paginate(10);

        return (new ManufactureCollection($manufactures))->additional($data)->response();
    }
}
