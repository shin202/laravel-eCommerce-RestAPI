<?php

namespace App\Models;

use App\Http\Resources\Image\ImageCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = [
        'url',
        'expires_at',
        'imageable_id',
        'imageable_type',
    ];

    /**
     * Get the parent imageable model (User, Product or Manufacture).
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function imageable() {
        return $this->morphTo();
    }

    public function scopeFilter($query, $request) {
        if (!$request->has('filter')) return $this->all()->groupBy('imageable_type');

        $images = $query->where('imageable_type', $request->filter)->paginate(10)->appends($request->query());

        $data = [
            'status' => 'success',
            'message' => 'Lấy danh sách ảnh thành công.',
        ];

        return (new ImageCollection($images))->additional($data)->response();
    }
}
