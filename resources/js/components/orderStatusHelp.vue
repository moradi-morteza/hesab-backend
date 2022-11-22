<template>
    <div>
        <div v-if="order_status && order_status.id===3"  class="p-1 fs--1 " role="alert">

            <span class="fw-bold">{{order_status.name}}</span><br><br>
            <ul>
                <li>
                    در این وضعیت تعمیرکار باید دستگاه را بررسی کنید تا مسئول کارگاه بتواند هزینه تعمیر را برآورد کند.
                </li>
                <li class="blue">
                    تعمیرکار در صورت نیاز میتواند از طریق قسمت (ثبت نیازمندی) مواردی که برای تعمیر نیاز است را مشخص کند، تا برای تعیین هزینه تعمیر استفاده شود.
                </li>
                <li class="red">
                    تعمیرکار باید از طریق قسمت (ثبت گزارش) ، نتیجه بررسی خود را ثبت کند.
                </li>
                <li v-if="$hasRole('repairman')">
                    در پایان بررسی اولیه، تعمیرکار باید روی گزینه (پایان بررسی) کلیک کند.
                </li>
            </ul>

        </div>
        <div v-if="order_status && order_status.id===4"  class="p-1 fs--1 " role="alert">

            <span class="fw-bold">{{order_status.name}}</span><br><br>
            <ul>
                <li>
                    در این وضعیت مسئول کارگاه باید با توجه به گزارش بررسی اولیه تعمیرکاران و همچنین نیازمندی هایی که برای سفارش ثبت شده، قیمت اولیه پیش فاکتور را محاسبه و صادر کند.
                </li>

            </ul>

        </div>
        <div v-if="order_status && order_status.id===5"  class="p-1 fs--1 " role="alert">

            <span class="fw-bold">{{order_status.name}}</span><br><br>
            <ul>
                <li>
                    در این وضعیت مسئول بازرگانی باید با توجه به هزینه اولیه تعمیر که توسط مسئول کارگاه اعلام شده است، قیمت نهایی تعمیر را برای ارسال فاکتور به مشتری تعیین کند.
                </li>

            </ul>

        </div>
        <div v-if="order_status && order_status.id===6"  class="p-1 fs--1 " role="alert">

            <span class="fw-bold">{{order_status.name}}</span><br><br>
            <ul>
                <li>
                    در این مرحله مسئول بازرگانی باید هزینه تعمیر را به اطلاع مشتری برساند، جواب مشتری را دریافت کرده و وضعیت سفارش را مشخص کند.
                </li>

            </ul>

        </div>
        <div v-if="order_status && order_status.id===9"  class="p-1 fs--1 " role="alert">

            <span class="fw-bold">{{order_status.name}}</span><br><br>
            <ul>
                <li>
                    در این مرحله مسئول کارگاه باید تعمیر انجام شده توسط تعمیرکار را تایید یا رد کند. در قسمت کارها باید وارد کار از نوع (تعمیر دستگاه) شود و گزارش تعمیر را خوانده و دستگاه را از نظر صحت کارکرد و رفع مشکل بررسی شود.
                </li>
                <li>
                    در صورتی که تعمیر به درستی انجام نشده باید در قسمت کارها، یک گزارش خطا برای تعمیرکار ثبت کند و روی گزینه (عدم تایید) کلیک شود.
                </li>
                <li>
                    در صورتی که تعمیر به درستی انجام شده روی گزینه (تایید و پایان تعمیر) کلیک شود.
                </li>

            </ul>

        </div>
        <div v-if="order_status && order_status.id===13"  class="p-1 fs--1 " role="alert">

            <span class="fw-bold">{{order_status.name}}</span><br><br>
            <ul>
                <li>
                   در این مرحله مسئول کارگاه باید تسکی برای تعمیرکار دستگاه ایجاد کند تا دستگاه آماده بازگشت به مشتری شود.
                </li>
                <li>
                    بعد از آنکه تسک مورد نظر انجام شد مسئول کارگاه باید روی گزینه (پایان آماده سازی بازگشت) کلیک کند.
                </li>


            </ul>

        </div>
        <div v-if="order_status && order_status.id===14"  class="p-1 fs--1 " role="alert">

            <span class="fw-bold">{{order_status.name}}</span><br><br>
            <ul>
                <li>
                  در این مرحله دستگاه برای برگشت به مشتری آماده است و مسئول بازرگانی باید تایید نهایی را انجام دهد.
                </li>
                <li>
                    مسئول بازرگانی باید روی گزینه (تایید نهایی لغو تعمیر) کلیک کند.
                </li>


            </ul>

        </div>
    </div>
</template>

<script>
export default {
    name: "orderStatusHelp",
    props: ['order_status','role'],
    created() {

    }
}
</script>

<style scoped>

</style>
