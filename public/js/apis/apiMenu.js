var ruta = document.querySelector("[name=route]").value;

var apiPlato=ruta + '/apiPlato';
var apiCat=ruta + '/apiCat';
new Vue({
	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },

    el:"#apiMenu",

    data:{
      mensajemenu:'Menú (Todos)',
      platosCargados:[],
      categoriasCargadas:[],
      nombre:'',
      precio:0,
      comentario:'',
      agregar:true,
      id_plato:'',
      nombrePlato:'',
      categoria:'',

    },
    created:function(){
    	this.obtenerPlatos();
      this.obtenerCategorias();

    },
    methods:{
    	obtenerPlatos:function(){
    		this.$http.get(apiPlato).then(function(j){
    			this.platosCargados=j.data;
    			console.log(this.platosCargados);
    		})
    	   
    	},
       mostrarModal:function(){
        
        $('#modalcompras').modal('show');

      },
      obtenerCategorias:function(){
    		this.$http.get(apiCat).then(function(j){
    			this.categoriasCargadas=j.data;
    			console.log(this.categoriasCargadas);
    		})
    	   
    	},
      
      
          
    
      

    },
    computed:{
      filtro(){
        return this.platosCargados.filter((pro)=>{
          return pro.nombre.toLowerCase().match(this.nombrePlato.toLowerCase().trim())
          });

      },

    }
})