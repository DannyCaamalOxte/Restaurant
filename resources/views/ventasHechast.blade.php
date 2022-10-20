@extends('layouts.master')
@section('titulo','Historial de ventas suc. Tekanto')
@section('contenido')
	
	<!-- INICIA VUE -->
	<div id="apiVentashechas">
 <div class="row">
 	<div class="col-md-8">
 	</div>
 </div>

		<div class="row">
			<div class="col-md-12">
				<div align="center">
					<h4>Detalles de ventas suc. Tekanto</h4>
					
				</div>
				<div class="card card border-warning"> 
					<div class="card-header card text-center">
						
						<!-- <h3>Agregar postre
						<span class="btn btn-sm btn-primary" @click="mostrarModal()">
							<i class="fas fa-plus"></i>

						</span>
						</h3>  -->

						<!-- <div class="col-md-6">
							<p align="left">Escriba el folio para realizar búsqueda</p>
						<input type="text" placeholder="Nombre del producto" class="form-control" v-model="buscar">
						</div> -->

						<!-- <div class="col-md-6">
							<p align="left">Escriba la fecha para realizar búsqueda</p>
						<input type="date" class="form-control" v-model="buscar2">
						<input type="date" class="form-control" v-model="buscar3">
						</div>
						<div class="col">
			             <label for="inputfolio">Total</label>
			             <input type="number" class="form-control" disabled="" :value="totalNeto">
			            </div> -->
			            <div class="input-group mb-1">
							<p>Proporcione el rango de fecha para calcular</p>
						</div>
						<div class="input-group">
							<input type="date" class="col-md-2 form-control" v-model="buscar2">
						<p> al </p>
						<input type="date" class="col-md-2 form-control" v-model="buscar3">							
						</div>
						<br>
						<div class="input-group">
              <label for="inputfolio">Total de ventas: </label>
              <input class="col-md-1 form-control" type="number" disabled="" :value="totalNeto">
            </div>

					</div>

					<div class="card-body card border-warning">
						
						
							<!-- INICIO DE LA TABLA -->
				<table class="table table-bordered table-sm" style="color:black;">
					<thead>
						<th hidden="">ID MASCOTA</th>
						<th style="text-align: center" class="table-danger">FOLIO</th>
						<th style="text-align: center" class="table-danger">FECHA DE VENTA</th>
						<th style="text-align: center" class="table-danger">CANTIDAD DE PRODUCTOS</th>
						<th style="text-align: center" class="table-danger">DETALLES</th>
						<th style="text-align: center" class="table-danger">TOTAL</th>

					</thead>

					<tbody>
						<tr v-for="apiVentashechas in filtrofechas">
							<th>@{{apiVentashechas.folio}}</th>
							<td>@{{apiVentashechas.fecha_venta}}</td>
							<td>@{{apiVentashechas.num_articulos}} Productos</td>
							<td>
								<a href="{{ url('/ticket/{folio}') }}">Ver/imp ticket</a>
								
								</td>
							<td>@{{apiVentashechas.total}}</td>
						</tr>
					</tbody>
				</table>
				<!-- FIN DE LA TABLA -->

					</div>
				
					
				</div>
			</div>  
			<!-- FIN DE COL-MD-12 -->

			<!-- <div class="input-group-append mb-2">
	  					<a href="ventas">Regresar al punto de venta</a>
	  				</div> -->
	  				<!-- <div class="col">
              <label for="inputfolio">Total</label>
              <input type="number" class="form-control" disabled="" :value="totalNeto">
            </div> -->
		</div>
		<!--fin del row-->
		<div align="center">
			<img src="img/martha.png" width="120" height="120">
		</div>

<!-- INICIA VENTANA MODAL -->
<!-- <div class="modal fade" id="modalProductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==true">AGREGANDO PRODUCTO</h5>
        <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==false">EDITANDO PRODUCTO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" class="form-control" placeholder="Escriba el sku" v-model="sku"><br>
        <input type="text" class="form-control" placeholder="Nombre del producto" v-model="nombre"><br>
        <input type="number" class="form-control" placeholder="Escriba precio" v-model="precio"><br>
        <input type="number" class="form-control" placeholder="Escriba la cantidad" v-model="cantidad"><br>

   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click="guardarProducto()" v-if="agregando==true" style="background-image: url(img/fondo4.jpg);">Guardar</button>

        <button type="button" class="btn btn-primary" @click="actualizarProducto()" v-if="agregando==false">Guardar</button>
      </div>
    </div>
  </div>
</div> -->
<!-- FIN MODAL -->


	</div>
	<!-- TERMINA VUE -->

	
@endsection

@push('scripts')
	<script type="text/javascript" src="js/vue-resource.js"></script>
	<script type="text/javascript" src="js/apis/apiVentashechast.js"></script>
@endpush

<input type="hidden" name="route" value="{{url('/')}}">