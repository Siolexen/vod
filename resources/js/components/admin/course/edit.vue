<template>
    <div class="course-list" ref="mainblock">
        <div class="content main-block block-course col-8 col-md-12" ref="mainblock">
            <div class="table-responsive overflow-auto">
                <div class="card">
                    <div class="card-title">
                        <h4 class="d-inline-block">Edycja</h4>
                        <button class="btn btn-info btn-sm float-right" @click="showModal = true">
                            <i class="fa fa-question-circle"></i>
                        </button>
                    </div>

                    <div class="card-body">
                        <form @submit.prevent="store">
                            <div class="row">
                                <div class="col-lg-8">
                                    <label>Nazwa</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="course.name"
                                    >
                                </div>
                                <!-- selected_type -->
                                <div class="col-lg-3">
                                    <label>Status</label>
                                    <select
                                        class="form-control"
                                        v-model="course.status"
                                    >
                                        <option value="active">Aktywny</option>
                                        <option value="inactive">Nieaktywny</option>


                                    </select>
                                </div>
                                <div class="col-lg-12">
                                    <label>Opis</label>
                                    <textarea class="form-control" id="description" v-model="course.description"></textarea>
                                </div>
                            </div>

                            <div class="row py-20">
                                <div class="col">
                                    <button
                                        class="btn btn-success btn-sm"
                                        type="submit"
                                    >
                                        <i class="fa fa-check"></i>
                                      Zapisz
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "admin-courses-edit",
    props: ['setGetDataUrl','setShowUrl', 'setPrestaUrl', 'setUrlUpdate'],
    data() {
        return {
            course: [],
        }
    },
    created() {
        this.getDataUrl = this.setGetDataUrl
        this.urlUpdate = this.setUrlUpdate
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
                    this.course = response.data.course
                    console.log(response.data.courses.data);
                })
        },
        store() {



                let data = {
                    name: this.courses.name,
                }

                axios
                    .put(this.urlUpdate, data)
                    .then(response => {
                        this.$swal(this.locale['Success'], response.data.message, 'success').then(function() {
                            location.href = response.data.redirect_url
                        });
                    })
                    .catch(error => {
                        if(error.response.status === 422 && typeof error.response.data === 'object') {
                            let message = '';

                            Object.keys(error.response.data).forEach(valid_error => {
                                message += error.response.data[valid_error].join('\n') + '\n';
                            })

                            this.$swal(this.locale['Error'], message, 'error');
                        }

                        this.$swal(this.locale['Error'], this.locale['Something went wrong'], 'error');
                    })

        },
    }
}
</script>

<style scoped>

</style>
