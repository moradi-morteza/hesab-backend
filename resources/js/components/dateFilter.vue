<template>

    <div>
        <div class="input-group">
            <span class="input-group-text">{{ title}}</span>
            <span class="input-group-text">از</span>
            <input v-model="fromInputValue" class="form-control" id="fromInput"  type="text">
            <span class="input-group-text">تا</span>
            <input v-model="toInputValue" :disabled="fromInputValue===''" class="form-control" id="toInput" type="text">
            <button @click="resetDate()" class="btn btn-outline-secondary">
                <span class="fas fa-redo-alt align-middle"></span>
            </button>
        </div>
    </div>

</template>
<script>
export default {
    props: {
        title: { required: true, type: String },
        filterKey: { required: true, type: String },
        done: { default: false, type: Boolean }
    },
    data(){
        return {
            fromInput:'',
            toInput:'',

            fromInputValue:'',
            toInputValue: '',

            fromInputUnixValue:'',
            toInputUnixValue: '',

        }
    },
    mounted() {

        this.toInput = $('#toInput').persianDatepicker({
            calendarType: ('persian'),
            initialValue: false,
            autoClose: true,
            format: 'YYYY/MM/DD',
            calendar: {persian: {locale: 'fa'}},
            observer: true,
            inputDelay: 0,
            toolbox: {
                enabled: true,
                calendarSwitch: {
                    enabled: false,
                },
            },
            dayPicker: {
                enabled: true,
                selectedDayUnix: 'YYYY/MM/DD',
                onSelect:  (unix, element) =>{

                    this.toInputValue = new persianDate(unix).format('YYYY/MM/DD')
                    this.toInputUnixValue = unix
                    this.$emit('dateSelected',this.filterKey, this.fromInputUnixValue,this.toInputUnixValue)

                }
            },
        });
        this.fromInput = $('#fromInput').persianDatepicker({
            calendarType: ('persian'),
            initialValue: false,
            autoClose: true,
            format: 'YYYY/MM/DD',
            calendar: {persian: {locale: 'fa'}},
            observer: true,
            inputDelay: 0,
            toolbox: {
                enabled: true,
                calendarSwitch: {
                    enabled: false,
                },
            },
            dayPicker: {
                enabled: true,
                selectedDayUnix: 'YYYY/MM/DD',
                onSelect:  (unix, element) =>{
                    this.fromInputValue =  new persianDate(unix).format('YYYY/MM/DD');
                    this.fromInputUnixValue = unix
                    this.fromInput.touched = true;

                    if (this.toInputValue!==''){
                        this.toInputUnixValue = 0
                        this.toInputValue = ""
                    }

                    // disable before from date
                    if (this.toInput && this.toInput.options && this.toInput.options.minDate !== unix) {
                        var cachedValue = this.toInput.getState().selected.unixDate;
                        this.toInput.options = {minDate: unix};
                        if (this.toInput.touched) {
                            this.toInput.setDate(cachedValue);
                        }
                    }
                }
            },
        });
    },
    methods: {
        resetDate(){
            this.toInputUnixValue = 0
            this.toInputValue = ""

            this.fromInputUnixValue = 0
            this.fromInputValue = ""
            this.$emit('resetDate',this.filterKey)
        }
    }
};
</script>
