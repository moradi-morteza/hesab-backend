window.Vue = require('vue').default;
Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');

// below attribute create in falcon-app.blade.php
Vue.prototype.site_lang = site_lang // it return like en, fa-AF, fa-IR, ar
Vue.prototype.site_url = site_url
Vue.prototype.site_direction = site_direction

// laravel translation to Javascript and Vuejs https://medium.com/@serhii.matrunchyk/using-laravel-localization-with-javascript-and-vuejs-23064d0c210e
window.trans = (string) => _.get(window.i18n, string);
Vue.prototype.trans = string => _.get(window.i18n, string);

// VueRouter -----------------------------------------------------------------------------------------------------------
import VueRouter from 'vue-router'

Vue.use(VueRouter)
let routes = [

    {path: '*', component: require('../../modules/core/Resources/js/components/404').default},
    {path: '/', component: require('../../modules/core/Resources/js/components/app/home.vue').default},
    {path: '/test-vue', component: require('./components/develop/test-vue.vue').default},

];

// add modules route to routes variable
import {appModulesRoutes} from '../../modules/core/Resources/js/app'
import {adminModulesRoutes} from '../../modules/core/Resources/js/admin'
// import {orderModulesRoutes} from '../../modules/order/Resources/js/app'
// import {repairManModulesRoutes} from '../../modules/repairman/Resources/js/app'
// import {storeModulesRoutes} from "../../modules/store/Resources/js/app";
// import {requirementModulesRoutes} from "../../modules/requirement/Resources/js/app";

routes = routes.concat(appModulesRoutes);
routes = routes.concat(adminModulesRoutes);
// routes = routes.concat(orderModulesRoutes);
// routes = routes.concat(storeModulesRoutes);
// routes = routes.concat(repairManModulesRoutes);
// routes = routes.concat(requirementModulesRoutes);

const router = new VueRouter(
    {
        mode: 'history',
        routes
    }
);

// Vform  --------------------------------------------------------------------------------------------------------------
import {Form, HasError, AlertError} from 'vform'

window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

// Vue Progress bar ----------------------------------------------------------------------------------------------------
import VueProgressBar from 'vue-progressbar';

Vue.use(VueProgressBar, {
    color: 'rgb(46,217,57)',
    failedColor: 'red',
    thickness: '6px'
});

// Vue Permission ------------------------------------------------------------------------------------------------------
/*
 * combine ideas :
 * https://github.com/ahmedsaoud31/laravel-permission-to-vuejs
 * https://mmccaff.github.io/2018/11/03/laravel-permissions-in-vue-components/
 */
// import Permissions from './mixins/permissions';
// Vue.mixin(Permissions);

// access laravel asset from vuejs
import asset from './mixins/asset';
Vue.mixin(asset);

// requirement usefull functions
import helper from './mixins/helper';
Vue.mixin(helper);


// Vue Tag Input ---------------------------------------------------------------------------------------------------
import VoerroTagsInput from '@voerro/vue-tagsinput';
Vue.component('tags-input', VoerroTagsInput);

// Vue VueBottomSheet---------------------------------------------------------------------------------------------------
import VueBottomSheet from "@webzlodimir/vue-bottom-sheet";

Vue.use(VueBottomSheet);

// Useful Components ---------------------------------------------------------------------------------------------------
Vue.component('EmptyMessage', require('./components/emptyMessage').default);
Vue.component('dateFilter', require('./components/dateFilter').default);

// Smart Table Methods * created by morteza moradi
const SmartTable = {
    install(Vue, options) {
        // below function just can use in v- attributes
        Vue.prototype.sortStringAsc = function (property, list) {
            list.sort((a, b) => {
                if (typeof a[property[0]] == 'object')
                    return (a[property[0]][property[1]] == null) ? -1 : ((b[property[0]][property[1]] == null) ? 1 : a[property[0]][property[1]].localeCompare(b[property[0]][property[1]]));
                else
                    return (a[property] == null) ? -1 : ((b[property] == null) ? 1 : a[property].localeCompare(b[property]));
            })
        }
        Vue.prototype.sortStringDesc = function (property, list) {
            list.sort((a, b) => {
                if (typeof a[property[0]] == 'object')
                    return (b[property[0]][property[1]] == null) ? -1 : ((a[property[0]][property[1]] == null) ? 1 : b[property[0]][property[1]].localeCompare(a[property[0]][property[1]]));
                else
                    return (b[property] == null) ? -1 : ((a[property] == null) ? 1 : b[property].localeCompare(a[property]));
            })
        }
        Vue.prototype.sortNumberAsc = function (property, list) {
            list.sort((a, b) => {
                if (typeof a[property[0]] == 'object')
                    return (a[property[0]][property[1]] == null) ? -1 : ((b[property[0]][property[1]] == null) ? 1 : a[property[0]][property[1]] - b[property[0]][property[1]]);
                else
                    return (a[property] == null) ? -1 : ((b[property] == null) ? 1 : a[property] - b[property]);
            });
        }
        Vue.prototype.sortNumberDesc = function (property, list) {
            list.sort((a, b) => {
                if (typeof a[property[0]] == 'object')
                    return (b[property[0]][property[1]] == null) ? -1 : ((a[property[0]][property[1]] == null) ? 1 : b[property[0]][property[1]] - a[property[0]][property[1]]);
                else
                    return (b[property] == null) ? -1 : ((a[property] == null) ? 1 : b[property] - a[property]);
            });
        }
        Vue.prototype.sort = function (property, type, event, list) {
            var status = event.currentTarget.getAttribute("data-status")

            document.querySelectorAll(".sortable").forEach(function (item) {
                item.setAttribute("data-status", "up")
            })
            document.querySelectorAll(".sortable").forEach(function (item) {
                item.children[0].classList.add('fa-angle-up')
            })
            if (type === 'string') {
                if (status === 'up') {
                    this.sortStringAsc(property, list);
                    event.currentTarget.setAttribute("data-status", "down")
                    event.currentTarget.children[0].classList.add('fa-angle-down')
                } else {
                    this.sortStringDesc(property, list);
                    event.currentTarget.setAttribute("data-status", "up")
                    event.currentTarget.children[0].classList.add('fa-angle-up')
                }
            }
            if (type === 'number') {
                if (status === 'up') {
                    this.sortNumberAsc(property, list)
                    event.currentTarget.setAttribute("data-status", "down")
                    event.currentTarget.children[0].classList.add('fa-angle-down')
                } else {
                    this.sortNumberDesc(property, list)
                    event.currentTarget.setAttribute("data-status", "up")
                    event.currentTarget.children[0].classList.add('fa-angle-up')
                }
            }
        }

        // below function can use global
        window.addItemToList = function (object, list) {
            list.splice(0, 0, object);
        }
        window.updateItemInListByObject = function (object, list) {
            let foundIndex = list.findIndex(x => x.id == object.id);
            list.splice(foundIndex, 1, object);
        }
        window.updateItemsInListByIds = function (objects, list) {
            objects.forEach(object => {
                let foundIndex = list.findIndex(x => x.id == object.id);
                list.splice(foundIndex, 1, object);
            })
        }
        window.removeItemFromListById = function (id, list) {
            var index = list.findIndex(x => x.id === id);
            list.splice(index, 1);
        }


    },
}
Vue.use(SmartTable)
import smartTableFunctions from './mixins/smartTable';

Vue.mixin(smartTableFunctions);

// Filters -------------------------------------------------------------------------------------------------------------
Vue.filter('upText', function (text) {
    return text.charAt(0).toUpperCase() + text.slice(1)
});
Vue.filter('myData', function (date) {
    return moment(date).format('MMMM Do YYYY');
});
Vue.filter('checkNull', function (data, replace_char) {
    if (data === undefined || data == null) {
        return replace_char;
    }
    return data;
});
Vue.filter('byteToSize', function (bytes) {
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (bytes === 0) return '0 Byte';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
});
Vue.filter('dimentionPersion', function (dimention) {
    if (dimention === 'small') {
        return 'کوچک';
    }
    if (dimention === 'medium') {
        return 'متوسط';
    }
    if (dimention === 'large') {
        return 'بزرگ';
    }
    if (dimention === 'xlarge') {
        return 'بسیار بزرگ';
    }
});
Vue.filter('seperate3point', function (num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
});
Vue.filter('truncateText', function (text, length, clamp) {
    clamp = clamp || '...';
    var node = document.createElement('div');
    node.innerHTML = text;
    var content = node.textContent;
    return content.length > length ? content.slice(0, length) + clamp : content;
});

// order Status Help
// Vue.component('orderStatusHelp', require('./components/orderStatusHelp').default);
// Vue.component('requirementInOrder', require('./../../modules/requirement/Resources/js/components/requirement/inside_order_index').default);
// Vue.component('repairmanReportInOrder', require('./../../modules/repairman/Resources/js/components/repairman-report/inside_order_index').default);
// Vue.component('repairmanTaskInOrder', require('./../../modules/repairman/Resources/js/components/repairman-task/inside_order_index').default);
// Vue.component('repairmanMistakeInTask', require('./../../modules/repairman/Resources/js/components/repairman-mistake/inside_task_index').default);

// Vue Cropper ---------------------------------------------------------------------------------------------------------
import '@babel/polyfill'; // es6 shim
import myUpload from './components/vuejsCropper/uploadVuejs';

Vue.component('myUpload', myUpload);

import VueSimpleSuggest from 'vue-simple-suggest'

Vue.component('vue-simple-suggest', VueSimpleSuggest)

const app = new Vue({
    el: '#app',
    router,
});
