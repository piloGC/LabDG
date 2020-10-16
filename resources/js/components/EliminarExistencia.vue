<template>
  <input
    type="submit"
    class="btn btn-danger mb-2"
    value="Eliminar"
    @click="eliminarExistencia"
  />
</template>

<script>
export default {
  props: ["existenciaId"],
  methods: {
    eliminarExistencia() {
      this.$swal({
        title: "¿Desea eliminar esta existencia?",
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
            id: this.existenciaId,
          };

          //enviar la peticion al servidor
          axios
            .post(`/existencias/${this.existenciaId}`, { params, _method: "delete" })
            .then((respuesta) => {
              // console.log(respuesta);
              this.$swal("Existencia eliminada", "Se eliminó la existencia", "success");

              //eliminar receta del DOM
              this.$el.parentNode.parentNode.parentNode.removeChild(
                this.$el.parentNode.parentNode
              );
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