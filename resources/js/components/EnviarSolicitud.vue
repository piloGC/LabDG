<template>
  <input type="submit"  
        class="btn btn-primary" 
        value="Enviar solicitud" 
        @click="enviarSolicitud"/>
</template>



<script>
export default {
  props: ["solicitud"],
  methods: {
    enviarSolicitud() {
        this.$swal('Good job!','You clicked the button!','success')

          //enviar la peticion al servidor
          axios
            .post(`/prestamos`, { params, _method: "post" })
            .catch((error) => {
              console.log(error);
            });
        
  },
  },
};
</script>