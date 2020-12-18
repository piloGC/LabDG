<template>
  <div class="row">
    <div class="form-group col-md-4 mt-3" >
      <label>Categoría:</label>
      <select class="form-control" v-model="categoria"  @change="getEquipos()"  >
        <option value="0">-- Selecciona una opción --</option>
        <option v-for="data in categorias" :key="data.id" :value="data.id" >
          {{ data.nombre }}
        </option>
      </select>
      
        <!-- <div class="error" v-if="!categoria"><strong>El campo categoria es obligatorio.</strong></div>   -->
    </div>
    <div class="form-group col-md-4 mt-3">
      <label>Equipo:</label>
      <select class="form-control" v-model="equipo" @change="getExistencias()" required>
        <option value="0">-- Selecciona una opción --</option>
        <option v-for="data in equipos" :key="data.id" :value="data.id" >
          {{data.nombre}}
        </option>
      </select>
      
    <div class="error" v-if="!equipo">Primero debes seleccionar una categoria.</div>  
    </div>
    <div class="form-group col-md-4 mt-3">
      <label for="existencia">Número de equipo:</label>
      <select
        name="existencia"
        id="existencia"
        class="form-control"
        v-model="existencia" 
        :old="existencias"
      >
        <option value="0">-- Selecciona una opción --</option>
        <option v-for="data in existencias" :key="data.id" :value="data.id">
          {{ data.codigo }}
        </option>
      </select>
      
        <div v-for="data in equipos" style="clear: both;">
          <div v-if="(data.imagen != '[none]')">
            <img v-bind:src="'/storage/' + data.imagen">
          </div>
        </div>
      <div class="error" role="error" v-if="!existencia">Primero debes seleccionar un equipo.</div>  
    </div>
  </div>
</template>

<script>
import {required} from 'vuelidate/lib/validators'
export default {
  data() {
    return {
      categoria: 0,
      categorias: [],
      equipo: 0,
      equipos: [],
      existencia: 0,
      existencias: [],
    };
  },
  props: ["rutaCat","rutaEquipo","rutaExistencia"],
  methods: {
    getCategorias: function () {
      axios.get(this.rutaCat).then(
        function (response) {
          this.categorias = response.data;
        }.bind(this)
      );
    },
    getEquipos: function () {
      axios
        .get(this.rutaEquipo, {
          params: {
            categoria_id: this.categoria,
          },
        })
        .then(
          function (response) {
            this.equipos = response.data;
          }.bind(this)
        );
    },
    getExistencias: function () {
      axios
        .get(this.rutaExistencia, {
          params: {
            equipo_id: this.equipo,
          },
        })
        .then(
          function (response) {
            this.existencias = response.data;
          }.bind(this)
        );
    },
    
  },
   validations: {
     categoria: {
       data: {
           id:{
             required
           }
       } 
     },
     equipo: {
       data: {
           id:{
             required
           }
       } 
     },
     existencia: {
       data: {
           id:{
             required
           }
       } 
     }
   },
  created: function () {
    this.getCategorias(), this.getExistencias();
  },
};
</script>