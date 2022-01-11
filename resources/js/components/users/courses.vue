<template>
    <div class="course-list" ref="mainblock">
        <div class="content main-block block-course col-8 col-md-12" ref="mainblock">
            <div class="row align-items-center block-content mt-3 p-0" v-for="course in courses" :key="course.id" >

                <div class="miniature-course-image p-0 col-12 col-md-5">
                    <img class="w-100" :src="course.course.image">

                </div>
                <div class="miniature-course-detail col-12 col-md-7 p-2">
                    <h5 v-for="(category, key) in course.course.categories" > {{category.name}} <i v-if=" course.course.categories.length > key+1">/</i></h5>

                    <h5>{{course.course.data.teacher}}</h5>
                    <h3 class="miniature-course-title">{{course.course.name}}</h3>
                    <div class="time-course">
                        <div class="info col-12" v-for="(feature, key) in course.course.features" v-if="feature.name == 'Time'">
                            <i class="far fa-clock"></i> {{feature.value}}
                        </div>
                        <div class="info col-12" v-for="(feature, key) in course.course.features" v-if="feature.name == 'Time'">
                            Dostęp ważny do: {{course.end}}
                        </div>
                        <div class="col-12 col-md-12">
                            <div class="box-title font-weight-bold">
                                <a class="color-white-text" :href="showUrl+'/'+course.course.id">Rozpocznij ></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "user-courses",
    props: ['setGetDataUrl','setShowUrl', 'setPrestaUrl'],
    data() {
        return {
            courses: []
        }
    },
    created() {
        this.getDataUrl = this.setGetDataUrl
        this.showUrl = this.setShowUrl
        this.prestaUrl = this.setPrestaUrl

        this.getUsersCourse();
    },
    methods: {
        getUsersCourse() {
            axios
                .get(this.getDataUrl)
                .then(response => {
                    this.courses = response.data.userCourse
                })
        },
    }
}
</script>

<style scoped>

</style>
