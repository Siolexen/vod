<template>
    <div class="content main-block block-course show-course" ref="mainblock">
        <div class="row align-items-center block-content">
            <div class="col-lg-7">
                <template>
                    <vimeo-player ref="player" :video-id="videoID" @ready="onReady" :player-width="450"></vimeo-player>
                </template>
            </div>
            <div class="col-lg-5">
                <span v-for="(category, key) in course.categories" > {{category.name}} <i v-if=" course.categories.length > key+1">/</i></span>
                <h1 class="font-weight-light">{{course.name}}</h1>
                <img :src="course.image" class="w-100">
<!--                <p>This is a template that is great for small businesses. It doesn't have too much fancy flare to it, but it makes a great use of the standard Bootstrap core components. Feel free to use this template for any project you want!</p>-->
<!--                <a class="btn btn-primary" href="#!">Call to Action!</a>-->
                <p>Prowadzący: <br>
                    {{course.data.teacher ? course.data.teacher : ''}}</p>
                <p  v-for="(feature, key) in course.features" v-if="feature.name == 'Time'">
                    <i class="far fa-clock" aria-hidden="true"></i> {{feature.value}}
                </p>
            </div>

            <div class="col-sm-12">
                <div class="w-100">
                    <div class="box-title color-white-text font-weight-bold">Program kursu</div>
                    <div class="program-list">
<!--                        <div v-for="video in course.videos" :key="video.id">-->
                        <div v-for="(video, key) in course.videos">
                            <div class="lesson">
                                <a href="#" v-on:click="selectVideo(key)" v-bind:class="{ 'active-text': (key == currentVideo.number) }">Lekcja {{ video.lesson }} </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!--            <button  v-on:click="nextVideo">-->
<!--                Next-->
<!--            </button>-->
<!--            <button  v-on:click="previewVideo">-->
<!--                preview-->
<!--            </button>-->
        </div>
<!--                        <div v-for="video in course.videos" :key="video.id">-->
        <div class="course-list" ref="mainblock">
            <div class="content main-block block-course col-8 col-md-12" ref="mainblock">
                <div class="row align-items-center block-content mt-3 p-0" v-for="course_box in userCourse" :key="course_box.course_id" v-if="course_box.course_id != course.id">
                        <div class="miniature-course-image p-0 col-12 col-md-5">
                            <img class="w-100" :src="course_box.course.image">
                        </div>
                        <div class="miniature-course-detail col-12 col-md-7 p-2">
                            <h5 v-for="(category, key) in course_box.course.categories" > {{category.name}} <i v-if=" course_box.course.categories.length > key+1">/</i></h5>
                            <h5>{{course_box.course.data.teacher}}</h5>
                            <h3 class="miniature-course-title">{{course_box.course.name}}</h3>
                            <div class="time-course">
                                <div class="info col-2" v-for="(feature, key) in course_box.course.features" v-if="feature.name == 'Time'">
                                    <i class="far fa-clock"></i> {{feature.value}}
                                </div>
                                <div class="box-title font-weight-bold">
                                    <a class="color-white-text" :href="showUrl+'/'+course_box.course.id">Rozpocznij ></a>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { vueVimeoPlayer } from 'vue-vimeo-player'
export default {
    name: "user-courses-show",
    props: ['setGetDataUrl', 'setShowUrl', 'setGetUserDataUrl', 'setPrestaUrl'],
    data() {
        return {
            course: [],
            userCourse: [],
            currentVideo: {
                number: 0,
                id: null,
                vimeo_id: null
            },
            videoID: '0',
            height: 500,
            options: {
                muted: true,
                autoplay: true,
            },
            player: {
                width: window.innerWidth*0.5
            },
            playerReady: false
        }
    },
    created() {
        this.getDataUrl = this.setGetDataUrl
        this.getUserDataUrl = this.setGetUserDataUrl
        this.prestaUrl = this.setPrestaUrl
        this.showUrl = this.setShowUrl
        this.getCourse();
        this.getUserCourse();
    },
    methods: {
        getCourse() {
            axios
                .get(this.getDataUrl)
                .then(response => {
                    this.course = response.data.course
                    this.currentVideo.id = response.data.course.videos[this.currentVideo.number].id ? response.data.course.videos[this.currentVideo.number].id : ''
                    this.currentVideo.vimeo_id = response.data.course.videos[this.currentVideo.number].vimeo_id
                    this.videoID = response.data.course.videos[this.currentVideo.number].vimeo_id
                    this.player.width = document.getElementsByClassName('main-block')[0].clientWidth * 0.4;
                })
        },
        getUserCourse() {
            axios
                .get(this.getUserDataUrl)
                .then(response => {
                    this.userCourse = response.data.userCourse
                })
        },
        selectVideo(id) {
            this.player.width = document.getElementsByClassName('main-block')[0].clientWidth * 0.4;
            this.currentVideo.id = this.course.videos[id].id
            this.currentVideo.vimeo_id = this.course.videos[id].vimeo_id
            this.currentVideo.number = id
            this.videoID = this.course.videos[id].vimeo_id
            this.onReady();
        },
        nextVideo() {
            if(this.currentVideo.number+1 > this.course.last_video){
                return 0;
            }
            let next = this.currentVideo.number = this.currentVideo.number+1

            this.currentVideo.id = this.course.videos[next].id
            this.currentVideo.vimeo_id = this.course.videos[next].vimeo_id
            this.videoID = this.course.videos[next].vimeo_id
            this.onReady();
        },
        previewVideo() {
            if(this.currentVideo.number-1 < 0){
                return 0;
            }
            let preview = this.currentVideo.number = this.currentVideo.number-1

            this.currentVideo.id = this.course.videos[preview].id
            this.currentVideo.vimeo_id = this.course.videos[preview].vimeo_id
            this.videoID = this.course.videos[preview].vimeo_id
            this.onReady();
        },
        onReady() {
            this.playerReady = true
        },
        play () {
            this.$refs.player.play()
        },
        pause () {
            this.$refs.player.pause()
        }
    }
}
</script>

<style scoped>

</style>
