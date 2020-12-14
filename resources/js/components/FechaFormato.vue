<template>
<h5 class="mt-3">{{formatearFecha}}</h5>
</template>

<script>
    export default {
        props: ['fecha'],
        computed: {
            formatearFecha() {
                return moment(this.fecha).locale('es').format('DD [de] MMMM [del] YYYY')
            }
        }
    }
</script>
