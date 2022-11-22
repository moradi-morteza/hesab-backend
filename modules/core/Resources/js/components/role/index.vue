<template>

        <div class="card mb-3">
            <div class="card-header border-bottom">
                <div class="row flex-between-end">
                    <div class="col-auto align-self-center">
                        <h5 class="mb-0 fw-bold">نقش های کارکنان</h5>
                    </div>
                    <div class="col-auto">
                        <router-link to="/cu-role" class="btn btn-outline-primary mb-1 ">
                            <span class="fas fa-plus align-middle"></span>
                            <span>افزودن</span>
                        </router-link>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div v-if="isLoading" class="spinner-border d-block text-primary mx-auto m-3" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <transition name="slide-fade">
                    <div style="overflow: hidden" v-show="!isLoading">
                        <div v-show="!emptyView" class="table-responsive">
                            <table class="table table-sm table-striped fs--1 mb-0 overflow-hidden">
                                <thead class="bg-200 text-900">
                                <tr>
                                    <th class="sort pe-1  align-middle ">{{ trans('app.row') }}</th>
                                    <th class="sort pe-1  align-middle ">
                                        <span>نام فارسی نقش</span>
                                    </th>
                                    <th class="sort pe-1  align-middle ">
                                        <span>نام انگلیسی نقش</span>
                                    </th>
                                    <th class="sort pe-1  align-middle ">
                                        <span>توضیحات</span>
                                    </th>
                                    <th class="sort pe-1  align-middle ">عملیات</th>
                                </tr>
                                </thead>
                                <tbody class="list" id="table-customers-body">
                                <tr v-for="(role,index) in  roles" class="btn-reveal-trigger">
                                    <td class="text-nowrap py-1 align-middle"><span class="fs-0">{{ index + 1 }}</span></td>
                                    <td class="text-nowrap py-1 align-middle"><span style="color: black" class="mb-0 fw-bold">{{ role.fa_name }}</span></td>
                                    <td class="text-nowrap py-1 align-middle"><span class="mb-0 fw-bold">{{ role.name }}</span></td>
                                    <td class="text-nowrap py-1 align-middle">{{ role.des }}</td>
                                    <td class="text-nowrap py-1 align-middle" v-if="role.id!==1">
                                        <router-link :to="{path:'/cu-role',query: { id: role.id }}"  class="hoverable blue">
                                            <span class="fas fa-edit"></span>
                                            <span>{{ trans('app.edit') }} </span>
                                        </router-link>
<!--                                        <span class="mx-2"></span><span @click="deleteRole(role.id)" class="hoverable red">-->
<!--                                            <span class="fas fa-trash"></span>-->
<!--                                            <span>{{ trans('app.delete') }}</span>-->
<!--                                        </span>-->
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <EmptyMessage v-show="emptyView"></EmptyMessage>
                    </div>
                </transition>
            </div>
        </div>

</template>

<script>
export default {

    data() {
        return {
            isLoading: true,
            me: '',
            emptyView: false,
            roles: [],
            form: new Form({
                'id': '',
            })
        }
    },

    methods: {
        getRoles() {
            this.isLoading = true;
            this.$Progress.start();
            axios.get('api/user_roles').then((response) => {
                // this is where status is 200
                if (response.data.length === 0) {
                    this.emptyView = true;
                } else {
                    this.roles = response.data;
                    this.emptyView = false;
                }
                this.$Progress.finish();
                this.isLoading = false;
            }).catch((error) => {
                // other status code or error come here
                let status = error.response.status;
                let msg = error.response.data.msg;
                if (msg == null) {
                    msg = trans('app.failed');
                }
                Toast.fire({icon: 'error', title: msg});
                this.$Progress.fail();
                this.isLoading = false;
            });
        },
        deleteRole(id) {
            Swal.fire({
                showClass: {popup: ''}, hideClass: {popup: ''},
                title: trans('app.title_delete'),
                text: trans('app.des_delete'),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: trans('app.yes'),
                cancelButtonText: trans('app.cancel'),
            }).then((result) => {
                if (result.value) {
                    this.$Progress.start();
                    this.form.delete('api/user_roles/' + id).then((response) => {
                        // this is where status is 200
                        let msg = response.data.msg;
                        Toast.fire({icon: 'success', title: msg});
                        this.$Progress.finish();
                        removeItemFromListById(id, this.roles);
                    }).catch((error) => {
                        // other status code or error come here
                        let status = error.response.status;
                        let msg = error.response.data.msg;
                        if (msg == null) {
                            msg = trans('app.failed');
                        }
                        Toast.fire({icon: 'error', title: msg});
                        this.$Progress.fail();
                    });
                }

            })
        },
    },
    mounted() {
        console.log('Component mounted.')
        this.$Progress.finish();
    },
    created() {
        this.getRoles();
    }
}
</script>
