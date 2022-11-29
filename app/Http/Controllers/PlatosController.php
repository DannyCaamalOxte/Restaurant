<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Platos;
class PlatosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Platos::all();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        //metodo para agregar un nuevo plato
        $plato = new Platos();

        $plato->nombre=$r->get('nombre');
        $plato->precio=$r->get('precio');
        $plato->comentario=$r->get('comentario');

        $plato->save();
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
        return Platos::find($id);
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
        // esta funcion actualiza un platillo
        $plato = Platos::find($id);

        $plato->nombre=$request->get('nombre');
        $plato->precio=$request->get('precio');
        $plato->comentario=$request->get('comentario');

        $plato->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //este metodo elimina platos
        $plato=Platos::find($id);
        $plato->delete();
    }
}
