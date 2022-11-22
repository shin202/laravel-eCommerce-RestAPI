<?php

namespace App\Models;

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

        return $query->where('imageable_type', $request->filter)->get();
    }
}
