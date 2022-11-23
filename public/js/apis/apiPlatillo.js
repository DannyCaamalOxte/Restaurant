var apiCat='http://localhost/ttd4a22/public/apiCat';

new Vue({
	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },

    el:"#apiCategorias",

    data:{
    	mensaje:'Categorías',
    	categoriasCargadas:[],

      nombre_categoria:'',

      id_grupo:'',

      agregando:true,

      visualizar:0,

      prods:[],

    },
    created:function(){
    	this.obtenercategorias();

    },
    methods:{
    	obtenercategorias:function(){
    		this.$http.get(apiCat).then(function(j){
    			this.categoriasCargadas=j.data;
    			console.log(this.categoriasCargadas);
    		})
    	   
    	},
      mostrarModalCategorias:function(){
        $('#modalCategorias').modal('show');

      },
      guardarCategoria:function(){
        //construir el objeto
        var categoria = {nombre_grupo:this.nombre_categoria};

        this.$http.post(apiCat,categoria).then(function(j){
          $('#modalCategorias').modal('hide');
          //console.log('exito');
          this.obtenercategorias();
          //limpiamos el valor de categoria en el data
          this.nombre_categoria='';
        }).catch(function(j){
          console.log(j);
        })

      },
      editandoCategoria:function(id){//toda esta funcion sirve para elegir el objeto que sera editado 
        //es necesario el metodo show en el controlador
        this.agregando=false;

        this.id_grupo=id;

        this.$http.get(apiCat + '/' + id).then(function(j){
          console.log(j);
          this.nombre_categoria=j.data.nombre_grupo;
        })
        $('#modalCategorias').modal('show');

      },
      actualizarCategoria:function(){

        var cambiosCat={nombre_grupo:this.nombre_categoria}

        this.$http.patch(apiCat + '/' + this.id_grupo,cambiosCat).then(function(j){
          this.obtenercategorias();

        })
        $('#modalCategorias').modal('hide');

      },
      eliminarCategoria:function(id){

        this.id_grupo=id;

        Swal.fire({
         title: 'Esta seguro de eliminar?',
         text: "No podras revertir el cambio luego de confirmar! Recuerda que para eliminar correctamente es necesario que la categoria no cuente con productos, puedes moverlos a otra categoria para vaciar la que deseas eliminar",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Sí, eliminar!'
         }).then((result) => {
           if (result.isConfirmed) {
            this.$http.delete(apiCat + '/' + id).then(function(j){
                //el get especies sirve para mostrar la tabla actualizada
                this.obtenercategorias();
            }).catch(function(j){
                console.log(j);
            })
            Swal.fire(
           'Eliminado!',
           'El producto se eliminó :(',
           'Listo'
          )
          }
         })

      },
      verProductos:function(id){

        this.prods=id;
        console.log(this.prods);
        this.visualizar=1;

      },
      regresarPrincipal:function(){
        this.visualizar=0;
      }


    },
})