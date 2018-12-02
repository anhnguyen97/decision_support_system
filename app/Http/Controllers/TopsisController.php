<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\ProductDetail;
use App\NormalizedProduct;
use App\WeightOfEntropy;

class TopsisController extends Controller
{

    public function index()
    {
        return view('admins.topsis.index');
    }
	/**
	 * calculate the criteria weight/ ENTROPY METHOD
	 * A[m][n] : có m phương án lựa chọn trên tập n thuộc tính
	 * @return 
	 */
	public function entropy()
	{
		$all_product = DB::table('product_details')->select('product_id', 'screen_size', 'camera_font', 'camera_rear', 'cpu_speed', 'ram', 'internal_memory', 'external_memory_card', 'bluetooth', 'length', 'width', 'thickness', 'weight', 'battery','cost')->get();

		$attr_list;//tập thuộc tính

        //xử lý external memory card, internal_memory_card
        // foreach ($all_product as $index => $item) {
        //     $ex = $item->external_memory_card;
        //     if ($ex <= 32) {
        //         $item->external_memory_card=1;
        //     } else if($ex <=64) {
        //         $item->external_memory_card=2;
        //     } else if($ex<=128){
        //         $item->external_memory_card=3;
        //     } else {
        //         $item->external_memory_card=4;
        //     }  

        //     $in = $item->internal_memory;
        //     if ($ex <= 16) {
        //         $item->internal_memory=1;
        //     } else if($ex <=32) {
        //         $item->internal_memory=2;
        //     } else if($ex <=64) {
        //         $item->internal_memory=2;
        //     } else if($ex<=128){
        //         $item->internal_memory=3;
        //     } else {
        //         $item->internal_memory=4;
        //     } 
        // }

		//tổng của từng cột thuộc tính
        foreach ($all_product[0] as $attr_name => $value) {
            if ($attr_name != "product_id") {
                $sum[$attr_name] = $all_product->sum($attr_name);
                $attr_list[] = $attr_name;
            }			
        };

		//tính % theo chiều dọc từng thuộc tính
        foreach ($all_product as $index => $item) {
            $id = $item->product_id;
            foreach ($item as $attr_name => $value) {
                if ($attr_name != 'product_id') {
                    $P[$id][$attr_name] = $value/$sum[$attr_name];
                }				
            }
        }

		// init output entropy matrix E and variation coefficient matrix D
		// the weight of entropy dj matrix W
        foreach ($attr_list as $key => $attr_name) {
            $E[$attr_name] = 0;
            $D[$attr_name] = 0;
            $W[$attr_name] = 0;
        }

        $count_product = DB::table('product_details')->count();

		//calculate output entropy matrix E: Ej = -k/sum[pij*ln pij]
        foreach ($P as $key => $pi) {

            foreach ($pi as $attr_name => $pij) {
                if ($pij != 0 && $pij !=null) {
                    $E[$attr_name] += (-1/log($count_product))*$pij*log($pij); 
                }				
            }
        }

		//variation coefficient of jth jactor: dj = 1-ej (hệ số biến thiên)
        $sum_variation = 0;
        foreach ($E as $attr_name => $value) {
            $D[$attr_name] = 1 - $value;
            $sum_variation +=$D[$attr_name];
        }

        foreach ($D as $attr_name => $value) {
            $W[$attr_name] = $value/$sum_variation;
        }

        $weight = WeightOfEntropy::first();

		//update to db
        if ($weight) {
            WeightOfEntropy::where('id',$weight['id'])->update($W);
        } else {
            WeightOfEntropy::create($W);
        }
        return redirect()->back();
    }


    /**
     * chuẩn hóa ma trận quyết định theo vector
     * Calculate the normalized decision matrix.
     * @return [type] [description]
     */
    public function normalizateProduct()
    {
    	$all_product = DB::table('product_details')->select('product_id', 'screen_size', 'camera_font', 'camera_rear', 'cpu_speed', 'ram', 'internal_memory', 'external_memory_card', 'bluetooth', 'length', 'width', 'thickness', 'weight', 'battery','cost')->get();

    	$attr_list;//tập thuộc tính

    	//lấy ra tập thuộc tính
    	foreach ($all_product[0] as $attr_name => $value) {
    		if ($attr_name != "product_id") {
    			$attr_list[] = $attr_name;
    			$sum_pow[$attr_name] = 0;
    			$sprt_sum_pow[$attr_name] = 0;
    		}			
    	};

		//tổng bình phương của từng cột thuộc tính
    	foreach ($all_product as $item) {
    		foreach ($item as $attr_name => $value) {
    			if ($attr_name != 'product_id') {
    				$sum_pow[$attr_name] += pow($value, 2);
    			}
    		}			
    	};

    	foreach ($attr_list as $attr_name) {
    		if ($attr_name != 'product_id') {
    			$sqrt_sum_pow[$attr_name] = sqrt($sum_pow[$attr_name]);
    		}
    	}

		//tính normalized desicion matrix
    	foreach ($all_product as $index => $item) {
    		$id = $item->product_id;
    		$P[$id]['product_id'] = $id;
    		foreach ($item as $attr_name => $value) {
    			if ($attr_name != 'product_id') {
    				$P[$id][$attr_name] = $value/$sqrt_sum_pow[$attr_name];
    			}				
    		}
    	}

		//update to db
    	foreach ($P as $item) {
    		NormalizedProduct::updateOrCreate($item);
    	}

        return redirect()->back();
    }

    public function decisionSupport(Request $request)
    {

        $input = $request->all();

        $data = [
          'screen_size' => $request->screenSize,
          'camera_font' =>  $request->camera,
          'cpu_speed' =>  $request->cpu,
          'ram' =>  $request->ram,
          'cost' =>  $request->cost,
          'weight' =>  $request->weight,
          'length' =>  $request->demension,
          'width' =>  $request->demension,
          'thickness' =>  $request->demension,
          'internal_memory' =>  $request->internal,
          'external_memory_card' =>  $request->external,
          'battery' =>  $request->battery,
          'camera_rear' =>  $request->camera,
          'bluetooth' => $request->bluetooth,
      ];
      $sum_input = 0;
      foreach ($data as $attr_name => $value) {
        $sum_input+=$value;
    }
    foreach ($data as $attr_name => $value) {
        $data[$attr_name] = $value/$sum_input;
    }

    $weightEntropy = WeightOfEntropy::select('screen_size', 'camera_font', 'camera_rear', 'cpu_speed', 'ram', 'internal_memory', 'external_memory_card', 'bluetooth', 'length', 'width', 'thickness', 'weight', 'battery','cost')->first();

    	//Calculate the adjusted weight bj=wj*aj/ sum(wj*aj)
    	//wj: from weight_of_entropy table, aj: inputed from user
    	//B: array weight of factor


    	/**
    	 * STEP 2.1: Calculate the adjusted weight βj
    	 */
    	$sum_weight = 0;
    	foreach ($data as $attr_name => $weight) {
    		$B[$attr_name] = $weight*$weightEntropy[$attr_name];
    		$sum_weight+=$B[$attr_name];
    	}

    	foreach ($B as $attr_name => $weight) {
    		$B[$attr_name] = $weight/$sum_weight;
    	}

    	$all_weight_product = NormalizedProduct::select('product_id', 'screen_size', 'camera_font', 'camera_rear', 'cpu_speed', 'ram', 'internal_memory', 'external_memory_card', 'bluetooth', 'length', 'width', 'thickness', 'weight', 'battery','cost')->get();

    	/**
    	 * STEP 2.2: Calculate the weighted normalized decision matrix
    	 */
    	foreach ($B as $attr_name => $weight) {
    		foreach ($all_weight_product as $item) {
    			$item[$attr_name] = $item[$attr_name]*$weight;
    		}
    	}
    	/**
    	 * STEP 3: Calculate the ideal solution V * and the negative ideal solution V –
    	 */    	 
    	foreach ($B as $attr_name => $value) {
    		$V_max[$attr_name] = $all_weight_product->max($attr_name);
    		$V_min[$attr_name] = $all_weight_product->min($attr_name);
    	}

    	/**
    	 * STEP 4
    	 * Calculate the separation measures, using the m-dimensional Euclidean distance
    	 */
    	foreach ($all_weight_product as $item) {
    		$sum_pow_min = 0;
    		$sum_pow_max = 0;
    		foreach ($V_max as $attr_name => $weight) {
    			$sum_pow_max += pow($item[$attr_name]-$weight,2);
    		}
    		$item['distance_Vmax'] = sqrt($sum_pow_max);

    		foreach ($V_min as $attr_name => $weight) {
    			$sum_pow_min += pow($item[$attr_name]-$weight,2);
    		}
    		$item['distance_Vmin'] = sqrt($sum_pow_min);

    		/**
    	 	 * STEP 5: Calculate the relative closeness to the ideal solution
    	 	 * độ gần tương đối tới giải pháp lý tưởng
    	 	 */
    		$Y[$item['product_id']]=$item['distance_Vmin']/($item['distance_Vmin']+$item['distance_Vmax']);
    		array_sort($Y);
    		arsort($Y);
    	}

    	$count = 1;
    	$num_result = 12;
    	foreach ($Y as $key => $value) {
    		$keyMobile[] = $key;
    		
    		if($count == $num_result){ break; }
    		$count++;
    	}    	
    	$mobiles = Product::find($keyMobile);
    	// dd($products);
    	return view('shop.layouts.result_suggest',['mobiles'=>$mobiles]);
    }
}
