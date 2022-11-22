<template>
    <div class="mx-2">


        <div v-if="tempAttachments.length > 0">
            <div  v-for="tempAttachment in tempAttachments" :key="tempAttachment._id"
                 class="dropdown mt-2 font-sans-serif d-inline-block mb-2">
                <button style="min-width: 180px" class="btn m-2 btn-falcon-default p-0 dropdown-toggle"
                        type="button"
                        data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                    <div class="d-flex justify-content-between p-2">
                        <span style="color: dimgray" class="fs--2 ltr"> {{ tempAttachment.size |byteToSize }} </span>
                        <strong class=" fs--1 ltr">{{ tempAttachment.title |truncateText(14,'...') }}</strong>
                    </div>
                    <div class="progress  ltr rounded-0" style="height:15px">
                        <div class="progress-bar bg-success progress-bar-striped" role="progressbar" v-bind:style="{width: `${tempAttachment.progress}%`}" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">{{ `${tempAttachment.progress} %` }}</div>
                    </div>
                </button>

                <div class="dropdown-menu p-0"
                     aria-labelledby="dropdownMenuButton">
<!--                    <a class="dropdown-item" v-on:click="showAttachment(tempAttachment)">مشاهده</a>-->
                    <a class="dropdown-item" v-on:click="deleteAttachment(tempAttachment)">حذف</a>
                </div>
            </div>

        </div>

    </div>
</template>

<script>
export default {
    name: "AttachmentList",
    methods: {
        checkProgress(attachment) {
            return attachment.progress === null ? false : true;
        },
        showAttachment(attachment){
        },
        deleteAttachment(attachment){

            if(this.editmode){




            }else{
                var index = this.tempAttachments.findIndex(x => x._id === attachment._id);
                this.tempAttachments.splice(index, 1);
            }


            // Swal.fire({
            //     showClass: {popup: ''}, hideClass: {popup: ''},
            //     title: trans('app.title_delete'),
            //     text: trans('app.des_delete'),
            //     icon: 'warning',
            //     showCancelButton: true,
            //     confirmButtonColor: '#3085d6',
            //     cancelButtonColor: '#d33',
            //     confirmButtonText: trans('app.yes'),
            //     cancelButtonText: trans('app.cancel'),
            // }).then((result) => {
            //     if (result.value) {
            //         this.$Progress.start();
            //         this.form.delete('api/attachment/' + id)
            //             .then((response) => {
            //                 // this is where status is 200
            //                 let msg = response.data.msg;
            //                 Toast.fire({icon: 'success', title: msg});
            //                 this.$Progress.finish();
            //                 removeItemFromListById(id, this.form.attachments);
            //             }).catch((error) => {
            //             let msg = error.response.data.msg;
            //             if (msg == null) {
            //                 msg = trans('app.failed');
            //             }
            //             Toast.fire({icon: 'error', title: msg});
            //             this.$Progress.fail();
            //         });
            //     }
            // })
        },
    },
    props: {
        tempAttachments: {
            type: Array
        },
        editmode: {
            type: Boolean
        },
    }
};
</script>

<style>
.attachment-zone ul {
    display: flex;
    flex-wrap: wrap;
    list-style: none;
    margin-top: 15px !important;
    padding: 0px;
}


.file-name {
    min-width: 150px;
    font-size: 13px;
}

.uploaded-date {
    font-size: 12px;
}

.upload-progress {
    font-size: 12px;
}

.file-info {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}
</style>
