<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use Yajra\Datatables\Datatables;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.brands.allBrands');
    }

    /*
    get data ajax with Datatables
     */
    public function getData()
    {
        return Datatables::of(Brand::query())
        ->addColumn('action', function ($brand) {
            return '<a title="Detail" class="btn btn-info btn-sm glyphicon glyphicon-eye-open btnShow" data-id="'.$brand["id"].'" id="row-'.$brand["id"].'"></a>&nbsp;<a title="Edit" class="btn btn-warning btn-sm glyphicon glyphicon-edit btnEdit" data-id='.$brand["id"].'></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm glyphicon glyphicon-trash btnDelete" data-id='.$brand["id"].'></a>';
        })
        ->editColumn('updated_at', function($brand){
            return $brand->updated_at->format('H:i:s d/m/Y');
        })
        ->editColumn('created_at', function($brand){
            return $brand->created_at->format('H:i:s d/m/Y');
        })
        ->setRowId(function ($brand) {
            return 'row-'.$brand->id;
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
        $data['slug'] = str_slug($data['name'],'-');
        // dd($data);
        return Brand::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Brand::find($id);
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
        $data = $request->all();
        // console.log($data);
        $res = Brand::find($id)->update($data);
        if($res == true){
            return Brand::find($id);
        } else {
            return response([],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        
    }
}
