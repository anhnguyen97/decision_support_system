<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'brand_id', 'slug', 'thumbnail', 'os', 'quantity', 'cost', 'discount',
    ];

    protected $table = 'products';

    /**
     * Get the product's detail record associated with the product.
     */
    public function productDetail()
    {
        return $this->hasOne('App\ProductDetail');
    }

    /**
     * Get the user that owns the phone.
     */
    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    public function normalized_product()
    {
        return $this->hasOne('App\NormalizedProduct');
    }
}
