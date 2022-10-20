<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Pedido::all();
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
        $pedido=new Pedido();
        $pedido->skup=$request->get('skup');
        $pedido->nombrep=$request->get('nombrep');
        $pedido->color=$request->get('color');
        $pedido->sabor=$request->get('sabor');
        $pedido->texto=$request->get('texto');
        $pedido->fecha=$request->get('fecha');
        $pedido->hora=$request->get('hora');
        $pedido->sucursal=$request->get('sucursal');
        $pedido->telefono=$request->get('telefono');
        $pedido->preciop=$request->get('preciop');
        $pedido->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     return Pedido::find($id);
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
        $pedido=Pedido::find($id);
        $pedido->nombrep=$request->get('nombrep');
        $pedido->color=$request->get('color');
        $pedido->sabor=$request->get('sabor');
        $pedido->texto=$request->get('texto');
        $pedido->fecha=$request->get('fecha');
        $pedido->hora=$request->get('hora');
        $pedido->sucursal=$request->get('sucursal');        
        $pedido->telefono=$request->get('telefono');
        $pedido->preciop=$request->get('preciop');
        $pedido->update();

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
        $pedido=Pedido::find($id);
        $pedido->delete();
    }
}
