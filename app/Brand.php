<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Brand extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'description'
    ];

    protected $table = 'brands';

    public function products()
    {
    	return $this->hasMany('App\Product', 'brand_id');
    }
}
