@extends('layouts.master')
@section('titulo','ventas suc. Kimbila')
@section('contenido')
	
<div id="apiVenta">
	
	
		<div class="row">
			<div class="col-md-6">

				<div align="center">
					<h4>panel de ventas suc. Kimbila</h4>
				</div>
				<br>

				<div class="input-group mb-3">
	  					<input type="text" class="form-control mb-3" placeholder="Escriba el codigo del producto" aria-label="Recipient's username" aria-describedby="basic-addon2" v-model="sku"
	  					v-on:keyup.enter="buscarProducto()">
	  				<div class="input-group-append mb-3">
	   					 <button class="btn btn-primary" style="background-image: url(img/fondo4.jpg);" type="button" @click="buscarProducto()">Añadir</button>

	  				</div>
	  				<!-- <div class="input-group-append mb-3">
	  					<button class="btn btn-success" type="button" @click="mostrarCobro()">Cobrar</button>
	  				</div> -->
	  				<div class="input-group-append mb-3">
	  					<button class="btn btn-success" style="background-image: url(img/fondo4.jpg);" type="button" @click="mostrarBusqueda()">Buscar</button>
	  				</div>
	  				<!-- <div class="input-group-append mb-3">
	  					<a href="productos">Registrar nuevo producto</a>
	  				</div> -->

				</div>

			
				<!-- <h1>@{{prueba}}</h1> -->

			</div>
	</div>
	



	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">

					<p :align=alineacion>Folio: @{{folio}}</p>

					<table class="table table-bordered" style="color:black;">
						<thead>
							<th style="text-align: center" class="table-danger">SKU</th>
							<th style="text-align: center" class="table-danger">PRODUCTO</th>
							
							<th style="text-align: center" class="table-danger">PRECIO</th>
							<th style="text-align: center" class="table-danger">CANTIDAD</th>
							<th style="text-align: center" class="table-danger">OPCIONES</th>
							<th style="text-align: center" class="table-danger">TOTAL</th>
						</thead>

						<tbody>
							<tr v-for="(v,index) in ventas">
								<td>@{{v.sku}}</td>
								<td>@{{v.nombre}}
									<!-- <img v-bind:src=v.foto width="70" height="60"></td> -->
								
								<td>@{{v.precio}}</td>
								<td><input type="number" v-model.number="cantidades[index]"></td>
								<td>
									<button class="btn btn-default btn-sm" @click="eliminarProducto(index)">
										<i class="fa-light fa-trash"></i>
									</button>
								</td>
								<td>@{{totalProducto(index)}}</td>

							</tr>
						</tbody>
					</table>

				</div>

			</div>
			<!--  FIN DEL ROW  -->
	</div> 
	<!-- FIN DEL CARD BODY -->
</div>
<!-- FIN DEL CARD -->

<div class="row">
	<div class="col-md-8"></div>
	

	<div class="col-md-4">
		<div class="card">
			<div class="card-body">
				
					<table class="table table-bordered">
					 	<tr>
					 		<th style="text-align: center" class="table-danger">Subtotal</th>
					 		<td>$ @{{subTotal}}</td>
					 	</tr>

					 	<tr>
					 		<th style="text-align: center" class="table-danger">IVA</th>
					 		<td> $ @{{iva}}</td>
					 	</tr>

					 	<tr>
					 		<th style="text-align: center" class="table-danger">TOTAL</th>
					 		<td><b>$ @{{granTotal}}</b></td>
					 	</tr>
						
						<tr>
							<th style="text-align: center" class="table-danger">Num. PRODUCTOS :</th>
							<td>@{{noArticulos}}</td>
						</tr>
					</table> 

					<div class="input-group-append mb-3">
	  					<button class="btn btn-success" style="background-image: url(img/fondo4.jpg);" type="button" @click="mostrarCobro()">Cobrar</button>
	  				</div>
				
			</div>
			<!-- FIN DEL CARD BODY -->
		</div> 
		<!-- FIN DEL CARD -->
	</div>
			<!-- FIN DEL COL-MD-4 -->
			<div class="input-group-append mb-3">
	  					<a href="productos">Registrar nuevo producto</a>
	  				</div>
</div>

<!-- Modal para el formulario del registro de los moovimientos -->
<div class="modal fade" id="modalCobro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ventana de cobro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-row">
            <div class="col">
              <label for="inputfolio">Total</label>
              <input type="number" class="form-control" disabled="" :value="granTotal">
            </div>
            <div class="col">
              <label for="inputfolio">Paga con</label>
              <input type="number" class="form-control" v-model='pagara_con'>
            </div>
            <div class="col">
              <label for="inputEmail4">Cambio</label>
              <input type="number" class="form-control" disabled="" :value="cambio">
            </div>
          </div>
          
             
        
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click="vender()">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- aqui termina el modal-->
<!-- Modal para la busqueda de productos -->
<div class="modal fade" id="modalBusqueda" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Buscar producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-row">

          	<div class="col-md-6">
          				<label for="inputfolio">Buscar producto</label>
						<input type="text" placeholder="Escriba el nombre del producto" class="form-control" v-model="buscar">
						<label for="inputfolio">Ingrese el SKU para agregar el producto</label>
						<input type="text" class="form-control mb-3" placeholder="SKU del producto" aria-label="Recipient's username" aria-describedby="basic-addon2" v-model="sku"
	  					v-on:keyup.enter="buscarProducto()">



						</div><br>

            <table class="table table-bordered table-striped" style="color:black;">
					<thead>
						
						<th>SKU</th>
						<th>DESCRIPCIÓN</th>
						<th>PRECIO</th>
						<th>CANTIDAD</th>

					</thead>

					<tbody>
						<tr v-for="producto in filtroProductos">
							<th>@{{producto.sku}}</th>
							<td>@{{producto.nombre}}</td>
							<td>$ @{{producto.precio}} MXN</td>
							<td>@{{producto.cantidad}}</td>
							
						</tr>
					</tbody>
				</table>
          </div>
          
             
        
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click="buscarProducto()" ::="sku" data-dismiss="modal">Agregar y cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- aqui termina el modal-->



<!--{{-- FIN DE VENTANA MODAL --}}-->


</div>

	
@endsection

@push('scripts')
	<script type="text/javascript" src="js/vue-resource.js"></script>
	<script type="text/javascript" src="js/apis/apiVenta.js"></script>
	<script type="text/javascript" src="js/moment-with-locales.min.js"></script>
@endpush


<input type="hidden" name="route" value="{{url('/')}}">