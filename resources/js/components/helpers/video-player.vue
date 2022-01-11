<template>
        <Media :kind="'video'"
               :controls="true"
               :src="[dataSrc]"
               ></Media>
</template>

<script>
    import Media from '@dongido/vue-viaudio'
    export default {
        props:['dataSrc'],
        data () {
            return {
                src: 'https://www.w3schools.com/html/mov_bbb.mp4',
                show: false,
            }
        },
        watch: {
            dataStatus: function () {
            }
        },
        created() {
        },
        components: {
            Media
        }
    }
</script>

<style scoped>

</style>
