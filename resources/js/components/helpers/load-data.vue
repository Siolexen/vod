<template>
    <transition name="fade">
        <div class="w-100 m-0 p-0">
            <div class="card m-0" v-if="status===true">
                <div class="card-title">
                    <div class="flex j-c-center w-100">
                        <i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
                        <span class="sr-only">Load...</span>
                    </div>
                </div>
            </div>

            <div class="card m-0" v-else-if="status==null">
                <div class="card-title">
                    <div class="flex j-c-center w-100">
                        <h3 class="alert alert-danger flex-column aitems-center">
                            {{ message }}
                            <a :href="window_location_href">{{ linkText }}</a>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        name: "load-data",
        props:['status', 'message', 'linkText'],
        data() {
            return {
                window_location_href: window.location.href,
            }
        },
        methods:{

        }
    }
</script>

<style scoped>

</style>
