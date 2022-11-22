<template>

    <div>
        <div class="d-flex mb-4 "><span class="fa-stack me-2 ms-n1">
             <i class="fa-inverse fa-stack-1x text-primary fas fa-user" data-fa-transform="shrink-4"></i>
        </span>
            <div class="col">
                <h5 class="mb-0 text-primary position-relative"><span class="bg-200 dark__bg-1100 pe-3">
                    {{ me.role_name }}
                </span><span class="border position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span>
                </h5>
                <p class="mb-0 mt-2 fs--1">
                    {{ me.full_name }}
                </p>
            </div>
        </div>
        <div v-if="isLoading" class="spinner-border d-block text-primary mx-auto m-3" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div v-if="!isLoading">

            <div v-if="$hasRole('admin')" class="row g-3 mb-3">

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row h-100 justify-content-between g-0">
                                    <div class="col-xxl pe-2">
                                        <h6 class="mt-1 fs-1">سفارشات</h6>
                                        <div class="fs--2 mt-3 fs--1">

                                            <div class="d-flex flex-between-center mb-1">
                                                <div class="d-flex align-items-center"><span
                                                    class="dot bg-primary"></span><span class="fw-semi-bold"> سفارشات فعال</span>
                                                </div>
                                                <div class="d-xxl-none">
                                                    <span class="fs--1 fw-bold">{{ adminData.countOrderActive }}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-between-center mb-1">
                                                <div class="d-flex align-items-center"><span
                                                    class="dot bg-success"></span><span class="fw-semi-bold">سفارشات پایان یافته</span>
                                                </div>
                                                <div class="d-xxl-none">
                                                    <span
                                                        class="fs--1 fw-bold">{{ adminData.countOrderFinished }}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-between-center mb-1">
                                                <div class="d-flex align-items-center"><span
                                                    class="dot bg-danger"></span><span class="fw-semi-bold"> سفارشات رد شده</span>
                                                </div>
                                                <div class="d-xxl-none">
                                                    <span class="fs--1 fw-bold">{{
                                                            adminData.countOrderRejected
                                                        }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="row h-100 justify-content-between g-0">
                                    <div class="col-xxl pe-2">
                                        <h6 class="mt-1 fs-1">وضعیت انبار</h6>
                                        <div class="fs--2 mt-3 fs--1">
                                            <div class="d-flex flex-between-center mb-1">
                                                <div class="d-flex align-items-center"><span
                                                    class="dot bg-300"></span><span
                                                    class="fw-semi-bold"> قفسه های خالی</span></div>
                                                <div class="d-xxl-none">
                                                    <span class="fs--1 fw-bold">{{
                                                            adminData.cageTotalCount - adminData.cageFilledCount
                                                        }}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-between-center mb-1">
                                                <div class="d-flex align-items-center"><span
                                                    class="dot bg-primary"></span><span class="fw-semi-bold"> کل دستگاه های موجود</span>
                                                </div>
                                                <div class="d-xxl-none">
                                                    <span
                                                        class="fs--1 fw-bold">{{
                                                            adminData.cageTotalDeviceCount
                                                        }}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-between-center mb-1">
                                                <div class="d-flex align-items-center"><span class="dot bg-info"></span><span
                                                    class="fw-semi-bold"> قفسه های اشغال شده</span></div>
                                                <div class="d-xxl-none">
                                                    <span class="fs--1 fw-bold">{{ adminData.cageFilledCount }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row mb-2">
                                            <div class="col-6 border-end border-200">
                                                <h4 class="fs-0 mb-0">{{ adminData.countInternalCageTotal }}</h4>
                                                <p class="fs--1 text-600 mb-0">قفسه های داخلی</p>
                                                <p class="fs--2 text-600 mb-0">ظرفیت : 5 دستگاه کوچک</p>
                                            </div>
                                            <div class="col-6">
                                                <h4 class="fs-0 mb-0">{{ adminData.countExternalCageTotal }}</h4>
                                                <p class="fs--1 text-600 mb-0">قفسه های خارجی</p>
                                                <p class="fs--2 text-600 mb-0">ظرفیت : 1 دستگاه بزرگ</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="row h-100 justify-content-between g-0">
                                    <div class="col-xxl pe-2">
                                        <h6 class="mt-1 fs-1">پرسنل</h6>
                                        <div class="fs--2 mt-3 fs--1">

                                            <div class="row mb-2">
                                                <div class="col-4 border-end border-200">
                                                    <h5 class="mb-0">{{ adminData.countTotalPersons }}</h5>
                                                    <p class="fs--1 text-600 mb-0">مجموع پرسنل</p>
                                                </div>
                                                <div class="col-3 border-end border-200">
                                                    <h4 class="fs-0 mb-0">{{ adminData.countRepairman }}</h4>
                                                    <p class="fs--1 text-600 mb-0">تعمیرکار</p>
                                                </div>
                                                <div class="col-4 text-center">
                                                    <h4 class="fs-0 mb-0">{{ adminData.countStaff }}</h4>
                                                    <p class="fs--1 text-600 mb-0">کارمند ساده</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mt-3 mt-md-0">
                            <div class="card-header d-flex flex-between-center">
                                <h6 class="mb-0 fs-1">کارها</h6>
                            </div>
                            <div class="card-body py-0">
                                <div class="row mb-2">
                                    <div class="col-6 border-end border-200">
                                        <span class="mb-0 fs--1" style="color:black">{{
                                                convertMinutesToHourMinute(adminData.countTaskSpendTime)
                                            }}</span>
                                        <p class="fs--1 text-600 mb-0">مجموع زمان صرف شده</p>
                                    </div>
                                    <div class="col-3 border-end text-center border-200">
                                        <h2 class="fs-0 mb-0">{{ adminData.countRepairman }}</h2>
                                        <p class="fs--1 text-600 mb-0">تعمیرکاران</p>
                                    </div>
                                    <div class="col-3 text-center">
                                        <h4 class="fs-0 mb-0">{{ adminData.countTotalTask }}</h4>
                                        <p class="fs--1 text-600 mb-0">کل کارها</p>
                                    </div>
                                </div>
                                <div class="overflow-visible progress mt-4 rounded-3 mb-3" style="height: 6px;">

                                    <div v-show="!isNaN(adminData.percentTaskTodo)"
                                         class="overflow-visible progress-bar bg-progress-gradient border-end border-white border-2 rounded-end rounded-pill"
                                         role="progressbar" :style="{width: adminData.percentTaskTodo+'%'}"
                                         :aria-valuenow="adminData.percentTaskTodo" aria-valuemin="0"
                                         aria-valuemax="100"><span
                                        class="mt-n4 text-900 fw-bold">{{ adminData.percentTaskTodo }}%</span></div>

                                    <div v-show="!isNaN(adminData.percentTaskDone)"
                                         class="overflow-visible progress-bar bg-warning border-end border-white border-2 rounded-end rounded-pill"
                                         role="progressbar" :style="{width: adminData.percentTaskDone+'%'}"
                                         :aria-valuenow="adminData.percentTaskDone" aria-valuemin="0"
                                         aria-valuemax="100"><span
                                        class="mt-n4 text-900 fw-bold">{{ adminData.percentTaskDone }}%</span></div>

                                    <div v-show="adminData.percentTaskConfirmed"
                                         class="overflow-visible progress-bar bg-success border-end border-white border-2 rounded-end rounded-pill"
                                         role="progressbar" :style="{width: adminData.percentTaskConfirmed+'%'}"
                                         :aria-valuenow="adminData.percentTaskConfirmed" aria-valuemin="0"
                                         aria-valuemax="100"><span
                                        class="mt-n4 text-900 fw-bold">{{ adminData.percentTaskConfirmed }}%</span>
                                    </div>

                                    <div v-show="!isNaN(adminData.percentTaskRejected)"
                                         class="overflow-visible progress-bar bg-danger border-end border-white border-2 rounded-end rounded-pill"
                                         role="progressbar" :style="{width: adminData.percentTaskRejected+'%'}"
                                         :aria-valuenow="adminData.percentTaskRejected" aria-valuemin="0"
                                         aria-valuemax="100"><span
                                        class="mt-n4 text-900 fw-bold">{{ adminData.percentTaskRejected }}%</span></div>

                                </div>
                                <div class="d-flex justify-content-between px-2">
                                    <h6>نوع </h6>
                                    <h6>تعداد</h6>
                                </div>
                                <div class="d-flex flex-between-center rounded-3 bg-light py-2 px-3 mb-2">
                                    <div>
                                        <h6 class="mb-0">
                                        <span class="fas fa-circle fs--2 me-3 text-primary">
                                        </span>در انتظار انجام</h6>
                                    </div>
                                    <div class="fs--1 text-600 mb-0 fw-bold">{{ adminData.countTodoTask }}</div>
                                </div>
                                <div class="d-flex flex-between-center rounded-3 bg-light py-2 px-3 mb-2">
                                    <div>
                                        <h6 class="mb-0">
                                        <span class="fas fa-circle fs--2 me-3 text-warning">
                                        </span>در انتظار تایید یا رد</h6>
                                    </div>
                                    <div class="fs--1 text-600 mb-0 fw-bold">{{ adminData.countDoneTask }}</div>
                                </div>
                                <div class="d-flex flex-between-center rounded-3 bg-light py-2 px-3 mb-2">
                                    <div>
                                        <h6 class="mb-0">
                                        <span class="fas fa-circle fs--2 me-3 text-success">
                                        </span>تایید شده</h6>
                                    </div>
                                    <div class="fs--1 text-600 mb-0 fw-bold">{{ adminData.countConfirmedTask }}</div>
                                </div>
                                <div class="d-flex flex-between-center rounded-3 bg-light py-2 px-3 mb-2">
                                    <div>
                                        <h6 class="mb-0">
                                        <span class="fas fa-circle fs--2 me-3 text-danger">
                                        </span>رد شده</h6>
                                    </div>
                                    <div class="fs--1 text-600 mb-0 fw-bold">{{ adminData.countRejectedTask }}</div>
                                </div>

                            </div>
                            <div class="card-footer py-2">
                                <div class="fs--2 mt-0 fs--2">
                                    <div class="row my-2">
                                        <div class="col-4 border-end border-200">
                                            <h4 class="fs-0 mb-0">{{ adminData.countRepairTask }}</h4>
                                            <p class="fs--2 text-600 mb-0">تعمیر دستگاه</p>
                                        </div>
                                        <div class="col-4 border-end border-200">
                                            <h4 class="fs-0 mb-0">{{ adminData.countInitReviewTask }}</h4>
                                            <p class="fs--2 text-600 mb-0">بررسی اولیه</p>
                                        </div>
                                        <div class="col-4">
                                            <h4 class="fs-0 mb-0">{{ adminData.countRepackTask }}</h4>
                                            <p class="fs--2 text-600 mb-0">آماده سازی برگشت</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="row h-100 justify-content-between g-0">
                                    <div class="col-xxl pe-2">
                                        <h6 class="mt-1 fs-1">نیازمندی ها</h6>
                                        <div class="fs--2 mt-3 fs--1">

                                            <div class="row mb-2">
                                                <div class="col-4 border-end border-200">
                                                    <h5 class="mb-0">{{ adminData.countPriceCallReq }}</h5>
                                                    <p class="fs--1 text-600 mb-0">درخواست قیمت</p>
                                                </div>
                                                <div class="col-4 border-end border-200">
                                                    <h4 class="fs-0 mb-0">{{ adminData.countBuyReq }}</h4>
                                                    <p class="fs--1 text-600 mb-0">خرید قطعه</p>
                                                </div>
                                                <div class="col-4 ">
                                                    <h4 class="fs-0 mb-0">{{ adminData.countSampleReq }}</h4>
                                                    <p class="fs--1 text-600 mb-0">تهیه نمونه</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <div
                v-if="$hasRole('repairman')"
                class="row g-3 mb-3">

                <div class="col-sm-6 col-md-4">
                    <div class="card overflow-hidden" style="min-width: 12rem">
                        <div class="bg-holder bg-card"
                             :style="{backgroundImage:'url('+asset('template/assets/img/icons/spot-illustrations/corner-1.png')+')'}"></div>
                        <div class="card-body position-relative" style="min-height: 130px">
                            <h6>کارهای در انتظار انجام</h6>
                            <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-warning">
                                {{ repairmanData.countTodoTask }}
                            </div>
                            <router-link v-if="repairmanData.countTodoTask!==0" to="/repairman-task"
                                         class="fw-semi-bold fs--1 text-nowrap">مشاهده همه
                                <span class="fas fa-angle-left align-middle ms-1" data-fa-transform="down-1"></span>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card overflow-hidden" style="min-width: 12rem">
                        <div class="bg-holder bg-card"
                             :style="{backgroundImage:'url('+asset('template/assets/img/icons/spot-illustrations/corner-2.png')+')'}"></div>
                        <div class="card-body position-relative" style="min-height: 130px">
                            <h6>کارهای در انتظار تایید یا رد </h6>
                            <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-warning">
                                {{ repairmanData.countDoneTask }}
                            </div>
                            <router-link v-if="repairmanData.countDoneTask!==0" to="/repairman-task"
                                         class="fw-semi-bold fs--1 text-nowrap">مشاهده همه
                                <span class="fas fa-angle-left align-middle ms-1" data-fa-transform="down-1"></span>
                            </router-link>
                        </div>
                    </div>
                </div>
                <br>
                <div class="col-md-4">
                    <div class="card overflow-hidden" style="min-width: 12rem">
                        <div class="bg-holder bg-card"
                             :style="{backgroundImage:'url('+asset('template/assets/img/icons/spot-illustrations/corner-1.png')+')'}"></div>
                        <div class="card-body position-relative" style="min-height: 130px">
                            <h6>کارهای رد شده </h6>
                            <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-warning">
                                {{ repairmanData.countRejectedTask }}
                            </div>
                            <router-link v-if="repairmanData.countRejectedTask!==0" to="/repairman-task"
                                         class="fw-semi-bold fs--1 text-nowrap">مشاهده همه
                                <span class="fas fa-angle-left align-middle ms-1" data-fa-transform="down-1"></span>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card overflow-hidden" style="min-width: 12rem">
                        <div class="bg-holder bg-card"
                             :style="{backgroundImage:'url('+asset('template/assets/img/icons/spot-illustrations/corner-3.png')+')'}"></div>
                        <div class="card-body position-relative" style="min-height: 130px">
                            <h6>کارهای تایید شده </h6>
                            <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-warning">
                                {{ repairmanData.countConfirmedTask }}
                            </div>
                            <router-link v-if="repairmanData.countConfirmedTask!==0" to="/repairman-task"
                                         class="fw-semi-bold fs--1 text-nowrap">مشاهده همه
                                <span class="fas fa-angle-left align-middle ms-1" data-fa-transform="down-1"></span>
                            </router-link>
                        </div>
                    </div>
                </div>

            </div>

            <div
                v-if="$hasRole('repair-shop-manager')" class="row g-3 mb-3">

                <div class="col-md-6 mt-0">
                    <div class="card overflow-hidden" style="min-width: 12rem">
                        <div class="bg-holder bg-card"
                             :style="{backgroundImage:'url('+asset('template/assets/img/icons/spot-illustrations/corner-1.png')+')'}"></div>
                        <div class="card-body position-relative" style="min-height: 130px">
                            <h6>سفارشات در انتظار بررسی</h6>
                            <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-warning">
                                {{ repairShopManagerData.orderNeedCheckCount }}
                            </div>
                            <router-link v-if="repairShopManagerData.orderNeedCheckCount!==0" to="/orders"
                                         class="fw-semi-bold fs--1 text-nowrap">مشاهده همه
                                <span class="fas fa-angle-left align-middle ms-1" data-fa-transform="down-1"></span>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="card col-md-6 mt-3 mt-md-0">
                    <div class="card-header d-flex flex-between-center">
                        <h6 class="mb-0 fs-1">کارها</h6>
                    </div>
                    <div class="card-body py-0">
                        <div class="row mb-2">
                            <div class="col-6 border-end border-200">
                                        <span class="mb-0 fs--1" style="color:black">{{
                                                convertMinutesToHourMinute(repairShopManagerData.countTaskSpendTime)
                                            }}</span>
                                <p class="fs--1 text-600 mb-0">مجموع زمان صرف شده</p>
                            </div>
                            <div class="col-3 border-end text-center border-200">
                                <h2 class="fs-0 mb-0">{{ repairShopManagerData.countRepairman }}</h2>
                                <p class="fs--1 text-600 mb-0">تعمیرکاران</p>
                            </div>
                            <div class="col-3 text-center">
                                <h4 class="fs-0 mb-0">{{ repairShopManagerData.countTotalTask }}</h4>
                                <p class="fs--1 text-600 mb-0">کل کارها</p>
                            </div>
                        </div>
                        <div class="overflow-visible progress mt-4 rounded-3 mb-3" style="height: 6px;">

                            <div v-show="!isNaN(repairShopManagerData.percentTaskTodo)"
                                 class="overflow-visible progress-bar bg-progress-gradient border-end border-white border-2 rounded-end rounded-pill"
                                 role="progressbar" :style="{width: repairShopManagerData.percentTaskTodo+'%'}"
                                 :aria-valuenow="repairShopManagerData.percentTaskTodo" aria-valuemin="0"
                                 aria-valuemax="100"><span
                                class="mt-n4 text-900 fw-bold">{{ repairShopManagerData.percentTaskTodo }}%</span></div>

                            <div v-show="!isNaN(repairShopManagerData.percentTaskDone)"
                                 class="overflow-visible progress-bar bg-warning border-end border-white border-2 rounded-end rounded-pill"
                                 role="progressbar" :style="{width: repairShopManagerData.percentTaskDone+'%'}"
                                 :aria-valuenow="repairShopManagerData.percentTaskDone" aria-valuemin="0"
                                 aria-valuemax="100"><span
                                class="mt-n4 text-900 fw-bold">{{ repairShopManagerData.percentTaskDone }}%</span></div>

                            <div v-show="!isNaN(repairShopManagerData.percentTaskConfirmed)"
                                 class="overflow-visible progress-bar bg-success border-end border-white border-2 rounded-end rounded-pill"
                                 role="progressbar" :style="{width: repairShopManagerData.percentTaskConfirmed+'%'}"
                                 :aria-valuenow="repairShopManagerData.percentTaskConfirmed" aria-valuemin="0"
                                 aria-valuemax="100"><span
                                class="mt-n4 text-900 fw-bold">{{ adminData.percentTaskConfirmed }}%</span>
                            </div>

                            <div v-show="!isNaN(repairShopManagerData.percentTaskRejected)"
                                 class="overflow-visible progress-bar bg-danger border-end border-white border-2 rounded-end rounded-pill"
                                 role="progressbar" :style="{width: repairShopManagerData.percentTaskRejected+'%'}"
                                 :aria-valuenow="repairShopManagerData.percentTaskRejected" aria-valuemin="0"
                                 aria-valuemax="100"><span
                                class="mt-n4 text-900 fw-bold">{{ repairShopManagerData.percentTaskRejected }}%</span></div>

                        </div>
                        <div class="d-flex justify-content-between px-2">
                            <h6>نوع </h6>
                            <h6>تعداد</h6>
                        </div>
                        <div class="d-flex flex-between-center rounded-3 bg-light py-2 px-3 mb-2">
                            <div>
                                <h6 class="mb-0">
                                        <span class="fas fa-circle fs--2 me-3 text-primary">
                                        </span>در انتظار انجام</h6>
                            </div>
                            <div class="fs--1 text-600 mb-0 fw-bold">{{ repairShopManagerData.countTodoTask }}</div>
                        </div>
                        <div class="d-flex flex-between-center rounded-3 bg-light py-2 px-3 mb-2">
                            <div>
                                <h6 class="mb-0">
                                        <span class="fas fa-circle fs--2 me-3 text-warning">
                                        </span>در انتظار تایید یا رد</h6>
                            </div>
                            <div class="fs--1 text-600 mb-0 fw-bold">{{ repairShopManagerData.countDoneTask }}</div>
                        </div>
                        <div class="d-flex flex-between-center rounded-3 bg-light py-2 px-3 mb-2">
                            <div>
                                <h6 class="mb-0">
                                        <span class="fas fa-circle fs--2 me-3 text-success">
                                        </span>تایید شده</h6>
                            </div>
                            <div class="fs--1 text-600 mb-0 fw-bold">{{ repairShopManagerData.countConfirmedTask }}</div>
                        </div>
                        <div class="d-flex flex-between-center rounded-3 bg-light py-2 px-3 mb-2">
                            <div>
                                <h6 class="mb-0">
                                        <span class="fas fa-circle fs--2 me-3 text-danger">
                                        </span>رد شده</h6>
                            </div>
                            <div class="fs--1 text-600 mb-0 fw-bold">{{ repairShopManagerData.countRejectedTask }}</div>
                        </div>

                    </div>
                    <div class="card-footer py-2">
                        <div class="fs--2 mt-0 fs--2">
                            <div class="row my-2">
                                <div class="col-4 border-end border-200">
                                    <h4 class="fs-0 mb-0">{{ repairShopManagerData.countRepairTask }}</h4>
                                    <p class="fs--2 text-600 mb-0">تعمیر دستگاه</p>
                                </div>
                                <div class="col-4 border-end border-200">
                                    <h4 class="fs-0 mb-0">{{ repairShopManagerData.countInitReviewTask }}</h4>
                                    <p class="fs--2 text-600 mb-0">بررسی اولیه</p>
                                </div>
                                <div class="col-4">
                                    <h4 class="fs-0 mb-0">{{ repairShopManagerData.countRepackTask }}</h4>
                                    <p class="fs--2 text-600 mb-0">آماده سازی برگشت</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <div
                v-if="$hasRole('receptionist')"
                class="row g-3 mb-3">
                <div class="col-sm-6 col-md-4">
                    <div class="card overflow-hidden" style="min-width: 12rem">
                        <div class="bg-holder bg-card"
                             :style="{backgroundImage:'url('+asset('template/assets/img/icons/spot-illustrations/corner-1.png')+')'}"></div>
                        <div class="card-body position-relative" style="min-height: 130px">
                            <h6>سفارشات در انتظار بررسی</h6>
                            <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-warning">
                                {{ receptionistData.orderNeedCheckCount }}
                            </div>
                            <router-link v-if="receptionistData.orderNeedCheckCount!==0" to="/orders"
                                         class="fw-semi-bold fs--1 text-nowrap">مشاهده همه
                                <span class="fas fa-angle-left align-middle ms-1" data-fa-transform="down-1"></span>
                            </router-link>
                        </div>
                    </div>
                </div>


            </div>

            <div
                v-if="$hasRole('commercial-manager')"
                class="row g-3 mb-3">
                <div class="col-sm-6 col-md-4">
                    <div class="card overflow-hidden" style="min-width: 12rem">
                        <div class="bg-holder bg-card"
                             :style="{backgroundImage:'url('+asset('template/assets/img/icons/spot-illustrations/corner-1.png')+')'}"></div>
                        <div class="card-body position-relative" style="min-height: 130px">
                            <h6>سفارشات در انتظار بررسی</h6>
                            <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-warning">
                                {{ commercialManagerData.orderNeedCheckCount }}
                            </div>
                            <router-link
                                v-if="commercialManagerData.orderNeedCheckCount!==0"
                                to="/orders" class="fw-semi-bold fs--1 text-nowrap">مشاهده همه
                                <span class="fas fa-angle-left align-middle ms-1" data-fa-transform="down-1"></span>
                            </router-link>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="card overflow-hidden" style="min-width: 12rem">
                        <div class="bg-holder bg-card"
                             :style="{backgroundImage:'url('+asset('template/assets/img/icons/spot-illustrations/corner-1.png')+')'}"></div>
                        <div class="card-body position-relative" style="min-height: 130px">
                            <h6>نیازمندی های در انتظار بررسی</h6>
                            <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-warning">
                                {{ commercialManagerData.requirementNeedCheckCount }}
                            </div>
                            <router-link
                                v-if="commercialManagerData.requirementNeedCheckCount!==0"
                                to="/requirement" class="fw-semi-bold fs--1 text-nowrap">مشاهده همه
                                <span class="fas fa-angle-left align-middle ms-1" data-fa-transform="down-1"></span>
                            </router-link>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>


</template>

<script>
export default {

    data() {
        return {
            isLoading: true,
            me: {
                full_name: '',
                role_name: '',
            },
            adminData: {

                countBuyReq: 0,
                countSampleReq: 0,
                countPriceCallReq: 0,

                countTotalTask: 0,
                countTaskSpendTime: 0,
                countDoneTask: 0,
                countConfirmedTask: 0,
                countRejectedTask: 0,
                countTodoTask: 0,

                countRepairTask: 0,
                countInitReviewTask: 0,
                countRepackTask: 0,

                percentTaskTodo: 0,
                percentTaskDone: 0,
                percentTaskConfirmed: 0,
                percentTaskRejected: 0,

                countOrderActive: 0,
                countOrderFinished: 0,
                countOrderRejected: 0,

                countStaff: 0,
                countRepairman: 0,
                countTotalPersons: 0,

                countInternalCageTotal: 0,
                countExternalCageTotal: 0,
                cageFilledCount: 0,
                cageTotalDeviceCount: 0,
                cageTotalCount: 0,
            },
            repairmanData: {
                countDoneTask: 0,
                countConfirmedTask: 0,
                countRejectedTask: 0,
                countTodoTask: 0,
            },

            receptionistData: {
                orderNeedCheckCount: 0,

            },
            repairShopManagerData: {
                orderNeedCheckCount: 0,
                countTotalTask: 0,
                countTaskSpendTime: 0,
                countDoneTask: 0,
                countConfirmedTask: 0,
                countRejectedTask: 0,
                countTodoTask: 0,
                countRepairman: 0,
                countRepairTask: 0,
                countInitReviewTask: 0,
                countRepackTask: 0,

                percentTaskTodo: 0,
                percentTaskDone: 0,
                percentTaskConfirmed: 0,
                percentTaskRejected: 0,

            },
            commercialManagerData: {
                orderNeedCheckCount: 0,
                requirementNeedCheckCount: 0,

            }
        }
    },
    methods: {
        getAdminDashboardData() {
            axios.get('api/admin-dashboard').then((data) => {
                // task
                this.adminData.countTotalTask = (data.data.total_task);
                this.adminData.countTodoTask = (data.data.task_todo_count);
                this.adminData.countDoneTask = (data.data.task_done_count);
                this.adminData.countConfirmedTask = (data.data.task_confirmed_count);
                this.adminData.countRejectedTask = (data.data.task_rejected_count);
                this.adminData.countRepairTask = (data.data.repair_task_count);
                this.adminData.countInitReviewTask = (data.data.init_review_task_count);
                this.adminData.countRepackTask = (data.data.repack_task_count);
                this.adminData.percentTaskTodo = this.getPercentage(this.adminData.countTodoTask, this.adminData.countTotalTask);
                this.adminData.percentTaskDone = this.getPercentage(this.adminData.countDoneTask, this.adminData.countTotalTask);
                this.adminData.percentTaskConfirmed = this.getPercentage(this.adminData.countConfirmedTask, this.adminData.countTotalTask);
                this.adminData.percentTaskRejected = this.getPercentage(this.adminData.countRejectedTask, this.adminData.countTotalTask);
                // req
                this.adminData.countBuyReq = (data.data.buy_request_requirement);
                this.adminData.countSampleReq = (data.data.sample_request_requirement);
                this.adminData.countPriceCallReq = (data.data.price_call_requirement);
                // order
                this.adminData.countOrderActive = (data.data.order_active_count);
                this.adminData.countOrderFinished = (data.data.order_finished_count);
                this.adminData.countOrderRejected = (data.data.order_rejected_count);
                this.adminData.countTaskSpendTime = parseInt(data.data.total_task_spend_time);
                // staff
                this.adminData.countStaff = (data.data.staff_count);
                this.adminData.countRepairman = (data.data.repairman_count);
                this.adminData.countTotalPersons = (data.data.total_persons_count);
                // cage
                this.adminData.countExternalCageTotal = (data.data.external_cage_total);
                this.adminData.countInternalCageTotal = (data.data.internal_cage_total);
                this.adminData.cageFilledCount = (data.data.cage_filled_count);
                this.adminData.cageTotalDeviceCount = (data.data.cage_total_device_count);
                this.adminData.cageTotalCount = (data.data.cage_total_count);
                this.isLoading = false;
            });
        },
        getRepairmanDashboardData() {
            axios.get('api/repairman-dashboard').then((data) => {
                this.repairmanData.countTodoTask = (data.data.task_todo_count);
                this.repairmanData.countDoneTask = (data.data.task_done_count);
                this.repairmanData.countConfirmedTask = (data.data.task_confirmed_count);
                this.repairmanData.countRejectedTask = (data.data.task_rejected_count);
                this.isLoading = false;
            });
        },
        getReceptionistDashboardData() {
            axios.get('api/receptionist-dashboard').then((data) => {
                this.receptionistData.orderNeedCheckCount = (data.data.order_need_check_count);
                this.isLoading = false;
            });
        },
        getRepairShopManagerDashboardData() {
            axios.get('api/repair-shop-manager-dashboard').then((data) => {
                this.repairShopManagerData.orderNeedCheckCount = (data.data.order_need_check_count);
                this.repairShopManagerData.countTotalTask = (data.data.total_task);
                this.repairShopManagerData.countTodoTask = (data.data.task_todo_count);
                this.repairShopManagerData.countDoneTask = (data.data.task_done_count);
                this.repairShopManagerData.countConfirmedTask = (data.data.task_confirmed_count);
                this.repairShopManagerData.countRejectedTask = (data.data.task_rejected_count);

                this.repairShopManagerData.countRepairTask = (data.data.repair_task_count);
                this.repairShopManagerData.countInitReviewTask = (data.data.init_review_task_count);
                this.repairShopManagerData.countRepackTask = (data.data.repack_task_count);

                this.repairShopManagerData.percentTaskTodo = this.getPercentage(this.repairShopManagerData.countTodoTask, this.repairShopManagerData.countTotalTask);
                this.repairShopManagerData.percentTaskDone = this.getPercentage(this.repairShopManagerData.countDoneTask, this.repairShopManagerData.countTotalTask);
                this.repairShopManagerData.percentTaskConfirmed = this.getPercentage(this.repairShopManagerData.countConfirmedTask, this.repairShopManagerData.countTotalTask);
                this.repairShopManagerData.percentTaskRejected = this.getPercentage(this.repairShopManagerData.countRejectedTask, this.repairShopManagerData.countTotalTask);

                this.repairShopManagerData.countRepairman = (data.data.repairman_count);



                this.isLoading = false;
            });
        },
        getCommercialManagerDashboardData() {
            axios.get('api/commercial-manager-dashboard').then((data) => {
                this.commercialManagerData.orderNeedCheckCount = (data.data.order_need_check_count);
                this.commercialManagerData.requirementNeedCheckCount = (data.data.requirement_need_count);
                this.isLoading = false;
            });
        },
        getMe() {
            axios.get('api/me').then((data) => {
                this.me = data.data;
                this.isLoading = false;
            });
        },


    },
    mounted() {
        this.$Progress.finish();
    },
    created() {
        this.getMe();
        this.$Progress.start()
        if (this.$hasRole('admin')) {
            this.getAdminDashboardData();
        }
        if (this.$hasRole('repairman')) {
            this.getRepairmanDashboardData();
        }
        if (this.$hasRole('repair-shop-manager')) {
            this.getRepairShopManagerDashboardData();
        }
        if (this.$hasRole('commercial-manager')) {
            this.getCommercialManagerDashboardData();
        }
        if (this.$hasRole('receptionist')) {
            this.getReceptionistDashboardData();
        }
    }
}
</script>
