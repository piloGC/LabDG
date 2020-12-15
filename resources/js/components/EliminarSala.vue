<template>
  <input
    type="submit"
    class="btn btn-danger mb-2"
    value="Eliminar"
    @click="eliminarSala"
  />
</template>

<script>
export default {
  props: ["salaId"],
  methods: {
    eliminarSala() {
      this.$swal({
        title: "¿Desea eliminar esta sala ?",
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
            .post(`/salas/${this.salaId}`, { params, _method: "delete" })
            .then((respuesta) => {
              // console.log(respuesta);
              this.$swal("Sala eliminada", "Se eliminó la sala asignada", "success");

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