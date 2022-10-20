<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productoc;

class ProductocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Productoc::all();
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
        $productoc=new Productoc();
        $productoc->skuc=$request->get('skuc');
        $productoc->nombrec=$request->get('nombrec');
        $productoc->precioc=$request->get('precioc');
        $productoc->cantidadc=$request->get('cantidadc');
        $productoc->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     return Productoc::find($id);
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
        $productoc=Productoc::find($id);
        $productoc->nombrec=$request->get('nombrec');
        $productoc->precioc=$request->get('precioc');
        $productoc->cantidadc=$request->get('cantidadc');
        $productoc->update();

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
        $productoc=Productoc::find($id);
        $productoc->delete();
    }
}
