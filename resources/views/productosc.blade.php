@extends('layouts.master')
@section('titulo','Inventario suc. Citilcum')
@section('contenido')
	
	<!-- INICIA VUE -->
	<div id="productoc">
 <div class="row">
 	<div class="col-md-8">
 	</div>
 </div>

		<div class="row">
			<div class="col-md-12">
				<div align="center">
					<h4>Inventario de productos suc. Citilcum</h4>
				</div>
				<div class="card card border-warning"> 
					<div class="card-header card text-center">
						
						<!-- <h3>Agregar postre
						<span class="btn btn-sm btn-primary" @click="mostrarModal()">
							<i class="fas fa-plus"></i>

						</span>
						</h3>  -->

						<div class="col-md-6">
							<p align="left">Escriba el nombre del producto para realizar búsqueda</p>
						<input type="text" placeholder="Nombre del producto" class="form-control" v-model="buscar">
						</div>
					</div>

					<div class="card-body card border-warning">
						<h3>Agregar producto
						<span class="btn" style="background-image: url(img/fondo4.jpg);" @click="mostrarModal()">
							<!-- <i class="fas fa-plus"></i> -->
							<i class="fa-light fa-cake-slice" style="color:white;"></i>

						</span>
						</h3> 
						
							<!-- INICIO DE LA TABLA -->
				<table class="table table-bordered table-sm" style="color:black;">
					<thead>
						<th hidden="">ID MASCOTA</th>
						<th style="text-align: center" class="table-danger">SKU</th>
						<th style="text-align: center" class="table-danger">DESCRIPCIÓN</th>
						<th style="text-align: center" class="table-danger">PRECIO</th>
						<th style="text-align: center" class="table-danger">DISPONIBLES</th>
						<th style="text-align: center" class="table-danger">OPCIONES</th>

					</thead>

					<tbody>
						<tr v-for="producto in filtroProductos">
							<th>@{{producto.skuc}}</th>
							<td>@{{producto.nombrec}}</td>
							<td>$ @{{producto.precioc}} MXN</td>
							<td>@{{producto.cantidadc}}</td>
							<td>
								<button class="btn" style="background-image: url(img/fondo4.jpg);" @click="editandoProducto(producto.skuc)">
									<!-- <i class="fa-solid fa-file-pen"></i> -->
									<i class="fa-light fa-file-pen" style="color:white"></i>
								</button>

								<button class="btn" style="background-image: url(img/fondo4.jpg);" @click="eliminarProducto(producto.skuc)">
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

			<div class="input-group-append mb-2">
	  					<a href="ventas">Regresar al punto de venta</a>
	  				</div>
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
        <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==true">AGREGANDO PRODUCTO</h5>
        <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==false">EDITANDO PRODUCTO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" class="form-control" placeholder="Escriba el sku" v-model="skuc"><br>
        <input type="text" class="form-control" placeholder="Nombre del producto" v-model="nombrec"><br>
        <input type="number" class="form-control" placeholder="Escriba precio" v-model="precioc"><br>
        <input type="number" class="form-control" placeholder="Escriba la cantidad" v-model="cantidadc"><br>

   
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
	<script type="text/javascript" src="js/apis/apiProductoc.js"></script>
@endpush

<input type="hidden" name="route" value="{{url('/')}}">