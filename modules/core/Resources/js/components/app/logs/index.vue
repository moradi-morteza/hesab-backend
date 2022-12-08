<template>
    <div class="card mb-3">

        <div class="card-header border-bottom">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0 fw-bold">فعالیت سیستم</h5>
                    <span
                        v-for="filterObject in activeFilter"
                        :class="filterObject.styleClass"
                        class="badge mx-1">{{ filterObject.key }} | {{ filterObject.value }}
                        </span>
                </div>
                <div class="d-flex flex-column flex-lg-row mx-1 col-auto mt-lg-0 mt-2">
                    <div class="input-group width-auto mx-1">
                        <input style="max-width: 150px" v-model="search" v-on:keyup=""
                               type="text" class="form-control d-inline-block" id="search"
                               :placeholder="trans('app.search_place_holder')">
                        <span class="input-group-text">در</span>
                        <select style="max-width: 100px" v-model="searchInColumn" class="form-select">
                            <option selected="selected" value="all">همه</option>
                            <option v-for="(item,name) in tableHead"
                                    v-if="item.isEnable && item.isSearchAble && name!=='row'" :value="name">
                                {{ item.title }}
                            </option>

                        </select>
                    </div>
                    <button
                        @click="openTableSettingBottomSheet"
                        class="btn btn-outline-primary mx-1 mt-lg-0 mt-2">
                        <span class="fas fa-cog align-middle"></span>
                    </button>
<!--                    <button-->
<!--                        :disabled="generatingExport"-->
<!--                        @click="exportTable"-->
<!--                        class="btn btn-outline-success mx-1 mt-lg-0 mt-2">-->
<!--                        <span v-show="generatingExport" class="spinner-border spinner-border-sm align-middle"-->
<!--                              role="status" aria-hidden="true"></span>-->
<!--                        <span class="fas fa-file-export align-middle"></span>-->
<!--                    </button>-->
                </div>

            </div>
        </div>
        <div class="card-body p-0">
            <div v-if="isLoading" class="spinner-border d-block text-primary mx-auto m-3" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <transition name="slide-fade">
                <div style="overflow: hidden" v-show="!isLoading">
                    <div class="px-3 pb-3 pt-1 row bg-light border-bottom">
                        <div v-for="(filterItem,name) in tableFilter" v-if="filterItem.showInHeader"
                             :class="(filterItem.filterType!=='date')?'col-lg-3 mt-3':'col-lg-6 mt-3'">

                            <div class="input-group" v-if="filterItem.filterType==='string'">
                                <label class="input-group-text fs--1 mb-0">{{ filterItem.title }}</label>
                                <select
                                    @change="filterChanged(filterItem.title,tableFilter[name].value)"
                                    v-model="tableFilter[name].value" class="form-select">
                                    <option selected value="all">{{ trans('app.all') }}</option>
                                    <option v-for="option in filterItem.options " :value="option">{{ option }}</option>
                                </select>
                            </div>

                            <div v-if="filterItem.filterType==='date'">

                                <date-filter
                                    :filterKey="name"
                                    @dateSelected="selectTimeFilter"
                                    @resetDate="resetDateFilter"
                                    :title="filterItem.title"/>

                            </div>

                        </div>
                    </div>
                    <div v-show="!emptyView" class="table-responsive">
                        <table class="table table-sm table-striped fs--1 mb-0 overflow-hidden">
                            <thead class="bg-200 text-900">
                            <tr>
                                <th v-for="(item,name) in tableHead" v-if="item.isVisible" class="pe-1 align-middle">
                                    <div
                                        class="sortable"
                                        v-if="name!=='logMessage'"
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

                                <tr v-for="data in filteredItems" class=" py-2 btn-reveal-trigger">
                                <td v-if="tableHead.row.isVisible" class=" py-2 text-nowrap  align-middle">{{ data.row }}
                                </td>
                                <td v-if="tableHead.logMessage.isVisible" class=" py-2 text-nowrap bold-black  align-middle">
                                    <span v-html="data.logMessage"></span>
                                </td>
                                <td v-if="tableHead.createdAtAgo.isVisible" class=" py-2 text-nowrap  align-middle">
                                    {{ data.createdAtAgo }}
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
            <pagination :records="itemCount" v-model="page" :per-page="countPerPage" @paginate="callback"></pagination>
        </div>
        <vue-bottom-sheet
            max-width="820px"
            max-height="90%"
            overlay="overlay"
            :click-to-close="true"
            rounded="rounded"
            :swipeAble="false"
            overlayColor="#0000009C"
            :isFullScreen="true"
            :backgroundScrollable="true"
            ref="TableSettingBottomSheet">
            <div class="container-fluid">
                <div class="px-4">
                    <h5 class="fw-bold">
                        تنظیمات نمایش اطلاعات
                    </h5>
                    <hr>
                    <h5>ویژگی ها</h5>
                    <div class="row px-4">
                        <div v-for="(head,name) in tableHead" v-if="head.isEnable"
                             class="form-check col-12 col-md-4 form-switch">
                            <input v-model="head.isVisible" :id="'item'+name" class="form-check-input" type="checkbox"/>
                            <label :for="'item'+name" class="form-check-label fs--1">
                                {{ head.title }}
                            </label>
                        </div>
                    </div>
                    <hr>
                    <h5>فیلتر ها</h5>
                    <div class="row px-4">
                        <div v-for="(filter,name) in tableFilter"
                             class="form-check col-12 col-md-4 form-switch">
                            <input v-model="filter.showInHeader" :id="'filter'+name" class="form-check-input"
                                   type="checkbox"/>
                            <label :for="'filter'+name" class="form-check-label fs--1">
                                {{ filter.title }}
                            </label>
                        </div>
                    </div>
                    <hr>
                    <h5>ثوابت</h5>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">تعداد آیتم در هر صفحه</label>
                            <input @input="protectCountPerPageZeroValue" class="form-control"
                                   v-model.number="countPerPage" type="number">
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
        Pagination
    },
    data() {
        return {

            isLoading: true,
            emptyView: false,
            app_actions: [],

            logs: [],
            tableHead: {
                'row': {'isSearchAble': false, 'isEnable': true, 'isVisible': true, 'type': 'number', 'title': 'ردیف'},
                'logMessage': {
                    'isSearchAble': true,
                    'isEnable': true,
                    'isVisible': true,
                    'type': 'number',
                    'title': 'پیام'
                },
                'createdAtAgo': {
                    'isSearchAble': true,
                    'isEnable': true,
                    'isVisible': true,
                    'type': 'string',
                    'title': 'تاریخ ثبت'
                },

                // data than not need to show in user but used for calculate
                'logId': {
                    'isSearchAble': false,
                    'isEnable': false,
                    'isVisible': false,
                    'type': 'string',
                    'title': 'شناسه لاگ'
                },
                'createdAtFaDate': {
                    'isSearchAble': false,
                    'isEnable': false,
                    'isVisible': false,
                    'type': 'string',
                    'title': 'تاریخ ثبت'
                },
                'logType': {
                    'isSearchAble': false,
                    'isEnable': false,
                    'isVisible': false,
                    'type': 'string',
                    'title': 'تاریخ ثبت'
                },


            },
            tableData: [],
            activeFilter: [],
            tableFilter: {
                'logType': {
                    'filterType': 'string',
                    'showInHeader': true,
                    'title': 'نوع',
                    'value': 'all',
                    'options': []
                },
                'createdAtFaDate': {
                    'filterType': 'date',
                    'showInHeader': false,
                    'title': 'تاریخ ثبت',
                    'minValue': 'all',
                    'maxValue': 'all',
                    'options': []
                },
            },
            page: 1,
            search: '',
            searchInColumn: 'all',
            itemCount: 0,
            rowNormalizer: 0,
            countPerPage: 20,
            generatingExport: false,
        }
    },
    methods: {

        getLogs() {
            this.isLoading = true;
            this.$Progress.start();
            axios.get('api/logs').then((response) => {
                this.logs = response.data;
                this.tableData = this.makeTableData(this.logs)
                this.emptyView = false;
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

        // Data Table
        makeTableData(data) {
            var items = []
            data.forEach((log, index) => {
                const item = {
                    row: index + 1,
                    logId: log.id,
                    createdAtAgo: log.created_at_ago,
                    createdAtFaDate: log.created_at_fa_date,
                    logMessage: log.message.global,
                    logType: log.action.fa_name,
                };
                // add option to tableFilter
                Object.keys(this.tableFilter).forEach((filterKey) => {
                    if (this.tableFilter[filterKey].options.indexOf(item[filterKey]) === -1) {
                        this.tableFilter[filterKey].options.push(item[filterKey])
                    }
                });
                items.push(item)
            })
            return items;
        },
        searchPaging() {
            this.page = 1;
        },
        callback(page) {
            this.rowNormalizer = (page - 1) * this.countPerPage
        },
        openTableSettingBottomSheet() {
            this.$refs.TableSettingBottomSheet.open()
        },
        filterChanged(filterKey, filterValue) {
            const filterObject = {key: filterKey, value: filterValue, styleClass: this.randomSoftBadge()}
            const findIndex = this.activeFilter.findIndex(element => {
                return element.key === filterObject.key;
            });
            if (filterValue === 'all') {
                if (findIndex !== -1) {
                    this.activeFilter.splice(findIndex, 1);
                }
            } else {
                if (findIndex === -1) {
                    this.activeFilter.push(filterObject)
                } else {
                    this.activeFilter[findIndex].value = filterValue
                }
            }
            // for update filteredItems we need to change once search
            this.search = ''
        },
        exportTable() {
            if (this.filteredItems.length > 0) {
                this.generatingExport = true;
                axios.post(`api/export`, {
                    head: this.tableHead,
                    data: this.filteredItems
                })
                    .then(response => {
                        this.generatingExport = false;
                        this.downloadExport(response.data)
                    })
                    .catch(e => {
                        this.generatingExport = false;
                        this.errors.push(e)
                    })
            } else {
                Toast.fire({icon: 'error', title: "اطلاعاتی برای خروجی گرفتن وجود ندارد."});

            }

        },
        downloadExport(url) {
            const a = document.createElement('a')
            a.href = url
            a.download = url.split('/').pop()
            document.body.appendChild(a)
            a.click()
            document.body.removeChild(a)
        },
        protectCountPerPageZeroValue() {
            if (this.countPerPage === 0) {
                this.countPerPage = 10
            }
        },
        selectTimeFilter(filterKey, fromUnix, toUnix) {
            this.tableFilter[filterKey].minValue = fromUnix
            this.tableFilter[filterKey].maxValue = toUnix
        },
        resetDateFilter(filterKey) {
            this.tableFilter[filterKey].maxValue = "all"
            this.tableFilter[filterKey].minValue = "all"
        }
    },
    mounted() {
        this.$Progress.finish();
    },
    created() {
        this.getLogs();
    },
    computed: {
        filteredItems: function () {
            let items = this.tableData.filter(log => {
                return (
                    // search
                    ((this.searchInColumn === 'all')
                        ? (this.searchInDataTable(this.search, log, this.tableHead))
                        : log[this.searchInColumn].toString().indexOf(this.search) > -1)
                    &&
                    // filters
                    (
                        // (this.tableFilter.requirementStatus.value === 'all' ? true : this.tableFilter.requirementStatus.value === requirement.requirementStatus)
                        // && (this.tableFilter.requirementType.value === 'all' ? true : this.tableFilter.requirementType.value === requirement.requirementType)
                        (this.tableFilter.logType.value === 'all' ? true : this.tableFilter.logType.value === log.logType)
                        &&(this.tableFilter.createdAtFaDate.minValue === 'all' ? true : (this.checkDateIsBetweenOrSameDates(this.getPersianDateStringUnix(log.createdAtFaDate), this.tableFilter.createdAtFaDate.minValue, this.tableFilter.createdAtFaDate.maxValue)))
                    )
                )

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
    },

}
</script>
