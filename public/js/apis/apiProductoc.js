var ruta = document.querySelector("[name=route]").value;
var apiProductoc = ruta + '/apiProductoc';  

new Vue({
    http: {
        headers: {
          'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
        }
      },
      el:"#productoc",

      data:{
          productosc:[],
          nombrec:'',
          precioc:'',
          cantidadc:'',
          agregando:true,
          skuc:'',
          buscar:'',
      },

      //funcion que se usa cuando se crea la pagina
      created:function(){
        this.obtenerProductos();
      },

      methods:{

        obtenerProductos:function(){
          this.$http.get(apiProductoc).then(function(json){
            this.productosc=json.data;
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
          this.nombrec='';
          this.precioc='';
          this.cantidadc=''; 
          $('#modalProductos').modal('show');
        },
        editandoProducto:function(id){
          this.agregando=false;
          this.skuc=id;
          this.$http.get(apiProductoc + '/' + id).then(function(json){
            this.nombrec=json.data.nombrec;
            this.precioc=json.data.precioc;
            this.cantidadc=json.data.cantidadc;
          });
          $('#modalProductos').modal('show');
        },
        actualizarProducto:function(){
          var jsonProducto = {nombrec:this.nombrec,
                              precioc:this.precioc,
                              cantidadc:this.cantidadc};
          this.$http.patch(apiProductoc + '/' + this.skuc,jsonProducto).then(function(json){
            this.obtenerProductos();
          });
          $('#modalProductos').modal('hide');
        },
         eliminarProducto:function(id){
            var confir = confirm('¿Desea eliminar el postre?');

            if (confir) {
               this.$http.delete(apiProductoc + '/' + id).then(function(json){
                 this.obtenerProductos();
               }).catch(function(json){
                 console.log(json);
               });
            }
        },
        guardarProducto:function(){

          var productoc = {
            nombrec:this.nombrec,
            precioc:this.precioc,
            cantidadc:this.cantidadc,
            skuc:this.skuc
          };

          this.$http.post(apiProductoc,productoc).then(function(json){
            this.obtenerProductos();
            this.nombrec='';
            this.precioc='';
            this.cantidadc='';
          }).catch(function(json){
            console.log(json);
          });

          $('#modalProductos').modal('hide');
          console.log(productoc);
        },

      },
      //FIN DE METHODS

      computed:{
    

    filtroProductos:function(){
      return this.productosc.filter((productoc)=>{
        return productoc.nombrec.toLowerCase().match(this.buscar.toLowerCase().trim()) 

      });
    },
    total:function(){
      var t=0;
      t= this.cantidadc * this.precioc;
      return t;
    },
  }
})