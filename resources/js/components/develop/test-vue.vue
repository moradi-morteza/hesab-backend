<template>
    <div class="card p-3" style="min-height: 600px">
            <vue-simple-suggest
                ref="suggest"
                v-model="query"
                :list="getSuggestionList"
                display-attribute="data"
                :styles="autoCompleteStyle"
                :destyled=true
                :debounce="400"
                @suggestion-click="onSuggestClick"
                @select="onSuggestSelect">
            </vue-simple-suggest>
    </div>
</template>

<script>

export default {
    data: function () {
        return {
            query: '',
            autoCompleteStyle : {
                vueSimpleSuggest: "position-relative",
                inputWrapper: "",
                defaultInput : "form-control",
                // suggestions: "position-absolute list-group z-1000",
                suggestItem: "list-group-item"
            }
        }
    },
    methods:{
        onSuggestClick(suggest, e){
            // this.$refs.suggest.setText("hello")
            console.log('clicked')
            this.query = "hello";
        },
        onSuggestSelect(suggest){
            // this.$refs.suggest.setText("hello")
            console.log('selected')
            this.query = "hello"
        },
        getSuggestionList(query) {
            return new Promise((resolve, reject) => {
                let url = site_url + '/api/search_customer_by_name?query=' + query;
                axios.get(url)
                    .then((data) => {
                        var json = data.data;
                        json.forEach(function (item){
                            item['data'] = item.mobile +' '+ item.name + ' '+ item.family;
                        });
                        resolve(json)
                    }).catch(function (error) {reject(error)});
            })
        }


    },
    mounted() {
    },
    created () {
    },
}
</script>


<style>
.hover {
    cursor: pointer;
    background-color: #007bff;
    color: #fff;
}

</style>
