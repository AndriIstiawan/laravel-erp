<?php

namespace App\Http\Controllers\TransactionManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Counter;
use App\Carriers;
use App\SalesOrder;
use App\User;
use App\Packaging;
use App\Member;
use App\Product;
use Auth;

class OrderCreateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $members = Member::all();
        $products = Product::all();
        $packaging = Packaging::all();
        $carrier = Carriers::all();
        $member = Member::groupBy('code')->count('shipping_address');
        return view('panel.transaction-management.order-create.form-create')->with([
            'user' => $user,
            'members' => $members,
            'products' => $products,
            'memberssss' => $member,
            'carrier' => $carrier,
            'packaging' => $packaging
        ]);
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
