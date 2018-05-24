<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Charts;
use App\SalesOrder;
use App\Product;
use App\Discounts;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chart = SalesOrder::select('total_kg','products')->orderBy('total_kg','DESC')->get();
        $so = SalesOrder::select('code')->orderBy('code','DESC')->LIMIT(5)->get();
        $sor = SalesOrder::where('status', 'order')->count('code');
        $prod = SalesOrder::where('status', 'production')->count('code');
        /*$product = Product::where('_id', array_column($chart['products'], 'product_id'))->get();*/
        $chartLabel = SalesOrder::select('total_kg','products')->orderBy('total_kg','DESC')->LIMIT(5)->get();
        return view('panel.dashboard')->with(['chart'=>$chart,'chartLabel'=> $chartLabel, 'so' => $so , 'sor' => $sor, 'prod'=>$prod]);
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
        //
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
