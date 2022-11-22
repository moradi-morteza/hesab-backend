module.exports = {
    methods: {
        dialog(_title, _des, _icon, _callback) {
            Swal.fire({
                showClass: {popup: ''}, hideClass: {popup: ''},
                title: _title,
                text: _des,
                icon: _icon,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: trans('app.yes'),
                cancelButtonText: trans('app.cancel'),
            }).then((result) => {
                if (result.value) {
                    _callback()
                }
            })
        },
        sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        },
        randomSoftBadge() {
            var array = [
                'badge-soft-primary',
                'badge-soft-secondary',
                'badge-soft-success',
                'badge-soft-info',
                'badge-soft-warning',
                'badge-soft-danger',
                'badge-soft-dark',
            ];
            return array[Math.floor(Math.random() * array.length)];
        },
        randomBadge() {
            var array = [
                'bg-primary',
                'bg-secondary',
                'bg-success',
                'bg-info',
                'bg-warning',
                'bg-danger',
                'bg-dark',
            ];
            return array[Math.floor(Math.random() * array.length)];
        },
        toPersianAll(string) {
            if (string === 'all') {
                return "همه";
            }
        },
        convertMinutesToHourMinute(num) {
            var hours = (num / 60);
            var rhours = Math.floor(hours);
            var minutes = (hours - rhours) * 60;
            var rminutes = Math.round(minutes);
            return rhours + " ساعت و " + rminutes + " دقیقه";
        },getPercentage(number,total){
            return Math.round((parseInt(number)*100)/parseInt(total));
        }
    }
}
