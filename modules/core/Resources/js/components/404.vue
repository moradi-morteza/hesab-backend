<template>

                <div class="card text-center" style="min-height:600px">
                    <div class="card-body p-4 p-sm-5">
                        <div class="fw-black lh-1 text-300 fs-error">404</div>
                        <p class="lead mt-4 text-800 font-sans-serif fw-semi-bold w-75 w-xl-100 mx-auto">صفحه درخواستی شما پیدا نشد.</p>
                        <hr>
                        <p>مطمئن شوید که آدرس وارد شده صحیح است و دوباره اقدام کنید.</p><a class="btn btn-primary btn-sm mt-3" href="/home"><span class="fas fa-home me-2"></span>برگشت به داشبورد</a>
                    </div>
                </div>



</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
