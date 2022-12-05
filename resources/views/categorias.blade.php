@extends('layouts.master')
@section('titulo','Categorias')
@section('contenido')

<div id="apiCategorias">
<br>
<center><h2>@{{mensaje}}</h2></center>
<br>
<div v-if="vista==0">
<!--INICIO VISTA 0-->
<div class="card card-primary card-outline">
              <div class="card-body">
                <div class="form-row">
                	<div class="col-md-5">
                		
                	</div>
                	<div class="col-md-6">
                		
                	</div>
                	
                   

           
                   <button class="btn btn-secondary" @click="mostrarModal()">
            	   <i class="fas fa-plus"></i>
                   </button>
                	
                </div>
            <br>

           <div class="form-row">

           <div class="col-md-4"  v-for="categoria in categoriasCargadas">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user" >
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header " style="background:#244F56">
                <h3 class="widget-user-username text-white">@{{categoria.categoria}}</h3>
                <button class="btn btn-sm text-white" style="background:#244F56" @click="cambiarVista1(categoria.productos)">
                  Ver
                </button>
              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="dist/img/AdminLTELogo.png" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <button class="btn btn-warning " @click="editarCategoria(categoria.id_categoria)">
                        <i class="fas fa-pen">
                            
                          </i>
                      </button>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <button class="btn btn-danger" @click="eliminarPlato(categoria.id_categoria)">
                        <i class="fas fa-trash">
                            
                          </i>
                      </button>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">@{{categoria.productos.length}}</h5>
                      <span class="description-text">PRODUCTOS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
            	
            </div>
                
              </div>

              
            </div><!-- /.card -->

<!--FIN DE VISTA 0-->
</div>
<div v-if="vista==1">
<!--MOSTRAR PRODUCTOS DE UNA CATEGORIA-->
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h5>Productos</h5>
    </div>
    <div class="card-body">
      <div class="form-row">
        <div class="col-md-6">
          <!--TABLA-->
          <table class="table table-bordered table-striped table-hover table-sm">
        <thead>
          <th>Nombre</th>
          <th>Clave</th>
        </thead>
        <tbody>
          <tr v-for="p in prods">
            <td>@{{p.nombre}}</td>
            <td>@{{p.precio}}</td>
          </tr>
        </tbody>
      </table>
      <!-- FIN DE TABLA-->
        </div> 
        <div class="col-md-6">
          <div class="alert alert-info alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-info"></i> Atención!</h5>
                  <h5>Recuerda que puedes cambiar las categorias a las que pertenecen los productos en la vista Agregar platillos</h5>
        </div>
          
        </div>
      </div>
      
      <!--@{{prods}}-->
      <button class="btn btn-sm text-white"style="background:#244F56" @click="regresarPrincipal()">
        Regresar
      </button>
    </div>
  </div>
</div>
<!--FIN DE MOSTRAR PRODUCTOS DE UNA CATEGORIA-->





<!--VENTANA MODAL REGISTRO DE CATEGORIA-->
<div class="modal fade" id="modalCategorias" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" v-if="agregar==true">Agregando Categoría</h5>
        <h5 class="modal-title" id="exampleModalLabel" v-if="agregar==false">Editando Categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-row">
            <div class="col col-md-12">
              <!--v-model sirve para capturar los datos y pasarlo a la variable establecida en el archivo js-->
              <input type="text" class="form-control" placeholder="nombre de la categoria" v-model="nombre_categoria">
              
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click="guardarCategoria()"  v-if="agregar==true">Guardar</button>
        <button type="button" class="btn btn-warning" @click="actualizarCategoria()" v-if="agregar==false">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>
<!--FIN DE VENTANA MODAL REGISTRO DE CATEGORIA-->

</div><!--fin del objeto vue-->
@endsection

@push('scripts')
	<script type="text/javascript" src="js/vue-resource.js"></script>
	<script type="text/javascript" src="js/apis/apiCategoria.js"></script>
	

@endpush


<input type="hidden" name="route" value="{{url('/')}}">