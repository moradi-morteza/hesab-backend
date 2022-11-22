<template>
    <div>
        <div  class="p-3 fs--1 " role="alert">
            <span>{{trans('app.empty_message')}}</span><br>
        </div>
    </div>
</template>

<script>
    export default {
        name: "EmptyMessage",
        props: ['message']
    }
</script>

<style scoped>

</style>
