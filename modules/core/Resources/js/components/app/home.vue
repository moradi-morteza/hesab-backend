<template>

    <div>

        <div v-if="isLoading" class="spinner-border d-block text-primary mx-auto m-3" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div v-if="!isLoading">
            Home
        </div>

    </div>


</template>

<script>
export default {

    data() {
        return {
            isLoading: true,
        }
    },
    methods: {
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
    }
}
</script>
