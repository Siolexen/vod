<template>
    <div class="course-list" ref="mainblock">
        <div class="content main-block block-course col-8 col-md-12" ref="mainblock">
            <div class="table-responsive overflow-auto">
                <table class="table bgc-grey-10">
                    <thead>
                    <tr role="row" class="text-center">
                        <th>ID</th>
                        <th>Nazwa</th>
                        <th>Nazwa</th>
                        <th>Opcje</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr v-if="loading">
                        <td class="text-center fs-16" colspan="99">
                            <div class="spinner-border" role="status"></div>
                        </td>
                    </tr>
                    <template v-else-if="courses.length > 0">
                        <tr class="text-center" v-for="course in courses" :key="course.id">
                            <td>
                                {{course.id}}
                            </td>
                            <td>
                                {{course.name}}
                            </td>
                            <td>
                                {{course.name}}
                            </td>
                            <td>
                                <a
                                    :href="getDataUrl + '/' + course.id + '/edit'"
                                    class="btn btn-sm btn-info text-nowrap" type="button"
                                >Edycja</a>
                            </td>
                        </tr>
                    </template>
                    <tr v-else>
                        <td class="text-center fs-16" colspan="99">

                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex-row flex-wrap jc-center aitems-center m-tb-05">
                <pagination
                    :value="pagination.currentPage"
                    :pageCount="pagination.pages"
                    :ajax="true"
                    :page.sync="pagination.currentPage"
                ></pagination>
            </div>



        </div>
    </div>
</template>

<script>

export default {
    name: "admin-courses",
    props: ['setGetDataUrl','setShowUrl', 'setPrestaUrl'],
    data() {
        return {
            courses: [],
            pagination: []
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
            console.log(process.env.MIX_URL);
            console.log(this.getDataUrl)

            axios
                .get(this.getDataUrl)
                .then(response => {
                    console.log(response);
                    this.courses = response.data.courses.data
                    this.pagination = response.data.courses.pagination
                    console.log(response.data.courses.data);
                })
        },
    }
}
</script>

<style scoped>

</style>
