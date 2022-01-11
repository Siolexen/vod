<template>
    <transition name="fade">
            <date-picker v-model="range"
                         lang="en"
                         :range="true"
                         :format="setFormat"
                         :shortcuts="shortcuts"
                         confirm/>
    </transition>
</template>

<script>
    import DatePicker from 'vue2-datepicker';
    //import 'vue2-datepicker/index.css';
    export default {
        comments: { DatePicker },
        name: "load-data",
        props: {
            setLocale: String,
            setFormat: {
                type: String,
                default: "YYYY-MM-DD"
            },

            startDate: {
                type: String,
                default: new Date()
            },

            endDate: {
                type: String,
                default: new Date()
            },
        },
        data() {
            return {
                range:[new Date(this.startDate), new Date(this.endDate)],
                shortcuts: [
                    {
                        text: 'Today',
                        onClick: () => {
                            this.range = [new Date(), new Date()];
                        }
                    }
                ]
            }
        },
        created(){
            this.locale = JSON.parse(this.setLocale);
        },
        methods:{
        }
    }
</script>

<style >
    .mx-input-append{
        height: auto!important;
    }
</style>
