<template>
  <input
    type="submit"
    class="btn btn-danger mb-2"
    value="Eliminar"
    @click="eliminarEquipo"
  />
</template>

<script>
export default {
  props: ["equipoId"],
  methods: {
    eliminarEquipo() {
      this.$swal({
        title: "¿Desea eliminar esta equipo?",
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
            id: this.equipoId,
          };

          //enviar la peticion al servidor
          axios
            .post(`/equipos/${this.equipoId}`, { params, _method: "delete" })
            .then((respuesta) => {
              // console.log(respuesta);
              this.$swal("Equipo eliminada", "Se eliminó el equipo", "success");

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