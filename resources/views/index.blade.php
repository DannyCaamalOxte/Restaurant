@extends('layouts.master')
@section('titulo','Inicio')
@section('contenido')
	
	<!-- INICIA VUE -->
	<div id="index">

		<!--inicio de card-->
			

	

 


	</div>
	<!-- TERMINA VUE -->

	
@endsection

@push('scripts')
	<script type="text/javascript" src="js/vue-resource.js"></script>
	<script type="text/javascript" src="js/apis/apiProducto.js"></script>
@endpush

<input type="hidden" name="route" value="{{url('/')}}">