function init(){
var ruta = document.querySelector("[name=route]").value;

var Ventashechas=ruta + '/apiVentat';

new Vue({


	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },

	el:"#apiVentashechas",

	data:{
		alineacion:'center',
		ventas:[],
		fecha_venta:'',
		num_articulos:'',
		subtotal:'',
		iva:'',
		total:'',	
		folio:'',
		buscar:'',
		buscar2:'',
		buscar3:'',
		auxSubTotal:0,
	},

	
	created:function(){
        this.obtenerVentas();
      },
	

	methods:{


		obtenerVentas:function(){
          this.$http.get(Ventashechas).then(function(json){
            this.ventas=json.data;
            console.log(json.data)
          }).catch(function(json){
            console.log(json);
          });
        },
        
	},
	// FIN DE METHODS


	// INICIO COMPUTED
	computed:{
		
		// filtroventas:function(){
  //     return this.ventas.filter((apiVentashechas)=>{
  //       return apiVentashechas.folio.toLowerCase().match(this.buscar.toLowerCase().trim())

  //     });
  //   },



    filtrofechas:function(){
    	return this.ventas.filter((apiVentashechas)=>{
    		return(
    			apiVentashechas.fecha_venta >= this.buscar2 &&
    			apiVentashechas.fecha_venta <= this.buscar3
    			);

    	});

    },
    //calcula el total de ventas hechas, calculando por medio del filtrofechas
		totalNeto:function(){
			return this.filtrofechas.reduce((total, item)=>{
				return total + parseFloat(item.total);
			}, 0);
		},

		


		

		
	}
	// FIN DE COMPUTED



	});
} window.onload= init;
