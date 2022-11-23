@extends('layouts.master')
@section('titulo','Menú')
@section('contenido')

<h1>Menu IDS 7a</h1>
<button class="btn btn-danger">hola</button>
<div  id="apiPlatillos">


</div>
@endsection

@push('scripts')
     
	<script type="text/javascript" src="js/vue-resource.js"></script>
	<script type="text/javascript" src="js/apis/apiPlatillo.js"></script>
	<script type="text/javascript" src="js/moment-with-locales.min.js"></script>
@endpush

