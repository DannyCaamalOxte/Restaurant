var ruta = document.querySelector("[name=route]").value;

var apiPlato=ruta + '/apiPlato';
var apiCat=ruta + '/apiCat';
new Vue({
	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },

    el:"#apiPlatillos",

    data:{
    	mensaje:'Administración del menú',
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
      obtenerCategorias:function(){
    		this.$http.get(apiCat).then(function(j){
    			this.categoriasCargadas=j.data;
    			console.log(this.categoriasCargadas);
    		})
    	   
    	},
      mostrarModal:function(){
        this.agregar=true;
        this.limpiarModal();
        $('#modalPlatillo').modal('show');

      },
      guardarPlato:function(){
        if (this.nombre.length === 0 || /^\s+$/.test(this.nombre)) {
          Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Ingresa el nombre del producto',
            showConfirmButton: false,
            timer: 1500
            })
        }else{
          if (this.precio.length === 0 || /^\s+$/.test(this.precio)) {
            Swal.fire({
              position: 'center',
              icon: 'warning',
              title: 'Ingresa el precio del producto',
              showConfirmButton: false,
              timer: 1500
              })
          } else {
            //construir el objeto
              var plato = {nombre:this.nombre,precio:this.precio,comentario:this.comentario,categoria:this.categoria};
              //console.log(plato);
              this.$http.post(apiPlato,plato).then(function(j){
              $('#modalPlatillo').modal('hide');
              //console.log('exito');
              this.obtenerPlatos();
             //limpiamos el valor de categoria en el data
             this.limpiarModal();
             }).catch(function(j){
             //console.log(j);
             })

             Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Se agregó un nuevo plato',
              showConfirmButton: false,
              timer: 1500
            })
    
            
          }
        }
        

       
      },
      limpiarModal:function(){
        this.nombre='',
        this.precio='',
        this.comentario=''

      },
      editarPlatillos:function(id){
          this.agregar=false;
          this.id_plato=id;
          //console.log(this.id_plato);
          this.$http.get(apiPlato + '/' + id).then(function(j){
            console.log(j);
            this.nombre=j.data.nombre;
            this.precio=j.data.precio;
            this.comentario=j.data.comentario;
          })
          $('#modalPlatillo').modal('show');
      },
      actualizarPlato:function(){
        if (this.nombre.length === 0 || /^\s+$/.test(this.nombre)) {
          Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'No puedes dejar vacio el nombre',
            showConfirmButton: false,
            timer: 1500
            })
        } else {
          if (this.precio.length === 0 || /^\s+$/.test(this.precio)) {
            Swal.fire({
              position: 'center',
              icon: 'warning',
              title: 'No puedes dejar vacio el precio',
              showConfirmButton: false,
              timer: 1500
              })
            
          } else {
            var cambiosPlato = {nombre:this.nombre,
              precio:this.precio,
              comentario:this.comentario}
              //console.log(cambiosProducto);
              //console.log(this.categoriasCargadas);
    
              this.$http.patch(apiPlato + '/' + this.id_plato,cambiosPlato).then(function(j){
              this.obtenerPlatos();
              
              });
              $('#modalPlatillo').modal('hide');
              Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Actualizado',
                showConfirmButton: false,
                timer: 1500
              })
      
          }
          
        }
        
      },
      eliminarPlato(id){
        Swal.fire({
          title: 'Esta seguro de eliminar?',
          text: "No podras revertir el cambio luego de confirmar!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sí, eliminar!'
          }).then((result) => {
            if (result.isConfirmed) {
             this.$http.delete(apiPlato + '/' + id).then(function(j){
                 //el get especies sirve para mostrar la tabla actualizada
                 this.obtenerPlatos();
             }).catch(function(j){
                 //console.log(j);
             })
             Swal.fire(
            'Eliminado!',
            'El plato se eliminó :(',
            'Listo'
           )
           }
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