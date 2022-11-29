@extends('layouts.master')
@section('titulo','Bebidas')
@section('contenido')

<!--inicio del contenido del menu -->
<div class="container-fluid px-4">
                        <div class="container-fluid px-4" style="text-align: center;">
                        <h5 class="mt-4">Bebidas</h5>
                        <ol class="breadcrumb mb-4" class="center">
                        	<!-- barra de navegacion del menu -->
                            <li class="breadcrumb-item"><a href="Menú">Todo</a></li>
                            <li class="breadcrumb-item"><a href="Bebidas">Bebidas</a></li>
                            <li class="breadcrumb-item"><a href="Postres">Postres</a></li>
                           
                        </ol>                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-info text-white mb-4">
                                    <img src="dist/img/bebidauva.jpg">
                                    <div class="card-body"><center>Bebida de uva</center></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">$50.00 MXN</a>
                                        <div class="small text-white"><i class="fa-duotone fa-cart-shopping"></i></div>
                                    </div>
                                </div>
                            </div>

                             <div class="col-xl-3 col-md-6">
                                <div class="card bg-info text-white mb-4">
                                    <img src="dist/img/jugonaranja.jpg">
                                    <div class="card-body"><center>Bebida sabor naranja</center></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">$30.00 MXN</a>
                                        <div class="small text-white"><i class="fa-duotone fa-cart-shopping"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-info text-white mb-4">
                                    <img src="dist/img/bebidasandia.jpg" height="180">
                                    <div class="card-body"><center>Bebida de sandia</center></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">$20.00 MXN</a>
                                        <div class="small text-white"><i class="fa-duotone fa-cart-shopping"></i></div>
                                    </div>
                                </div>
                            </div>



                            


                            
                           
                            
               
                        </div>

                        <div align="right">
                        	<a href="#"><i class="fa-duotone fa-cart-shopping" href="#"></i>
			</a>

                        	
		</div>
<!-- fin del contenido del menu -->


</div>
@endsection

@push('scripts')
     
	<script type="text/javascript" src="js/vue-resource.js"></script>
	<script type="text/javascript" src="js/apis/apiPlatillo.js"></script>
	<script type="text/javascript" src="js/moment-with-locales.min.js"></script>
@endpush

