<template>

    <div class="card" style="min-height:600px">
        <div class="card-header border-bottom">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0 fw-bold">تنظیمات سیستم</h5>
                </div>
                <div class="col-auto">
                    <button
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


                    </div>
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
            standBy: false,
        }
    },
    methods: {},
    created() {
        this.isLoading = false
    },
    computed: {}
}
</script>
