<?php

namespace App\Models;

use App\Models\BaseModel;

class Product extends BaseModel
{
    protected $table = 'products';
    protected $fillable = [
        'manufacture_id',
        'category_id',
        'name',
        'description',
        'image',
        'stock',
        'price',
        'slug',
    ];

    /**
     * Get the manufacture that owns the product.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manufacture()
    {
        return $this->belongsTo(Manufacture::class);
    }

    /**
     * Get the categories that belong to the product.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id')->withTimestamps();
    }

    /**
     * Get the types that belong to the product.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function types()
    {
        return $this->belongsToMany(Type::class, 'product_type', 'product_id', 'type_id')->withTimestamps();
    }

    /**
     * Get the sizes that belong to the product.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_size', 'product_id', 'size_id')->withTimestamps();
    }

    /**
     * Get all of the product's images.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * Get the colors that belong to the product.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function colors() {
        return $this->belongsToMany(Color::class, 'color_product', 'product_id', 'color_id')->withTimestamps();
    }

    /**
     * Get the reviews that belong to the product.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews() {
        return $this->hasMany(Review::class);
    }
}
