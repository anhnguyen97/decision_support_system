<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeightOfEntropy extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'screen_size', 'camera_font', 'camera_rear', 'cpu_speed', 'ram',
    	'internal_memory', 'external_memory_card', 'bluetooth', 'length', 'width', 'thickness',
    	'weight', 'battery', 'cost',
    ];

    protected $table = 'weight_of_entropy';

}
