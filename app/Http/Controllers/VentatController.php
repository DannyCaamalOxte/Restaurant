<?php
// se crea con php artisan make:controller VentaController --api

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ventat;
use App\DetalleVentat;
use Codedge\Fpdf\Fpdf\Fpdf;
use DB;

class VentatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        return Ventat::all();
        //return 'hhh';
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        //envia todo en la base de datos
        //seccion del manejo de la venta
        // return $r;
        $ventat=new Ventat;
        $ventat->folio=$r->get('folio');
        $ventat->fecha_venta=$r->get('fecha_venta');
        $ventat->num_articulos=$r->get('num_articulos');
        $ventat->subtotal=$r->get('subtotal');
        $ventat->iva=$r->get('iva');
        $ventat->total=$r->get('total');

        $ventat->save();
        //fin del amnejo de la venta
        //detalles llega del js

        //obtenemos el request el json de los detalles
        $detalles=$r->get('detalles');

        //insertamos los detalles ala tabla detalle_venta

        DetalleVentat::insert($detalles);

        //actualizar de la cantidad de productos(restar productos al vender)
        for ($i=0; $i < count($detalles); $i++) { 
            $cantidadVendida=$detalles[$i]['cantidadt'];
            $productoVendido=$detalles[$i]['skut'];

            DB::update("UPDATE productost
                        SET cantidadt=cantidadt-$cantidadVendida
                        WHERE skut=$productoVendido");
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
    public function tickett($folio)
    {
        $ventat= Ventat::find($folio);
        $altura=100;
        //definimos el tamaño del ticket
        $pdf = new Fpdf('P','mm',array(78,$altura));
        $pdf->AddPage();
        //tamaño de laletra


        $pdf->setFont('Arial','B',7);
        //DISEÑO DE TICKET
        $pdf->Cell(60,2,'ABARROTES LA LUPITA',0,1,'C');
        $pdf->ln();
        $pdf->Cell(10,2,'FOLIO: ',0,0,'L');
        //celdaque va a traer eldato dl folio
        $pdf->Cell(25,2,$ventat->folio,0,0,'L');
        $pdf->Cell(11,2,'FECHA: ',0,0,'L');
        $pdf->Cell(14,2,$ventat->fecha_venta,0,1,'L');
        $pdf->Cell(60,1,'','B','C');
        $pdf->ln(2);
        $pdf->setFont('Arial','B',6);
        $pdf->Cell(10,2.5,'SKU',1,0,'C');
        $pdf->Cell(22,2.5,'PRODUCTO',1,0,'C');
        $pdf->Cell(8,2.5,'CANT',1,0,'C');
        $pdf->Cell(10,2.5,'P,U',1,0,'C');
        $pdf->Cell(10,2.5,'TOTAL',1,1,'C');
        $pdf->ln();

        $detalles=$ventat->detalles;
        foreach ($detalles as $detalle) {
            $pdf->Cell(10,2,$detalle->skut,0,0,'C');
            $pdf->Cell(22,2,$detalle->productost->nombret,0,0,'C');
            $pdf->Cell(8,2,$detalle->cantidadt,0,0,'C');
            $pdf->Cell(10,2,$detalle->preciot,0,0,'C');
            $pdf->Cell(10,2,$detalle->total,0,1,'C');
            
        }
        $pdf->OutPut();
        exit;
    }
}
