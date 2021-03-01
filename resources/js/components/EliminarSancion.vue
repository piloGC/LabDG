<template>
  <input
    type="submit"
    value="Eliminar"
    class="btn btn-danger mr-1"
    @click="eliminarSancion"
  />
</template>

<script>
export default {
  props: ["sancionId"],
  methods: {
    eliminarSancion() {
      this.$swal({
        title: "¿Desea eliminar esta sanción?",
        text: "Una vez eliminada no se puede recuperar",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No",
      }).then((result) => {
        if (result.value) {
          const params = {
            id: this.sancionId,
          };

          //enviar la peticion al servidor
          axios
            .post("sanciones/"+this.sancionId, { params, _method: "delete" })
            .then((respuesta) => {
              // console.log(respuesta);
              this.$swal(
                "Sancion eliminada",
                "Se eliminó la sanción",
                "success"
              );

              //eliminar receta del DOM
              this.$el.parentNode.parentNode.parentNode.removeChild(
                this.$el.parentNode.parentNode
              );
              window.location.reload(); 
            })
            .catch((error) => {
              console.log(error);
            });
        }
      });
    },
  },
};
</script>