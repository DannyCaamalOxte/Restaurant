@extends('layouts.master')
@section('titulo','Pedidos')
@section('contenido')
	
	<!-- INICIA VUE -->
	<div id="pedido">
 <div class="row">
 	<div class="col-md-8">
 	</div>
 </div>

		<div class="row">
			<div class="col-md-12">
				<div align="center">
					<h4>Administración de Pedidos</h4>
				</div>
				<div class="card card border-warning"> 
					<div class="card-header card text-center">
						
						<!-- <h3>Agregar postre
						<span class="btn btn-sm btn-primary" @click="mostrarModal()">
							<i class="fas fa-plus"></i>

						</span>
						</h3>  -->

						<div class="col-md-10">
							<!-- <p align="left">Escriba el nombre del producto para realizar búsqueda</p>
						<input type="text" placeholder="Nombre del producto" class="form-control" v-model="buscar"> -->
						<div class="input-group mb-1">
							<p>Proporcione la fecha para ver los pedidos.</p>
						</div>
						<div class="input-group">
							<input type="date" class="col-md-2 form-control" v-model="buscar2">
						<p> al </p>
						<input type="date" class="col-md-2 form-control" v-model="buscar3">							
						</div>
						</div>
					</div>

					<div class="card-body card border-warning">
						<h3>Agregar pedido
						<span class="btn" style="background-image: url(img/fondo4.jpg);" @click="mostrarModal()">
							<!-- <i class="fas fa-plus"></i> -->
							<i class="fa-light fa-file-export" style="color:white;"></i>
							<!-- <i class="fa-light fa-cake-slice" style="color:white;"></i> -->

						</span>
						</h3> 
						
							<!-- INICIO DE LA TABLA -->
				<table class="table table-bordered table-sm" style="color:black;">
					<thead>
						<th style="text-align: center" class="table-danger" hidden="">SKU</th>
						<th style="text-align: center" class="table-danger">CLIENTE</th>
						<th style="text-align: center" class="table-danger">COLOR</th>
						<th style="text-align: center" class="table-danger">SABOR</th>
						<th style="text-align: center" class="table-danger">TEXTO</th>
						<th style="text-align: center" class="table-danger">FECHA</th>
						<th style="text-align: center" class="table-danger">HORA</th>
						<th style="text-align: center" class="table-danger">SUCURSAL</th>
						<th style="text-align: center" class="table-danger">TÉLEFONO</th>
						<th style="text-align: center" class="table-danger">PRECIO</th>
						<th style="text-align: center" class="table-danger">OPCIONES</th>

					</thead>

					<tbody>
						<tr v-for="pedido in filtrofechas">
							<th hidden="">@{{pedido.skup}}</th>
							<td>@{{pedido.nombrep}}</td>
							<td>@{{pedido.color}}</td>
							<td>@{{pedido.sabor}}</td>
							<td>@{{pedido.texto}}</td>
							<td>@{{pedido.fecha}}</td>
							<td>@{{pedido.hora}}</td>
							<td>@{{pedido.sucursal}}</td>
							<td>@{{pedido.telefono}}</td>
							<td>$ @{{pedido.preciop}} MXN</td>
							<td>
								<button class="btn" style="background-image: url(img/fondo4.jpg);" @click="editandoProducto(pedido.skup)">
									<!-- <i class="fa-solid fa-file-pen"></i> -->
									<i class="fa-light fa-file-pen" style="color:white"></i>
								</button>

								<button class="btn" style="background-image: url(img/fondo4.jpg);" @click="eliminarProducto(pedido.skup)">
									<!-- <i class="fas fa-trash-alt"></i> -->
									<i class="fa-light fa-trash" style="color:white"></i>
								</button>
							</td>
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
		</div>
		<!--fin del row-->
		<div align="center">
			<img src="img/martha.png" width="120" height="120">
		</div>

<!-- INICIA VENTANA MODAL -->
<div class="modal fade" id="modalProductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==true">AGREGANDO PEDIDO</h5>
        <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==false">EDITANDO PEDIDO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <input type="number" class="form-control" placeholder="Escriba el sku" v-model="skup"><br> -->
        <input type="text" class="form-control" placeholder="Nombre del cliente" v-model="nombrep"><br>
        <input type="text" class="form-control" placeholder="Color del pastel" v-model="color"><br>
        <input type="text" class="form-control" placeholder="Sabor del pastel" v-model="sabor"><br>
        <input type="text" class="form-control" placeholder="Texto del pastel" v-model="texto"><br>
        <input type="date" class="form-control" placeholder="Fecha de entrega" v-model="fecha"><br>
        <input type="time" class="form-control" placeholder="Hora de entrega" v-model="hora"><br>
        <input type="text" class="form-control" placeholder="Sucursal" v-model="sucursal"><br>
        <input type="text" class="form-control" placeholder="Télefono" v-model="telefono"><br>
        <input type="number" class="form-control" placeholder="Escriba precio" v-model="preciop"><br>
       

   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click="guardarProducto()" v-if="agregando==true" style="background-image: url(img/fondo4.jpg);">Guardar</button>

        <button type="button" class="btn btn-primary" @click="actualizarProducto()" v-if="agregando==false">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- FIN MODAL -->


	</div>
	<!-- TERMINA VUE -->

	
@endsection

@push('scripts')
	<script type="text/javascript" src="js/vue-resource.js"></script>
	<script type="text/javascript" src="js/apis/apiPedido.js"></script>
@endpush

<input type="hidden" name="route" value="{{url('/')}}">