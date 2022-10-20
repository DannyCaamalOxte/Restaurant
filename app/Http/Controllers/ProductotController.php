<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productot;

class ProductotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Productot::all();
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
        $productot=new Productot();
        $productot->skut=$request->get('skut');
        $productot->nombret=$request->get('nombret');
        $productot->preciot=$request->get('preciot');
        $productot->cantidadt=$request->get('cantidadt');
        $productot->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     return Productot::find($id);
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
        $productot=Productot::find($id);
        $productot->nombret=$request->get('nombret');
        $productot->preciot=$request->get('preciot');
        $productot->cantidadt=$request->get('cantidadt');
        $productot->update();

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
        $productot=Productot::find($id);
        $productot->delete();
    }
}
