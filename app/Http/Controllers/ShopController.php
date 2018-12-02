<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mobiles = Product::paginate(16);
        return view('shop.index',[
            'mobiles' => $mobiles,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProductDetail($product_slug)
    {
        $product = Product::where('slug',$product_slug)->first();
        $product['detail'] = $product->productDetail;
        $product['brand'] = $product->brand;
        // dd($product->brand());
        return view('shop.layouts.product_detail', [
            'product'=>$product,
        ]);
    }

    public function showSuggestPage()
    {
        $product = Product::paginate(9);
        return view('shop.layouts.suggest', [
            'all_product'=>$product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
