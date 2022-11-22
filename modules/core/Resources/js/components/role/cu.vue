<template>
    <div>
        <div class="card mb-3">
            <div class="card-header border-bottom">
                <div class="row flex-between-end">
                    <div class="col-auto align-self-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">
                                <router-link to="/roles">نقش های کارکنان</router-link>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span v-if="!editMode">ساخت نقش جدید</span>
                                <span v-else>ویرایش اطلاعات</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <button v-show="!standBy" type="submit" form="mainForm" class="btn btn-success mt-2 mt-lg-0 mb-1 ">
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
                    <div class="container" style="overflow: hidden" v-show="!isLoading">
                        <form id="mainForm" @submit.prevent="editMode ? updateRole() : createRole()" class="row">
                            <div class="col-lg-6">
                                <div class="row px-1">
                                    <div class="mb-2 col-lg-6">
                                        <label for="fa_name" class="form-label">نام فارسی نقش</label>
                                        <input class="form-control col" type="text" id="fa_name" v-model="form.fa_name"
                                               :class="{ 'is-invalid': form.errors.has('fa_name') }" required/>
                                        <has-error :form="form" field="fa_name"></has-error>
                                    </div>
                                    <div class="mb-2 col-lg-6">
                                        <label for="name" class="form-label">نام انگلیسی نقش</label>
                                        <input :disabled="editMode" class="form-control col ltr" type="text" id="name" v-model="form.name"
                                               :class="{ 'is-invalid': form.errors.has('name') }" required/>
                                        <has-error :form="form" field="name"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">{{ trans('app.des') }}</label>
                                        <textarea v-model="form.des" class="form-control fs--1"
                                                  id="exampleFormControlTextarea1" rows="5"></textarea>

                                        <p class="red fs--1 rounded border p-2 mt-4 ">
                                            توجه : در صورتی که پرمیشنی را برای هر نقشی تنظیم کنید، پرمیشن ها برای کاربرانی که در حال حاضر در سیستم هستند تغییری نمی کند و فقط برای کاربرانی که جدید در سیستم اضافه می شوند اعمال می شوند.
                                            برای تغییر پرمیشن کاربران فعلی باید از طریق صفحه خود کاربر اقدام کنید.
                                        </p>
                                    </div>



                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">دسترسی ها</label>
                                <ul class="list-group">
                                    <li @click="openBottomSheet(index)" v-for="(permission_parent,index) in  permissions"
                                        class="btn btn-falcon-default list-group-item d-flex justify-content-between align-items-center mb-2 ">
                                        {{ permission_parent.name }}
                                        <div class="d-flex flex-row px-1">
                                            <span class="badge badge-soft-success rounded-pill mx-2">{{countOfSelectedPermissionOfPermissionParent(index)}}</span>
                                            <span class="badge badge-soft-secondary rounded-pill">{{permission_parent.children.length}}</span>
                                        </div>

                                    </li>
                                </ul>



                            </div>
                        </form>
                    </div>
                </transition>

            </div>

            <div class="card-footer border-top d-lg-none text-center align-center">
                <button v-show="!standBy" type="submit" form="mainForm" class="btn btn-success mx-auto mb-1 ">
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
            max-height="80%"
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
                               <input v-model="permission.is_selected" class="form-check-input" id="flexSwitchCheckDefault" type="checkbox" />
                               <label class="form-check-label">
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
            me: '',
            permissions: [],
            index_temp_permission: null,
            emptyView: false,
            editMode: false,
            form: new Form({
                'id': '',
                'fa_name': '',
                'name': '',
                'des': '',
                'permissions': [],
            })
        }
    },
    methods: {
        getMe() {
            axios.get('api/me').then((data) => {
                this.me = data.data;
            });
        },
        clearForm() {
            this.form.reset();
            this.form.clear();
        },
        getPermission() {
            axios.get('api/permissions').then((data) => {
                this.permissions = data.data;
                this.isLoading = false;
            });
        },
        readRole(id) {
            axios.get('api/user_role/'+id).then((data) => {
                this.form.fill(data.data.role);
                this.permissions = data.data.permissions;
                this.isLoading = false;
            });
        },
        openBottomSheet(index_permission) {
            this.$refs.PermissionBottomSheet.open();
            this.index_temp_permission = index_permission;
        },
        createRole(){
            this.form.permissions = this.permissions;
            this.standBy=true;
            this.$Progress.start();
            this.form.post('api/user_roles').then((response) => {
                this.standBy=false;
                // this is where status is 200
                let msg = response.data.msg;
                Toast.fire({icon: 'success', title: msg});
                this.$Progress.finish();
                this.clearForm();
                this.getPermission();
            }).catch((error) => {
                this.standBy=false;
                // other status code or error come here
                let status = error.response.status;
                let msg = error.response.data.msg;
                if (msg == null) {
                    msg = trans('app.failed');
                }
                Toast.fire({icon: 'error', title: msg});
                this.$Progress.fail();
            });

        },
        updateRole(){
            this.form.permissions = this.permissions;
            this.standBy=true;
            this.$Progress.start();
            this.form.put('api/user_roles/' + this.form.id).then((response) => {
                this.standBy=false;
                // this is where status is 200
                let msg = response.data.msg;
                Toast.fire({icon: 'success', title: msg});
                this.$Progress.finish();
                this.readRole(this.form.id)
            }).catch(error => {
                this.standBy=false;
                // other status code or error come here
                let status = error.response.status;
                let msg = error.response.data.msg;
                if (msg == null) {
                    msg = trans('app.failed');
                }
                Toast.fire({icon: 'error', title: msg});
                this.$Progress.fail();
            });
        },
        countOfSelectedPermissionOfPermissionParent(index){
          return   this.permissions[index].children.filter(x => x.is_selected === true).length
        }
    },
    mounted() {
        this.$Progress.finish()
    },
    created() {
        this.isLoading = true;
        this.getMe();
        this.$Progress.start()
        if(this.$route.query.id!=null){
            this.clearForm();
            this.readRole(this.$route.query.id);
            this.editMode = true;
        }else{
            this.getPermission();
            this.clearForm();
        }


    },
    computed: {
        titleSelectedPermission(){
            if (this.index_temp_permission==null){
                return "";
            }else{
                return this.permissions[this.index_temp_permission].name;
            }
        },
        childrenSelectedPermission(){
            if (this.index_temp_permission==null){
                return [];
            }else{
                return this.permissions[this.index_temp_permission].children;
            }
        },

    }
}
</script>
