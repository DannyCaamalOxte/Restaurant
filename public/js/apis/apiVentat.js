function init(){
var ruta = document.querySelector("[name=route]").value;

var apiProd=ruta + '/apiProductot';
var Ventat=ruta + '/apiVentat';

new Vue({


	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },

	el:"#apiVentat",

	data:{
		frase:'HOLA MUNDO DESDE LA UTC',
		alineacion:'center',
		skut:'',
		productot:[],
		ventas:[],		
		cantidades:[1,1,1,1,1,1,1,1,1],
		auxSubTotal:0,
		pagara_con:0,
		folio:'',
		buscar:'',
		productos:[],
		nombret:'',
        preciot:'',
        cantidadt:'',
	},

	
	created:function(){
        this.obtenerProductos();
        this.foliar();
      },
	

	methods:{

		buscarProducto:function(){
			// console.log('HOLA');
			var encontrado=0;
			if (this.skut) {

			}
			var productot={};

			//rutina de busqueda
			for (var i = 0; i < this.ventas.length; i++) {
				if (this.skut===this.ventas[i].skut){
					encontrado=1;
					this.ventas[i].cantidadt++;
					this.cantidades[i]++;
					this.skut='';
					break;
				}
			}

			if(encontrado==0)
			//inicio de get ayax
			this.$http.get(apiProd + '/' + this.skut).then(function(j){
				this.productot=j.data;

				productot={skut: j.data.skut,
						 nombret:j.data.nombret,
						 preciot:j.data.preciot,
						cantidadt:1,
					    total:j.data.preciot,
						foto:'prods/'+ j.data.foto};

				if (this.productot)
					this.ventas.push(productot);
					this.skut="";
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
		this.nombret='';
		this.preciot='';
		this.cantidadt='';
		this.skut='';
		$('#modalProducto').modal('show');
		},

		foliar:function(){
			this.folio="VNTTEK-" + moment().format('YYMMDDhmmss');
		},

		vender:function(){
			var unaVenta={};
			var deta=[];
			//preparamos un json con los detalles
			for (var i = 0; i < this.ventas.length; i++) {
				deta.push(
					{skut:this.ventas[i].skut,
						folio:this.folio,
						cantidadt:this.ventas[i].cantidadt,
						preciot:this.ventas[i].preciot,
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
			this.$http.post(Ventat,unaVenta).then(function(j){
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
				total=this.ventas[id].preciot*this.cantidades[id];

				// Actualizo el total del producto en el array ventas
				this.ventas[id].total=total;
				// Actulizo la cantidad en el array ventas
				this.ventas[id].cantidadt=this.cantidades[id];

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
				acum=acum+this.ventas[i].cantidadt;
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
      return this.productos.filter((productot)=>{
        return productot.nombret.toLowerCase().match(this.buscar.toLowerCase().trim()) 

      });
    },
		


		

		
	}
	// FIN DE COMPUTED



	});
} window.onload= init;
