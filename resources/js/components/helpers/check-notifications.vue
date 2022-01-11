<template>
    <div>
        <div class="dropdown media-dropdown">
            <a href=""
               class="header-btn alert-active"
               data-toggle="dropdown"
               aria-expanded="false"
               v-if="new_users.length > 0 || new_shops.length > 0 || new_firms.length > 0">
                <i class="fa fa-bell-o" aria-hidden="true">
                <span class="alert-dot">
                    <span class="badge badge-dot badge-sm badge-primary"></span>
                </span>
                </i>
            </a>
            <div class="dropdown-menu dropdown-menu-right"
                 x-placement="bottom-end"
                 style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-300px, 24px, 0px); margin-top: -5px">
                <div class="media-wrapper h-max-400px overflow-auto">
                    <!-- new users -->
                    <div class="media-item p-05" v-if="new_users.length > 0">
                        <div class="item-content lheight-12 flex-column">
                            <h5>
                                <i class="fa fa-users color-green" aria-hidden="true"></i>
                                <strong>{{ locale['New users'] }}</strong>
                            </h5>
                            <a :href="'/workers/users/' + user.id"
                               class="mfs-09 m-b-05"
                               v-for="(user, index) in new_users">
                                {{ '- ' + user.name }}
                            </a>
                        </div>
                    </div>

                    <!-- new shops -->
                    <div class="media-item p-05" v-if="new_shops.length > 0">
                        <div class="item-content lheight-12 flex-column">
                            <h5>
                                <i class="fa fa-cart-plus color-red" aria-hidden="true"></i>
                                <strong>{{ locale['New shops'] }}</strong>
                            </h5>
                            <a :href="'/workers/shops/' + shop.id"
                               class="mfs-09 m-b-05"
                               v-for="(shop, index) in new_shops">
                                {{ '- ' + shop.name }}
                            </a>
                        </div>
                    </div>

                    <!-- new firms -->
                    <div class="media-item p-05" v-if="new_firms.length > 0">
                        <div class="item-content lheight-12 flex-column">
                            <h5>
                                <i class="fa fa-file-text color-blue" aria-hidden="true"></i>
                                <strong>{{ locale['New firms'] }}</strong>
                            </h5>
                            <a :href="'/workers/firms/' + firm.id"
                               class="mfs-09 m-b-05"
                               v-for="(firm, index) in new_firms">
                                {{ '- ' + firm.name }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "check-notifications",
        props:['setLocale', 'urlToAction'],
        components: {
        },
        data() {
            return {
                token: '?_token=' + $('meta[name="csrf-token"]').attr('content'),

                action_url: this.urlToAction,
                new_notifications: [],

                new_users: [],
                new_shops: [],
                new_firms: [],
            }
        },
        created() {
            this.locale = JSON.parse(this.setLocale);
        },
        mounted(){
            //setInterval(this.checkNotifications, 5000);
        },
        methods:{
            checkNotifications(){
                let _this = this;
                axios.post(this.action_url + this.token)
                    .then((response) => {
                        if(response && response.data['data']) {
                            let data = response.data['data'];
                            _this.new_users = data.new_users;
                            _this.new_shops = data.new_shops;
                            _this.new_firms = data.new_firms;
                        }
                        /*if(_this.new_user_tasks.length>0){
                            _this.alert('success', _this.locale['New task'])
                        }
                        if(_this.new_user_cases.length>0){
                            _this.alert('success', _this.locale['New case'])
                        }*/
                        //console.log(_this.new_user_tasks);
                    })
                    .catch((error) => {
                        _this.new_users = [];
                        _this.new_shops = [];
                        _this.new_firms = [];
                        //console.log(error);
                    });
            },
            alert(type, message){
                if(type === 'error'){
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        timeOut: 4000
                    };
                    toastr.error(message, 'Error!');

                } else if(type === 'success'){
                    toastr.options = {
                        closeButton: false,
                        progressBar: true,
                        showMethod: 'slideDown',
                        timeOut: 4000
                    };
                    toastr.success(message, 'Success!');

                } else if(type === 'info'){
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        timeOut: 4000
                    };
                    toastr.info(message, 'Info!');

                } else if(type === 'warning'){
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        timeOut: 4000
                    };
                    toastr.warning(message, 'Warning!');
                }
            }
        }
    }
</script>

<style scoped>

</style>
