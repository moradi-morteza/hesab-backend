<template>

    <div class="card" style="min-height:600px">
        <div class="card-header border-bottom">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0 fw-bold">تنظیمات سیستم</h5>
                </div>
                <div class="col-auto">
                    <button
                        @click="updateSetting"
                        :disabled="standBy"
                        class="btn btn-success mb-1 ">
                        <span class="fas fa-check align-middle"></span>
                        <span>بروزرسانی</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div v-if="isLoading" class="spinner-border d-block text-primary mx-auto m-3" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <transition name="slide-fade">
                <div style="overflow: hidden" v-show="!isLoading">
                    <div class="row mx-2">

                        <div class="col-md-6">
                            <h5>قالب ها</h5>
                            <div class="mt-3">
                                <label class="form-label">
                                    لیبل
                                </label><br>
                                <p class="fs--2">لیبلی که روی دستگاه زده می شود را از این قسمت ویرایش کنید.</p>
                                <a href="designer?name=label" class="btn btn-outline-primary btn-sm">ویرایش لیبل</a>
                            </div>

                            <div class="mt-3">
                                <label class="form-label">
                                    رسید مشتری
                                </label><br>
                                <p class="fs--2">رسیدی که به مشتری تحویل می دهید را از این قسمت ویرایش کنید.</p>
                                <a href="designer?name=recipe" class="btn btn-outline-primary btn-sm">ویرایش رسید</a>
                            </div>

                            <div class="mt-3">
                                <label class="form-label">
                                    فاکتور رسمی
                                </label><br>
                                <p class="fs--2">فرمت پیش فاکتور و فاکتور اصلی را از این قسمت ویرایش کنید.</p>
                                <a href="designer?name=formalFactor" class="btn btn-outline-primary btn-sm">ویرایش فاکتور</a>
                                <a href="designer?name=formalPreFactor" class="btn btn-outline-primary btn-sm">ویرایش پیش فاکتور</a>
                            </div>

                            <div class="mt-3">
                                <label class="form-label">
                                    فاکتور غیر رسمی
                                </label><br>
                                <p class="fs--2">فرمت پیش فاکتور و فاکتور غیر رسمی را از این قسمت ویرایش کنید.</p>
                                <a href="designer?name=informalFactor" class="btn btn-outline-primary btn-sm">ویرایش فاکتور</a>
                                <a href="designer?name=informalPreFactor" class="btn btn-outline-primary btn-sm">ویرایش پیش فاکتور</a>
                            </div>




                        </div>
                        <div class="col-md-6">

                            <div>
                                <label class="form-label">
                                    نام فونت های فارسی
                                </label>
                                <textarea v-model="stimulsoft_custom_fonts" class="form-control ltr fs--1" rows="4"/>
                                <a href="#" @click="showStimulsoftFontHelp" class="fs--2 d-inline">مشاهده راهنمای نام</a>
                            </div>
                        </div>

                    </div>
                </div>
            </transition>
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
            ref="fontNameHelpBottomSheet">
            <div class="container-fluid">
                <div class="px-4 mx-2 align-content-center align-center">
                    <h5 class="fw-bold">
                        مشاهده راهنمای نام فونت
                    </h5>

                    <p class="fs--1 mb-0 mt-2">
                        <span>نام فونت های فارسی که در طراحی فاکتور، رسید و یا لیبل استفاده شده را در این قسمت وارد کنید، این فونت ها باید در سیستم شما وجود داشته باشند تا قابل استفاده باشند.</span>
                        <span class="fs--1 red">نام ها را بصورت انگلیسی وارد کنید و با کاما جدا کنید. ابتدا فونت ها را در ویندوز خود وارد کنید و سپس نام آنها را مطابق تصویر راهنما در این قسمت اضافه کنید.</span>
                    </p>
                    <img class="w-75 border shadow-sm rounded m-3" :src="asset('stimulsoft/help/stimulsoft-font-help.png')">

                </div>
            </div>
        </vue-bottom-sheet>
    </div>

</template>

<script>
export default {
    data() {
        return {
            isLoading: true,
            standBy: false,
            form:new Form({
                settings: []
            })
        }
    },
    methods: {
        showStimulsoftFontHelp() {
            this.$refs.fontNameHelpBottomSheet.open();
        },
        getSettings() {
            this.isLoading = true;
            this.$Progress.start();
            axios.get('api/settings').then((response) => {
                // this is where status is 200
                this.form.settings = response.data;
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
    updateSetting(){
        this.standBy=true;
        this.$Progress.start();
        this.form.put('api/settings').then((response) => {
            this.standBy=false;
            let msg = response.data.msg;
            Toast.fire({icon: 'success', title: msg});
            this.$Progress.finish();
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
    }

    }, created() {
        this.getSettings();
    },
    computed: {
        stimulsoft_custom_fonts: {
            get: function() {
                var data = this.form.settings.find(item => item.key === "stimulsoft_custom_fonts");
                if (data) {
                    return data.value;
                } else {
                    return null;
                }
            },
            set: function(newValue) {
                const index = this.form.settings.findIndex(object => {
                    return object.key === 'stimulsoft_custom_fonts';
                });
                if (index !== -1) {
                    this.form.settings[index].value = newValue;
                }
            }
        }
    }
}
</script>
