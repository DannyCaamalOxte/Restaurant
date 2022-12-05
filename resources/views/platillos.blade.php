@extends('layouts.master')
@section('titulo','Menú')
@section('contenido')

<!--inicio del contenido del menu vue -->
<div id="apiMenu">
	
<center><h1>@{{mensajemenu}}</h1></center>
 <ol class="breadcrumb mb-4" class="center">
                        	<!-- barra de navegacion del menu -->
                            <li class="breadcrumb-item"><a href="Menú">Todo</a></li>
                            <li class="breadcrumb-item"><a href="Bebidas">Bebidas</a></li>
                            <li class="breadcrumb-item"><a href="Postres">Postres</a></li>
                           
                        </ol>
<div class="card card-primary card-outline">
              <div class="card-body" >
                
                <div class="row">
                    <div class="col-md-8">
                    <div class="callout callout-info">
                        <div class="row">
                        <div class="col-md-6">
                        	<!-- <p>Búsqueda</p> -->
                        <input type="text" class="form-control" placeholder="Escriba el nombre del plato" aria-label="Recipient's username" aria-describedby="basic-addon2" v-model="nombrePlato">
                        </div>
                         <div class="col-md-6">
                         <button class="btn" >
                           <i class="fas fa-search"></i>
                        </button>
                         </div>   
                        </div>
                        
                    </div>
                    </div>

                     <div class="col-md-1">
                        <div class="callout callout-info">
                        <button class="btn" @click="mostrarModal()" >
                           <i class="fa-duotone fa-cart-shopping-fast" ></i>
                        </button>
                        </div>
                    </div>
                    
                    <div class="row">
                    <div class="col-xl-3 col-md-4" v-for="plato in filtro">
                                <div class="card bg-info text-white mb-4">
                                    <img src="dist/img/jugonaranja.jpg">
                                    <div class="card-body" >
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="description-block">
                                                @{{plato.nombre}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-sm-12">
                                                <div class="description-block">
                                                <p>@{{plato.comentario}}</p>
                                                </div>
                                            </div>
                                        </div>
                                
                                    </div>
                                    
                                    <!--<div class="card-footer d-flex align-items-center justify-content-between">-->
                                    <div class="card-footer">
                                    <div class="row">
                                    <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                    <p>$@{{plato.precio}} MXN</p>
                                    </div>
                                    <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                   <div class="col-sm-6">
                                   <div class="description-block">
                                   <button class="btn" @click="eliminarPlato(plato.id_platillo
)">
                                    <i class="fa-duotone fa-cart-shopping-fast"></i>
                            
                                    </i>
                                    </button>
                                    </div>
                                    <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                    </div>
                                    </div>
                         </div><!-- /.Fin de la targeta de producto -->

                         <!-- modal -->

                         <!-- Modal para el formulario del registro de los moovimientos -->
<div class="modal fade" id="modalcompras" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro de Clientes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          
          
          
             
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click="guardarAlumno()">Cobrar</button>
      </div>
    </div>
  </div>
</div>
<!-- aqui termina el modal-->

                         <!-- modal -->
                    </div>

                              </div>


                </div>


                </div><!-- /.cuerpo del card -->

                



		<!-- /.ventana modal -->

		<!-- Modal para el formulario del registro de los moovimientos -->
<!-- Modal para el formulario del registro de los moovimientos -->


<!-- aqui termina el modal-->
   
        <!-- /.fin de ventana modal -->
	</div>
<!-- fin del contenido del menu vue-->


@endsection

@push('scripts')
     
	<script type="text/javascript" src="js/vue-resource.js"></script>
	<script type="text/javascript" src="js/apis/apiMenu.js"></script>

	<script type="text/javascript" src="js/moment-with-locales.min.js"></script>
@endpush
<input type="hidden" name="route" value="{{ url('/') }}">

