<template>
    <div >
                        <div class="form-group">
                            <label>Categoría:</label>
                            <select class='form-control' v-model='categoria' @change='getEquipos()' >
                                <option value="" >-- Selecciona una opción --</option>
                                <option v-for='data in categorias' :key='data.id'> {{data.id}} {{data.nombre}} </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Equipo:</label>
                            <select class='form-control' v-model='equipo' @change='getExistencias()'>
                                <option value="" >-- Selecciona una opción --</option>
                                <option v-for='data in equipos' :key='data.id'>{{data.id}} {{ data.nombre }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="existencia">Número de equipo:</label>
                            <select name="existencia" id="existencia"
                                 class="form-control " 
                                  v-model='existencia' >
                                <option value='' >-- Selecciona una opción --</option>
                                <option v-for='data in existencias' :key='data.id' >{{data.id}} </option>
                            </select>
                        </div>
                        
                </div>
                    
</template>
<script>
    export default {
        data(){
            return {
                categoria: 0,
                categorias: [],
                equipo: 0,
                equipos: [],
                existencia: 0,
                existencias: []
            }
        },
        methods:{
            getCategorias: function(){
                axios.get('/getCategorias')
                    .then(function (response) {
                        this.categorias = response.data;
                    }.bind(this));
            },
            getEquipos: function() {
                axios.get('/getEquipos',{
                    params: {
                        categoria_id: this.categoria
                    }
                }).then(function(response){
                    this.equipos = response.data;
                }.bind(this));
            },
            getExistencias: function() {
                axios.get('/getExistencias',{
                    params: {
                        equipo_id: this.equipo
                    }
                }).then(function(response){
                    this.existencias = response.data;
                }.bind(this));
            }
        },
        created: function(){
            this.getCategorias(),
            this.getExistencias()
        }
    }
</script>