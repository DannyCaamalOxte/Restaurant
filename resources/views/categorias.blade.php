@extends('layouts.master')
@section('titulo','Categorias')
@section('contenido')

<h1>Categorias</h1>
<div id="apiCategorias">
<div v-if="vista==0">
<!--INICIO VISTA 0-->
<div class="card card-primary card-outline">
              <div class="card-body">
                <div class="form-row">
                	<div class="col-md-5">
                		
                	</div>
                	<div class="col-md-6">
                		<h3>@{{mensaje}}</h3>
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
                <h3 class="widget-user-username">@{{categoria.categoria}}</h3>
                <button class="btn btn-sm" style="background:#244F56" @click="">
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
                      <button class="btn btn-warning" @click="editarCategoria(categoria.id_categoria)">
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
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
              </div>

              
            </div><!-- /.card -->

<!--FIN DE VISTA 0-->
</div>
<div v-if="vista==1">

</div>





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