<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class NormalizedProduct extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'product_id', 'screen_size', 'camera_font', 'camera_rear', 'cpu_speed', 'ram',
    	'internal_memory', 'external_memory_card', 'bluetooth', 'length', 'width', 'thickness',
    	'weight', 'battery', 'cost',
    ];

    protected $table = 'normalized_products';

    public function product()
    {
    	return $this->belongsTo('App\Product');
    }
}
