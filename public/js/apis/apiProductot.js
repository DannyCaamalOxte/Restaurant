var ruta = document.querySelector("[name=route]").value;
var apiProductot = ruta + '/apiProductot';  

new Vue({
    http: {
        headers: {
          'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
        }
      },
      el:"#productot",

      data:{
          productost:[],
          nombret:'',
          preciot:'',
          cantidadt:'',
          agregando:true,
          skut:'',
          buscar:'',
      },

      //funcion que se usa cuando se crea la pagina
      created:function(){
        this.obtenerProductos();
      },

      methods:{

        obtenerProductos:function(){
          this.$http.get(apiProductot).then(function(json){
            this.productost=json.data;
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
          this.nombret='';
          this.preciot='';
          this.cantidadt=''; 
          $('#modalProductos').modal('show');
        },
        editandoProducto:function(id){
          this.agregando=false;
          this.skut=id;
          this.$http.get(apiProductot + '/' + id).then(function(json){
            this.nombret=json.data.nombret;
            this.preciot=json.data.preciot;
            this.cantidadt=json.data.cantidadt;
          });
          $('#modalProductos').modal('show');
        },
        actualizarProducto:function(){
          var jsonProducto = {nombret:this.nombret,
                              preciot:this.preciot,
                              cantidadt:this.cantidadt};
          this.$http.patch(apiProductot + '/' + this.skut,jsonProducto).then(function(json){
            this.obtenerProductos();
          });
          $('#modalProductos').modal('hide');
        },
         eliminarProducto:function(id){
            var confir = confirm('¿Desea eliminar el producto?');

            if (confir) {
               this.$http.delete(apiProductot + '/' + id).then(function(json){
                 this.obtenerProductos();
               }).catch(function(json){
                 console.log(json);
               });
            }
        },
        guardarProducto:function(){

          var productot = {
            nombret:this.nombret,
            preciot:this.preciot,
            cantidadt:this.cantidadt,
            skut:this.skut
          };

          this.$http.post(apiProductot,productot).then(function(json){
            this.obtenerProductos();
            this.nombret='';
            this.preciot='';
            this.cantidadt='';
          }).catch(function(json){
            console.log(json);
          });

          $('#modalProductos').modal('hide');
          
          console.log(productot);
        },

      },
      //FIN DE METHODS

      computed:{
    

    filtroProductos:function(){
      return this.productost.filter((productot)=>{
        return productot.nombret.toLowerCase().match(this.buscar.toLowerCase().trim()) 

      });
    },
    total:function(){
      var t=0;
      t= this.cantidadt * this.preciot;
      return t;
    },
  }
})