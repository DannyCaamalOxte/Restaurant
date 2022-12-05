@extends('layouts.master')
@section('titulo','Agregar platillos')
@section('contenido')

<div id="apiPlatillos">
  <br>
<center><h2>@{{mensaje}}</h2></center>
<br>
<div class="card card-primary card-outline">
              <div class="card-body" >
                
                <div class="row">
                    <div class="col-md-8">
                    <div class="callout callout-info">
                        <div class="row">
                        <div class="col-md-6">
                          <p>Búsqueda</p>
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
                        <button class="btn" @click="mostrarModal()">
                           <i class="fas fa-plus"></i>
                        </button>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-xl-3 col-md-4" v-for="plato in filtro">
                                <div class="card text-white mb-4" style="background:#244F56">
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
                                                <h5>$@{{plato.precio}}</h3>
                                                </div>
                                            </div>
                                        </div>
                                
                                    </div>
                                    
                                    <!--<div class="card-footer d-flex align-items-center justify-content-between">-->
                                    <div class="card-footer" style="background:#244F56">
                                    <div class="row">
                                    <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                    <button class="btn" @click="editarPlatillos(plato.id_platillo
)">
                                    <i class="fas fa-pen">
                            
                                    </i>
                                    </button>
                                    </div>
                                    <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                   <div class="col-sm-6">
                                   <div class="description-block">
                                   <button class="btn" @click="eliminarPlato(plato.id_platillo
)">
                                    <i class="fas fa-trash">
                            
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
                    </div>

                              </div>
                </div>
                </div><!-- /.cuerpo del card -->


<!-- /.ventana modal -->
    <div class="modal fade" id="modalPlatillo">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" v-if="agregar==true">Agregando un platillo</h4>
              <h4 class="modal-title" v-if="agregar==false">Editando un platillo</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Nombre del platillo" v-model="nombre">
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">
                    <input type="number" class="form-control" placeholder="Precio" v-model="precio">
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">
                  <select class="form-control" v-model="categoria">
                    <option disabled="">Elige una categoria</option>
                    <option v-for="categoria in categoriasCargadas" v-bind:value="categoria.id_categoria">
                      @{{categoria.categoria}}
                    </option>
                    
                  </select>

                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Comenta algo..." v-model="comentario">
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" v-if="agregar==true" @click="guardarPlato()">Guardar</button>
              <button type="button" class="btn btn-primary" v-if="agregar==false" @click="actualizarPlato()">Guardar cambios</button>

            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
        <!-- /.fin de ventana modal -->


</div><!-- /.fin del objeto vue -->








@endsection

@push('scripts')
	<script type="text/javascript" src="js/vue-resource.js"></script>
	<script type="text/javascript" src="js/apis/apiPlatillo.js"></script>
	

@endpush


<input type="hidden" name="route" value="{{url('/')}}">