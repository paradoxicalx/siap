<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Akaunting\Money\Currency;
use Akaunting\Money\Money;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catagory = DB::table('product_catagorys')->get();
        return view('_admin.product.index' , ['catagory' => $catagory]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    /**
    * Datatables server side.
    */
    public function productDt($catagory){
      if ($catagory == 'all') {
        $model = Product::query();

        return DataTables::eloquent($model)
          ->editColumn('sell_price', function(Product $product) {
              $currency = config('siap.currency');
              return new Money($product->sell_price, new Currency($currency), true);
          })
          ->toJson();
      } else {
        // $product = DB::table('products_catagory_items')->where('catagory_id', $catagory)->get();
        // $query = DB::table('products_catagory_items')
        //   ->leftJoin('products', 'products.id', '=', 'products_catagory_items.product_id')
        //   ->where('catagory_id', $catagory);
        // return $product;

        // return DataTables::queryBuilder($query)
        // ->toJson();
        // return DataTables::of(Product::where('catagory', '=', $catagory))->make(true);

        $query = Product::all()
          ->leftJoin('products', 'products.id', '=', 'product_catagory_items.product_id')
          ->where('catagory_id', $catagory);
        return $query->name;
      }
    }
}
