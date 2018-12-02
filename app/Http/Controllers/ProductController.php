<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductDetail;
use App\Brand;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.products.allProduct');
    }

    public function getData()
    {        
        $listProduct = Product::query();
        return Datatables::of($listProduct)
        ->addColumn('action', function ($product) {
            return '<a title="Detail" class="btn btn-info btn-sm glyphicon glyphicon-eye-open btnShow" data-id="'.$product["id"].'" id="row-'.$product["id"].'"></a>&nbsp;<a title="Edit" class="btn btn-warning btn-sm glyphicon glyphicon-edit btnEdit" data-id='.$product["id"].'></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm glyphicon glyphicon-trash btnDelete" data-id='.$product["id"].'></a>';
        })
        ->editColumn('updated_at', function($product){
            return $product->updated_at->format('H:i:s d/m/Y');
        })
        ->editColumn('brand', function($product){
            $brand = $product->brand;
            return $brand->name;
        })
        ->editColumn('quantity', function($product){
            return number_format($product->quantity);
        })
        ->editColumn('cost', function($product){
            return number_format($product->cost, 2);
        })
        ->setRowId(function ($product) {
            return 'row-'.$product->id;
        })
        ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $date = date('YmdHis', time());
        if ($request->hasFile('thumbnail')) {
            $extension = '.'.$data['thumbnail']->getClientOriginalExtension();
            $file_name = md5($request->name).'_'. $date . $extension;
            $data['thumbnail']->storeAs('public/products',$file_name);
            $data['thumbnail'] = 'storage/products/'.$file_name;
        } else {
            // $imageName='posts/userDefault.png';
        }
        $data['slug'] = str_slug($request->name);
        $product = Product::create($data);
        if ($product) {
            $data['product_id'] = $product['id'];
            $detail = ProductDetail::create($data);
            if ($detail) {
                $product['brand_name'] = $product->brand->name;
                return $product;
            } else {                
                Product::find($product['id'])->delete();
                return $detail;
            }
        }  else {
            return $product;
        }      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $product['detail'] = $product->productDetail;
        $product['brand_name'] = $product->brand->name;
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $product['detail'] = $product->productDetail;
        return $product;
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
        $product = Product::find($id);
        //delete product's thumbnail
        if ($product->thumbnail != null && $product->thumbnail != 'undefined') {
            $file = explode('/',$product->thumbnail)[2];
            Storage::delete($file);
            unlink(storage_path('app/public/products/'.$file));
        };        
        $product->productDetail()->delete();
        return Product::find($id)->delete()?response()->json([],200):response()->json([],400);
    }


    public function updateDb()
    {
        $list = Product::all();
        foreach ($list as $key => $item) {
            $date = date('YmdHis', time());
            $extension = '.'.explode('.',$item->thumbnail)[1];;
            $file_name = md5($item->name).'_'. $date . $extension;
            $path = 'storage/products/'.$file_name;
            Storage::move('public/products/'.$item['thumbnail'], 'public/products/'.$file_name);
            $data = array(
                'slug' => str_slug($item->name),
                'thumbnail' => $path,
                'quantity' => rand(0,259),
            );
            Product::find($item['id'])->update($data);
        }
    }
}
