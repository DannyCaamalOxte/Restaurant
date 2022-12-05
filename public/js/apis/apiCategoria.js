var ruta = document.querySelector("[name=route]").value;

var apiCat = ruta + "/apiCat";

new Vue({
    http: {
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector("#token")
                .getAttribute("value"),
        },
    },

    el: "#apiCategorias",

    data: {
        mensaje: "Categorias",
        categoriasCargadas: [],
        nombre_categoria: "",
        precio: 0,
        comentario: "",
        agregar: true,
        id_categoria: "",
        nombrePlato: "",
        vista: 0,
    },
    created: function () {
        this.obtenerCategorias();
    },
    methods: {
        obtenerCategorias: function () {
            this.$http.get(apiCat).then(function (j) {
                this.categoriasCargadas = j.data;
                console.log(this.categoriasCargadas);
            });
        },
        mostrarModal: function () {
            this.agregar = true;
            this.limpiarModal();
            $("#modalCategorias").modal("show");
        },
        guardarCategoria: function () {
            if (
                this.nombre_categoria.length === 0 ||
                /^\s+$/.test(this.nombre_categoria)
            ) {
                Swal.fire({
                    position: "center",
                    icon: "warning",
                    title: "Ingresa el nombre de la categoria",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                //construir el objeto
                var categoria = { categoria: this.nombre_categoria };
                // console.log(categoria);
                this.$http
                    .post(apiCat, categoria)
                    .then(function (j) {
                        $("#modalCategorias").modal("hide");
                        //console.log('exito');
                        this.obtenerCategorias();
                        //limpiamos el valor de categoria en el data
                        this.limpiarModal();
                    })
                    .catch(function (j) {
                        //console.log(j);
                    });

                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Se agregó una nueva categoria",
                    showConfirmButton: false,
                    timer: 1500,
                });
            }
        },
        limpiarModal: function () {
            this.nombre_categoria = "";
        },
        editarCategoria: function (id) {
            this.agregar = false;
            this.id_categoria = id;
            //console.log(this.id_plato);
            this.$http.get(apiCat + "/" + id).then(function (j) {
                //console.log(j);
                this.nombre_categoria = j.data.categoria;
            });
            $("#modalCategorias").modal("show");
        },
        actualizarCategoria: function () {
            if (
                this.nombre_categoria.length === 0 ||
                /^\s+$/.test(this.nombre_categoria)
            ) {
                Swal.fire({
                    position: "center",
                    icon: "warning",
                    title: "No puedes dejar vacio el nombre",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                var cambiosCat = { categoria: this.nombre_categoria };
                //console.log(cambiosProducto);
                //console.log(this.categoriasCargadas);
                this.$http
                    .patch(apiCat + "/" + this.id_categoria, cambiosCat)
                    .then(function (j) {
                        this.obtenerCategorias();
                    });
                $("#modalCategorias").modal("hide");
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Actualizado",
                    showConfirmButton: false,
                    timer: 1500,
                });
            }
        },
        eliminarPlato(id) {
            Swal.fire({
                title: "Esta seguro de eliminar?",
                text: "No podras revertir el cambio luego de confirmar!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminar!",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$http
                        .delete(apiCat + "/" + id)
                        .then(function (j) {
                            //el get especies sirve para mostrar la tabla actualizada
                            this.obtenerCategorias();
                        })
                        .catch(function (j) {
                            console.log(j);
                        });
                    Swal.fire("Eliminado!", "Categoria eliminada :(", "Listo");    
                }
            });
        },
        cambiarVista1(){

        }
    },
    computed: {
        filtro() {
            return this.platosCargados.filter((pro) => {
                return pro.nombre
                    .toLowerCase()
                    .match(this.nombrePlato.toLowerCase().trim());
            });
        },
    },
});
