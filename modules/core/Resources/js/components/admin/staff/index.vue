<template>
    <div class="card mb-3">
        <div class="card-header border-bottom">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0 fw-bold">کارکنان</h5>

                </div>
                <div class="col-auto ">
                    <input style="max-width: 200px" v-model="search" v-on:keyup=""
                           type="text" class="form-control d-inline-block" id="search"
                           :placeholder="trans('app.search_place_holder')">

                    <router-link to="/cu-staff" class="btn btn-outline-primary mb-1 ">
                        <span class="fas fa-plus align-middle"></span>
                        <span>افزودن</span>
                    </router-link>
                    <button
                        @click="openTableSettingBottomSheet"
                        class="btn btn-outline-primary mb-1">
                        <span class="fas fa-cog align-middle"></span>
                    </button>
                    <button
                        :disabled="generatingExport"
                        @click="exportTable"
                        class="btn btn-outline-success mb-1">
                        <span v-show="generatingExport" class="spinner-border spinner-border-sm align-middle" role="status" aria-hidden="true"></span>
                        <span class="fas fa-file-export align-middle"></span>
                    </button>
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
                                <th v-for="(item,name) in tableHead" v-if="item.isVisible" class="pe-1 align-middle">
                                    <div
                                        class="sortable"
                                        v-if="name!=='action'"
                                        data-status="up"
                                        v-on:click='sort(name,item.type,$event,tableData)'>
                                        <span class="fas fa-angle-up"></span>
                                        <span>{{ item.title }}</span>
                                    </div>
                                    <div v-else>
                                        <span>{{ item.title }}</span>
                                    </div>

                                </th>
                            </tr>
                            </thead>
                            <tbody class="list" id="table-customers-body">
                            <tr v-if="tableData" v-for="data in  filteredItems" class="btn-reveal-trigger">
                                <td v-if="tableHead.row.isVisible" class="text-nowrap py-1 align-middle">{{data.row}}</td>
                                <td v-if="tableHead.fullName.isVisible" class="text-nowrap py-1 align-middle">{{data.fullName}}</td>
                                <td v-if="tableHead.role.isVisible" class="text-nowrap py-1 align-middle">{{data.role }}</td>
                                <td v-if="tableHead.mobile.isVisible" class="text-nowrap py-1 align-middle">{{ data.mobile }}</td>
                                <td v-if="tableHead.action.isVisible" class="text-nowrap py-1 align-middle">
                                    <router-link :to="{path:'/cu-staff',query: { id: data.action }}" class="hoverable blue">
                                        <span class="fas fa-edit"></span>
                                        <span>{{ trans('app.edit') }} </span>
                                    </router-link>
                                    <span class="mx-2"></span>
                                    <span @click="deleteUser(data.action)" class="hoverable red">
                                            <span class="fas fa-trash"></span>
                                            <span>{{ trans('app.delete') }}</span>
                                    </span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <EmptyMessage v-show="emptyView"></EmptyMessage>
                </div>
            </transition>
        </div>
        <div class="card-footer border-top bg-light text-left p-0 pt-2">
            <pagination :records="itemCount" v-model="page" :per-page="countPerPage"
                        @paginate="callback"></pagination>
        </div>
        <vue-bottom-sheet
            max-width="720px"
            max-height="80%"
            overlay="overlay"
            :click-to-close="true"
            rounded="rounded"
            :swipeAble="false"
            overlayColor="#0000009C"
            :isFullScreen="true"
            :backgroundScrollable="true"
            ref="TableSettingBottomSheet">
            <div class="container-fluid">
                <div class="px-4 mx-2">
                    <h5 class="fw-bold">
                        تنظیمات نمایش اطلاعات
                    </h5>
                    <hr>
                    <div class="row">
                        <div v-for="(head,name) in tableHead" class="form-check col-12 col-md-4 form-switch">
                            <input v-model="head.isVisible" :id="'item'+name" class="form-check-input" type="checkbox" />
                            <label :for="'item'+name" class="form-check-label fs--1">
                                {{head.title}}
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
    components: {
        Pagination,
    },
    data() {
        return {
            me: '',
            isLoading: true,
            emptyView: false,
            form: new Form({
                'id': '',
            }),

            users: [],
            tableHead: {
                'row': {'isVisible': true,'type':'number', 'title': 'ردیف'},
                'fullName': {'isVisible': true,'type':'string', 'title': 'نام و نام خانوادگی'},
                'role': {'isVisible': true,'type':'string', 'title': 'نقش'},
                'mobile': {'isVisible': true,'type':'number', 'title': 'موبایل'},
                'action': {'isVisible': true,'type':'-', 'title': 'عملیات'},
            },
            tableData: [],
            page: 1,
            search: '',
            itemCount: 0,
            rowNormalizer: 0,
            countPerPage: 20,
            generatingExport: false,

        }
    },
    methods: {
        getUsers() {
            this.isLoading = true;
            this.$Progress.start();
            axios.get('api/users').then((response) => {
                if (response.data.length === 0) {
                    this.emptyView = true;
                } else {
                    this.users = response.data;
                    this.tableData = this.makeTableData(this.users)
                    this.emptyView = false;
                }
                this.$Progress.finish();
                this.isLoading = false;
            }).catch((error) => {
                let msg = error.response.data.msg;
                if (msg == null) {
                    msg = trans('app.failed');
                }
                Toast.fire({icon: 'error', title: msg});
                this.$Progress.fail();
                this.isLoading = false;
            });
        },
        deleteUser(id) {
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
                    this.form.delete('api/users/' + id)
                        .then((response) => {
                            // this is where status is 200
                            let msg = response.data.msg;
                            Toast.fire({icon: 'success', title: msg});
                            this.$Progress.finish();
                            removeItemFromListById(id, this.users);
                            removeItemFromListById(id, this.tableData);
                        }).catch((error) => {
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
        // Data Table
        makeTableData(data) {
            var items = []
            data.forEach((object, index) => {
                const item = {
                    row: index + 1,
                    fullName: object.full_name,
                    role: object.roles[0].fa_name,
                    mobile: object.mobile,
                    action: object.id
                };
                items.push(item)
            })
            return items;
        },
        searchPaging () {
            this.page = 1;
        },
        callback (page) {
            this.rowNormalizer = (page - 1) * this.countPerPage
        },
        openTableSettingBottomSheet(){
            this.$refs.TableSettingBottomSheet.open()
        },
        exportTable(){
            if (this.filteredItems.length>0){
                this.generatingExport = true;
                axios.post(`api/export`, {
                    head: this.tableHead,
                    data: this.filteredItems
                })
                    .then(response => {
                        this.generatingExport = false;
                        this.downloadExport(response.data)
                        console.log(response)
                    })
                    .catch(e => {
                        this.generatingExport = false;
                        this.errors.push(e)
                    })
            }else{
                Toast.fire({icon: 'error', title: "اطلاعاتی برای خروجی گرفتن وجود ندارد."});

            }

        },
        downloadExport ( url ) {
            const a = document.createElement('a')
            a.href = url
            a.download = url.split('/').pop()
            document.body.appendChild(a)
            a.click()
            document.body.removeChild(a)
        }
    },
    mounted() {
        this.$Progress.finish();
    },
    created() {
        this.$Progress.start()
        this.getUsers();
    },
    computed: {
        filteredItems: function () {
            let items = this.tableData.filter(order => {
                return (
                    // search
                    order.mobile.indexOf(this.search) > -1 ||
                    order.fullName.toString().indexOf(this.search) > -1
                )
                // ||
                // ((order.family == null) ? false : order.family.indexOf(this.search) > -1) ||
                // ((order.asas_number == null) ? false : order.asas_number.toString().indexOf(this.search) > -1) ||
                // order.sclass.name.indexOf(this.search) > -1 ||
                // ((order.family == null) ? false : (order.name + ' ' + order.family).indexOf(this.search) > -1) ||
                // ((order.father_name == null) ? false : order.father_name.indexOf(this.search) > -1) ||
                // (trans('app.' + order.gender + '_sm')).indexOf(this.search) > -1)

                // &&
                // ((this.base === trans('app.all')) ? true : trans('app.' + order.sclass.base) == this.base)
                // &&
                // ((this.status === trans('app.all')) ? true : order.status.name == this.status)
                // &&
                // ((this.status === trans('app.all')) ? true : order.status.name == this.status)
                // &&
                // ((this.gender === trans('app.all')) ? true : trans('app.' + order.gender + '_sm') == this.gender)

            });
            let start = (this.page - 1) * this.countPerPage;
            let end = this.page * this.countPerPage;
            this.itemCount = items.length;
            let result = items.slice(start, end);
            if (result.length === 0) {
                this.emptyView = true;
                return [];
            } else {
                this.emptyView = false;
                return (result)
            }

        },
    }
}
</script>
