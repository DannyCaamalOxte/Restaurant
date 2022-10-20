function init(){
var ruta = document.querySelector("[name=route]").value;

var apiProd=ruta + '/apiProductoc';
var Ventac=ruta + '/apiVentac';

new Vue({


	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },

	el:"#apiVentac",

	data:{
		frase:'HOLA MUNDO DESDE LA UTC',
		alineacion:'center',
		skuc:'',
		productoc:[],
		ventas:[],		
		cantidades:[1,1,1,1,1,1,1,1,1],
		auxSubTotal:0,
		pagara_con:0,
		folio:'',
		buscar:'',
		productos:[],
		nombrec:'',
        precioc:'',
        cantidadc:'',
	},

	
	created:function(){
        this.obtenerProductos();
        this.foliar();
      },
	

	methods:{

		buscarProducto:function(){
			// console.log('HOLA');
			var encontrado=0;
			if (this.skuc) {

			}
			var productoc={};

			//rutina de busqueda
			for (var i = 0; i < this.ventas.length; i++) {
				if (this.skuc===this.ventas[i].skuc){
					encontrado=1;
					this.ventas[i].cantidadc++;
					this.cantidades[i]++;
					this.skuc='';
					break;
				}
			}

			if(encontrado==0)
			//inicio de get ayax
			this.$http.get(apiProd + '/' + this.skuc).then(function(j){
				this.productoc=j.data;

				productoc={skuc: j.data.skuc,
						 nombrec:j.data.nombrec,
						 precioc:j.data.precioc,
						cantidadc:1,
					    total:j.data.precioc,
						foto:'prods/'+ j.data.foto};

				if (this.productoc)
					this.ventas.push(productoc);
					this.skuc="";
			})
			//fin de ayax
		},
		//fin mostrar producto

		mostrarCobro:function(){
			$('#modalCobro').modal('show');

		},
		//fin mostrarCobro

		eliminarProducto:function(id){
			this.ventas.splice(id,1);
		},

		mostrarModal:function(){
		this.agregando=true;
		this.nombrec='';
		this.precioc='';
		this.cantidadc='';
		this.skuc='';
		$('#modalProducto').modal('show');
		},

		foliar:function(){
			this.folio="VNTCIT-" + moment().format('YYMMDDhmmss');
		},

		vender:function(){
			var unaVenta={};
			var deta=[];
			//preparamos un json con los detalles
			for (var i = 0; i < this.ventas.length; i++) {
				deta.push(
					{skuc:this.ventas[i].skuc,
						folio:this.folio,
						cantidadc:this.ventas[i].cantidadc,
						precioc:this.ventas[i].precioc,
						total:this.ventas[i].total
					}				
				);
			}
			//fin de json detalles
			unaVenta={
				folio:this.folio,
				fecha_venta:moment().format('YYYY-MM-DD'),
				num_articulos:this.noArticulos,
				subtotal:this.subTotal,
				iva:this.iva,
				total:this.granTotal,
				detalles:deta,
			};
			//console.log(unaVenta);
			this.$http.post(Ventac,unaVenta).then(function(j){
				console.log(j);
				$('#modalCobro').modal('hide');
				this.foliar();
				this.ventas=[];
				this.cantidades=[1,1,1,1,1,1,1,1,1];
			});

		},

		mostrarBusqueda:function(){
			$('#modalBusqueda').modal('show');

		},
		obtenerProductos:function(){
          this.$http.get(apiProd).then(function(json){
            this.productos=json.data;
            console.log(json.data)
          }).catch(function(json){
            console.log(json);
          });
        },
	},
	// FIN DE METHODS


	// INICIO COMPUTED
	computed:{
		totalProducto(){
			return (id)=>{
				 var total =0;
				total=this.ventas[id].precioc*this.cantidades[id];

				// Actualizo el total del producto en el array ventas
				this.ventas[id].total=total;
				// Actulizo la cantidad en el array ventas
				this.ventas[id].cantidadc=this.cantidades[id];

				return total.toFixed(1);
				
			}


		},
		// Fin de TotalProducto

		subTotal(){
			
			 var total=0;
			 var valor=0
			 			
			for (var i = this.ventas.length - 1; i >= 0; i--) {
				total=total+this.ventas[i].total;

			}
			// Mando una copia del subTotal a la seccion del data
			//  para el uso de otros calculos
			this.auxSubTotal=total.toFixed(1);		 
			 return total.toFixed(1);
			},
		
		iva(){
			var auxIva=0;
			auxIva = this.auxSubTotal*0.16;
			return auxIva.toFixed(1);
		},

		granTotal(){
			var auxTotal=0;
			auxTotal=this.auxSubTotal*1;
			return auxTotal.toFixed(1);
		},

		noArticulos(){
			var acum=0;
			for (var i = this.ventas.length - 1; i >= 0; i--) {
				acum=acum+this.ventas[i].cantidadc;
			}
			return acum;
		},

		cambio(){
			var camb=0;
			var camb=this.pagara_con - this.granTotal;
			camb=camb.toFixed(1);
			return camb;
		},
		filtroProductos:function(){
      return this.productos.filter((productoc)=>{
        return productoc.nombrec.toLowerCase().match(this.buscar.toLowerCase().trim()) 

      });
    },
		


		

		
	}
	// FIN DE COMPUTED



	});
} window.onload= init;
