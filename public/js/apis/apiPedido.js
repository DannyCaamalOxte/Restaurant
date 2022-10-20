var ruta = document.querySelector("[name=route]").value;
var apiPedido = ruta + '/apiPedido';  

new Vue({
    http: {
        headers: {
          'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
        }
      },
      el:"#pedido",

      data:{
          pedidos:[],
          nombrep:'',
          color:'',
          sabor:'',
          texto:'',
          fecha:'',
          hora:'',
          sucursal:'',
          telefono:'',
          preciop:'',
          cantidadc:'',
          agregando:true,
          skup:'',
          buscar:'',
          buscar2:'',
          buscar3:'',
      },

      //funcion que se usa cuando se crea la pagina
      created:function(){
        this.obtenerProductos();
      },

      methods:{

        obtenerProductos:function(){
          this.$http.get(apiPedido).then(function(json){
            this.pedidos=json.data;
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
          this.nombrep='';
          this.color='';
          this.sabor='';
          this.texto='';
          this.fecha='';
          this.hora='';
          this.sucursal='';
          this.telefono='';
          this.preciop='';
          $('#modalProductos').modal('show');
        },
        editandoProducto:function(id){
          this.agregando=false;
          this.skup=id;
          this.$http.get(apiPedido + '/' + id).then(function(json){
            this.nombrep=json.data.nombrep;
            this.color=json.data.color;
            this.sabor=json.data.sabor;
            this.texto=json.data.texto;
            this.fecha=json.data.fecha;
            this.hora=json.data.hora;
            this.sucursal=json.data.sucursal;
            this.telefono=json.data.telefono;
            this.preciop=json.data.preciop;
          });
          $('#modalProductos').modal('show');
        },
        actualizarProducto:function(){
          var jsonPedido = {nombrep:this.nombrep,
                              color:this.color,
                              sabor:this.sabor,
                              texto:this.texto,
                              fecha:this.fecha,
                              hora:this.hora,
                              sucursal:this.sucursal,
                              telefono:this.telefono,
                              preciop:this.preciop};
          this.$http.patch(apiPedido + '/' + this.skup,jsonPedido).then(function(json){
            this.obtenerProductos();
          });
          $('#modalProductos').modal('hide');
        },
         eliminarProducto:function(id){
            var confir = confirm('¿Desea eliminar el pedido?');

            if (confir) {
               this.$http.delete(apiPedido + '/' + id).then(function(json){
                 this.obtenerProductos();
               }).catch(function(json){
                 console.log(json);
               });
            }
        },
        guardarProducto:function(){

          var pedido = {
            nombrep:this.nombrep,
            color:this.color,
            sabor:this.sabor,
            texto:this.texto,
            fecha:this.fecha,
            hora:this.hora,
            sucursal:this.sucursal,
            telefono:this.telefono,
            preciop:this.preciop,
            skup:this.skup
          };

          this.$http.post(apiPedido,pedido).then(function(json){
            this.obtenerProductos();
            this.nombrep='';
            this.color='';
            this.sabor='';
            this.texto='';
            this.fecha='';
            this.hora='';
            this.sucursal='';
            this.telefono='';
            this.preciop='';
          }).catch(function(json){
            console.log(json);
          });

          $('#modalProductos').modal('hide');
          console.log(pedido);
        },

      },
      //FIN DE METHODS

      computed:{
    

    // filtroProductos:function(){
    //   return this.pedidos.filter((pedido)=>{
    //     return pedido.nombrep.toLowerCase().match(this.buscar.toLowerCase().trim()) 

    //   });
    // },
    filtrofechas:function(){
      return this.pedidos.filter((apiPedido)=>{
        return(
          apiPedido.fecha >= this.buscar2 &&
          apiPedido.fecha <= this.buscar3
          );

      });

    },

    // total:function(){
    //   var t=0;
    //   t= this.cantidadp * this.precioc;
    //   return t;
    // },
  }
})