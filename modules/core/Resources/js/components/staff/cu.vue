<template>

    <div>

        <div class="card mb-3">
            <div class="card-header border-bottom">
                <div class="row flex-between-end">
                    <div class="col-auto align-self-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">
                                <router-link to="/staff">کارکنان</router-link>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span v-if="!editMode">ساخت کارمند جدید</span>
                                <span v-else>ویرایش اطلاعات</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-auto ms-auto d-none d-lg-block">
                        <button v-show="!standBy" type="submit" form="mainForm" class="btn btn-success mb-1 ">
                            <span class="fas fa-check align-middle"></span>
                            <span>ثبت اطلاعات</span>
                        </button>
                        <div v-show="standBy">
                            <div style="width: 20px;height: 20px" class="spinner-border text-light" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <span>{{ trans('app.waiting') }}</span></div>
                    </div>
                </div>
            </div>
            <div class="card-body bg-light">
                <div v-if="isLoading" class="spinner-border d-block text-primary mx-auto m-3" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>

                <transition name="slide-fade">
                    <div style="overflow: hidden" v-show="!isLoading">
                        <form id="mainForm" @submit.prevent="editMode ? updateUser() : createUser()" class="container">


                            <div class="row">
                                <div class="col-lg-8">
                                        <div class="mb-2 col">
                                            <label for="full_name" class="form-label">نام و نام خانوادگی</label>
                                            <input class="form-control col" type="text" id="full_name" v-model="form.full_name"
                                                   :class="{ 'is-invalid': form.errors.has('full_name') }" required/>
                                            <has-error :form="form" field="full_name"></has-error>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-lg-4">
                                                <label class="form-label" for="role">{{ trans('app.role') }} </label>
                                                <select id="role" v-model="form.role_id"
                                                        :class="{ 'is-invalid': form.errors.has('role_id') }" class="form-select"
                                                        name="role_id" aria-label="Default select example" required>
                                                    <option class="fs--1" v-for="(role,index) in roles" :value="role.id">
                                                        <span class="fs--1">{{ role.fa_name }}</span>
                                                    </option>
                                                </select>
                                                <has-error :form="form" field="role_id"></has-error>
                                            </div>
                                            <div class="mb-2 col-lg-4">
                                                <label class="form-label" for="role">{{ trans('app.gender') }} </label>
                                                <select id="gender" v-model="form.gender"
                                                        :class="{ 'is-invalid': form.errors.has('gender') }" class="form-select"
                                                        name="gender" aria-label="Default select example" required>
                                                    <option class="fs--1" value="male">{{trans('app.male')}}</option>
                                                    <option class="fs--1" value="female">{{trans('app.female')}}</option>
                                                </select>
                                                <has-error :form="form" field="gender"></has-error>
                                            </div>
                                            <div class="mb-2 col-lg-4">
                                                <label for="username" class="form-label">نام کاربری</label>
                                                <input required class="form-control ltr" type="text" id="username" v-model="form.username"
                                                       :class="{ 'is-invalid': form.errors.has('username') }"/>
                                                <has-error :form="form" field="username"></has-error>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="mb-2 col-lg-6">
                                                <label for="email" class="form-label">ایمیل</label>
                                                <input required class="form-control ltr" type="email" id="email" v-model="form.email"
                                                       :class="{ 'is-invalid': form.errors.has('email') }"/>
                                                <has-error :form="form" field="email"></has-error>
                                            </div>
                                            <div class="mb-2 col-lg-6">
                                                <label for="mobile" class="form-label">موبایل</label>
                                                <input required class="form-control ltr" type="number" id="mobile" v-model="form.mobile"
                                                       :class="{ 'is-invalid': form.errors.has('mobile') }"/>
                                                <has-error :form="form" field="mobile"></has-error>
                                            </div>
                                        </div>

                                    <div v-if="!editMode" class="row mt-3">
                                        <div class="mb-2 col-lg-6">
                                            <label class="form-label" for="password">{{ trans('app.password') }}</label>
                                            <input :required="!editMode" class="form-control " autocomplete="new-password" id="password" type="password"
                                                   name="password" v-model="form.password"
                                                   :class="{ 'is-invalid': form.errors.has('password') }"/>
                                            <has-error :form="form" field="password"></has-error>
                                        </div>

                                        <div class="mb-2 col-lg-6">
                                            <label class="form-label"
                                                   for="confirm_password">{{ trans('app.repeat_password') }}</label>
                                            <input :required="!editMode" :disabled="!form.password" class="form-control dirltr text-left"
                                                   autocomplete="new-password" id="confirm_password" type="password"
                                                   name="password_confirmation" v-model="form.password_confirmation"
                                                   :class="{ 'is-invalid': form.errors.has('password_confirmation') }"/>
                                            <has-error :form="form" field="password_confirmation"></has-error>
                                        </div>

                                        <p v-if="editMode" class="fs--2 mb-0">{{ trans('app.password_edit_empty_message') }}</p>
                                        <span class="fw-light fs--2 mt-1">
                                                <span>{{ trans('app.password_requirement_raw') }}</span>
                                                <ul>
                                                    <li>{{ trans('app.password_have_character_raw') }}</li>
                                                    <li>{{ trans('app.password_have_number_raw') }}</li>
                                                    <li>{{ trans('app.password_length_raw') }}</li>
                                                </ul>
                                            </span>

                                    </div>
                                </div>
                                <div class="col-lg-4">

                                    <input type="file" class="form-control-file d-none" id="input_image">

                                    <div @click="toggleShow" id="btn_select_image"
                                         class="btn w-75  btn-sm btn-outline-primary"><span class="fas fa-camera mx-2">

                        </span>{{ trans('app.select_profile') }}
                                    </div>

                                    <div style="direction: ltr!important;">
                                        <my-upload field="img"
                                                   @crop-success="cropSuccess"
                                                   @crop-upload-success="cropUploadSuccess"
                                                   @crop-upload-fail="cropUploadFail"
                                                   @srcFileSet="srcFileSet"
                                                   :langType=site_lang.substring(0,2)
                                                   :maxSize="250"
                                                   v-model="show"
                                                   :width="300"
                                                   :height="400"
                                                   :noCircle="false"
                                                   :direction=site_direction
                                                   description=""></my-upload>
                                    </div>

                                    <div class="py-2 w-75" id="div_image_view_input " v-show="form.profile_image"
                                         style="display: none;">
                                        <img :src="form.profile_image" id="main_preview"
                                             class=" w-100 image_profile border rounded shadow-sm">
                                        <span v-show="!editMode" style="cursor: pointer "
                                              class="btn btn-sm btn-outline-secondary w-100 mt-2"
                                              v-on:click="cleanProfile">{{ trans('app.clean') }}</span>
                                    </div>

                                    <div v-if="editMode && hasAvatar">
                                        <div @click="deleteProfile" id="btn_remove_image" class="btn btn-danger">
                                        <span
                                            class="fas fa-trash mx-2"></span>{{ trans('app.delete_profile') }}
                                        </div>
                                        <p class="fs--1 mt-2">{{ trans('app.delete_image_warning') }}</p>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="exampleFormControlTextarea1">{{trans('app.des')}}</label>  <span class="text-badge">({{trans('app.optional')}})</span>
                                        <textarea v-model="form.note" class="form-control fs--1" id="exampleFormControlTextarea1" rows="5"></textarea>
                                    </div>

                                </div>
                            </div>

                        </form>
                        <div class="container" v-if="editMode">
                            <hr>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label class="form-label">دسترسی ها</label>
                                    <ul class="list-group">
                                        <li @click="openBottomSheet(index)" v-for="(permission_parent,index) in  form.permissions_for_edit"
                                            class="btn btn-falcon-default list-group-item d-flex justify-content-between align-items-center  mb-2 ">
                                            {{ permission_parent.name }}
                                            <div class="d-flex flex-row px-1">
                                                <span class="badge badge-soft-success rounded-pill mx-2">{{countOfSelectedPermissionOfPermissionParent(index)}}</span>
                                                <span class="badge badge-soft-secondary rounded-pill">{{permission_parent.children.length}}</span>
                                            </div>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </transition>

            </div>

            <div class="card-footer text-center align-center d-lg-none border-top">
                    <button v-show="!standBy" type="submit" form="mainForm" class="btn btn-success mb-1 ">
                        <span class="fas fa-check align-middle"></span>
                        <span>ثبت اطلاعات</span>
                    </button>
                    <div v-show="standBy">
                        <div style="width: 20px;height: 20px" class="spinner-border text-light" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <span>{{ trans('app.waiting') }}</span></div>
            </div>
        </div>
        <vue-bottom-sheet
            max-width="1000px"
            max-height="90%"
            overlay="overlay"
            :click-to-close="true"
            rounded="rounded"
            :swipeAble="true"
            overlayColor="#0000009C"
            :is-full-screen="true"
            :backgroundScrollable="true"
            ref="PermissionBottomSheet">
            <div class="container-fluid">
                <div class="px-4 mx-2">
                    <h3>{{titleSelectedPermission}}</h3>
                    <p>لطفا برای این نقش دسترسی هایی که نیاز دارید را فعال کنید.</p>
                    <div class="row">
                        <div v-for="(permission,index) in childrenSelectedPermission" class="form-check col-12 col-md-6 form-switch">
                            <input v-model="permission.is_selected" class="form-check-input" :id="'checkbox'+index" type="checkbox" />
                            <label :for="'checkbox'+index" class="form-check-label fs--1">
                                {{permission.fa_name}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </vue-bottom-sheet>
    </div>

</template>

<script>
export default {
    data() {
        return {
            standBy: false,
            isLoading: true,
            show: false,
            imgDataUrl: '',
            me: '',
            index_temp_permission: null,
            roles: [],
            emptyView: false,
            editMode: false,
            form: new Form({
                'id': '',
                'full_name': '',
                'gender': '',
                'mobile': '',
                'email': '',
                'username': '',
                'password': '',
                'note': '',
                'role_id': '',
                'password_confirmation': '',
                'profile_image': '',
                'avatar_url': '',
                'avatar': '',
                'permissions_for_edit': [],
            })
        }
    },
    methods: {
        // profile picker
        toggleShow() {
            this.show = !this.show;
        },
        srcFileSet(ileName, fileType, fileSize) {
            console.log(fileSize);
            console.log(fileType);
        },
        cropSuccess(imgDataUrl, field) {
            this.imgDataUrl = imgDataUrl;
            this.form.profile_image = imgDataUrl;
            this.form.avatar = null;
        },
        cropUploadSuccess(jsonData, field) {
        },
        cropUploadFail(status, field) {
        },
        cleanProfile() {
            this.profileReady = false;
            this.imgDataUrl = null;
            this.form.profile_image = null;
        },
        convertImgToBase64URL(url, callback, outputFormat) {
            var img = new Image();
            img.crossOrigin = 'Anonymous';
            img.onload = function () {
                var canvas = document.createElement('CANVAS'),
                    ctx = canvas.getContext('2d'), dataURL;
                canvas.height = img.height;
                canvas.width = img.width;
                ctx.drawImage(img, 0, 0);
                dataURL = canvas.toDataURL(outputFormat);
                callback(dataURL);
                canvas = null;
            };
            img.src = url;
        },

        getMe(){
            axios.get('api/me').then((data)=>{this.me=data.data;});
        },

        getUserRoles() {
            axios.get('api/user_roles').then((response) => {
                this.roles = response.data;
            });
        },
        clearForm() {
            this.form.reset();
            this.form.clear();
        },
        readUser(id){
            axios.get('api/user/'+id).then((data) => {
                this.form.fill(data.data);
                this.form.role_id = data.data.roles[0].id

                if (this.form.avatar!=null){
                    let parent = this;
                    this.convertImgToBase64URL(data.data.avatar_url, function(base64Img){
                        // Base64DataURL
                        parent.form.profile_image=base64Img;
                    });
                }



                this.isLoading = false;
            });
        },
        createUser() {
            this.standBy = true;
            this.$Progress.start();
            this.form.post('api/users').then((response) => {
                this.standBy = false;
                // this is where status is 200
                let msg = response.data.msg;
                Toast.fire({icon: 'success', title: msg});
                this.$Progress.finish();
                this.clearForm();
            }).catch((error) => {
                this.standBy = false;
                // other status code or error come here
                let status = error.response.status;
                let msg = error.response.data.msg;
                if (msg == null){msg=trans('app.failed');}
                Toast.fire({icon: 'error', title:msg});
                this.$Progress.fail();
            });
        },
        updateUser(){
            this.standBy = true;
            this.$Progress.start();
            this.form.put('api/users/' + this.form.id).then((response) => {
                this.standBy = false;
                // this is where status is 200
                let msg = response.data.msg;
                Toast.fire({icon: 'success', title: msg});
                this.$Progress.finish();
            }).catch(error => {
                this.standBy = false;
                // other status code or error come here
                let status = error.response.status;
                let msg = error.response.data.msg;
                if (msg == null){msg=trans('app.failed');}
                Toast.fire({icon: 'error', title:msg});
                this.$Progress.fail();
            });
        },
        deleteProfile(){
            this.$Progress.start();
            axios.get('api/destroy_user_profile/'+this.form.id)
                .then((response) => {
                    // this is where status is 200
                    let msg = response.data.msg;
                    Toast.fire({icon: 'success', title: msg});
                    this.$Progress.finish();
                    this.afterSuccessProfileDelete();
                })
                .catch((error) => {
                    // other status code or error come here
                    let status = error.response.status;
                    let msg = error.response.data.msg;
                    if (msg == null){msg=trans('app.failed');}
                    Toast.fire({icon: 'error', title: msg});
                    this.$Progress.fail();
                });
        },
        afterSuccessProfileDelete(){
            this.form.avatar=null;
            this.form.profile_image=null;
            this.form.avatar_url=null;
        },


        // roles
        openBottomSheet(index_permission) {
            this.$refs.PermissionBottomSheet.open();
            this.index_temp_permission = index_permission;
        },
        countOfSelectedPermissionOfPermissionParent(index){
            return   this.form.permissions_for_edit[index].children.filter(x => x.is_selected === true).length
        }
    },
    mounted() {
        this.$Progress.finish();
    },
    created() {

        this.getMe();
        this.getUserRoles();
        this.$Progress.start()
        this.clearForm();
        if(this.$route.query.id!=null){
            this.isLoading = true;
            this.clearForm();
            this.readUser(this.$route.query.id);
            this.editMode = true;
        }else{
            this.isLoading = false;
        }


    },
    computed:{
        hasAvatar(){
            if (this.form.avatar===null){
                return false;
            }else{
                return true;
            }

        },
        titleSelectedPermission(){
            if (this.index_temp_permission==null){
                return "";
            }else{
                return this.form.permissions_for_edit[this.index_temp_permission].name;
            }
        },
        childrenSelectedPermission(){
            if (this.index_temp_permission==null){
                return [];
            }else{
                return this.form.permissions_for_edit[this.index_temp_permission].children;
            }
        },
    }
}
</script>
