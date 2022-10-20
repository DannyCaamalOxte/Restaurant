var ruta = document.querySelector("[name=route]").value;
var apiProducto = ruta + '/apiProducto';  

new Vue({
    http: {
        headers: {
          'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
        }
      },
      el:"#producto",

      data:{
          productos:[],
          nombre:'',
          precio:'',
          cantidad:'',
          agregando:true,
          sku:'',
          buscar:'',
      },

      //funcion que se usa cuando se crea la pagina
      created:function(){
        this.obtenerProductos();
      },

      methods:{

        obtenerProductos:function(){
          this.$http.get(apiProducto).then(function(json){
            this.productos=json.data;
            console.log(json.data)
          }).catch(function(json){
            console.log(json);
          });
        },
        //borrar es de prueba
        mostrarBusqueda:function(){
         $('#modalBusqueda').modal('show');

          },
        mostrarModal:function(){
          this.agregando=true;
          this.nombre='';
          this.precio='';
          this.cantidad=''; 
          $('#modalProductos').modal('show');
        },
        editandoProducto:function(id){
          this.agregando=false;
          this.sku=id;
          this.$http.get(apiProducto + '/' + id).then(function(json){
            this.nombre=json.data.nombre;
            this.precio=json.data.precio;
            this.cantidad=json.data.cantidad;
          });
          $('#modalProductos').modal('show');
        },
        actualizarProducto:function(){
          var jsonProducto = {nombre:this.nombre,
                              precio:this.precio,
                              cantidad:this.cantidad};
          this.$http.patch(apiProducto + '/' + this.sku,jsonProducto).then(function(json){
            this.obtenerProductos();
          });
          $('#modalProductos').modal('hide');
        },
         eliminarProducto:function(id){
            var confir = confirm('¿Desea eliminar el postre?');

            if (confir) {
               this.$http.delete(apiProducto + '/' + id).then(function(json){
                 this.obtenerProductos();
               }).catch(function(json){
                 console.log(json);
               });
            }
        },
        guardarProducto:function(){

          var producto = {
            nombre:this.nombre,
            precio:this.precio,
            cantidad:this.cantidad,
            sku:this.sku
          };

          this.$http.post(apiProducto,producto).then(function(json){
            this.obtenerProductos();
            this.nombre='';
            this.precio='';
            this.cantidad='';
          }).catch(function(json){
            console.log(json);
          });

          $('#modalProductos').modal('hide');
          console.log(producto);
        },

      },
      //FIN DE METHODS

      computed:{
    

    filtroProductos:function(){
      return this.productos.filter((producto)=>{
        return producto.nombre.toLowerCase().match(this.buscar.toLowerCase().trim()) 

      });
    },
    total:function(){
      var t=0;
      t= this.cantidad * this.precio;
      return t;
    },
  }
})