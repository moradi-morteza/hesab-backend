require('./bootstrap');

// Bootstrap Select ----------------------------------------------------------------------------------------------------
require('../../node_modules/bootstrap-select/dist/js/bootstrap-select');

// SweetAlert  ---------------------------------------------------------------------------------------------------------
import Swal from 'sweetalert2'
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-start',
    showConfirmButton: false,
    timer: 1500,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
    },
});
window.Toast = Toast;

// global functions and parameter
window.persianNumbers = [/۰/g, /۱/g, /۲/g, /۳/g, /۴/g, /۵/g, /۶/g, /۷/g, /۸/g, /۹/g];
window.arabicNumbers = [/٠/g, /١/g, /٢/g, /٣/g, /٤/g, /٥/g, /٦/g, /٧/g, /٨/g, /٩/g];
window.enNumbers = function (str) {
    if (typeof str === 'string') {
        for (var i = 0; i < 10; i++) {
            str = str.replace(persianNumbers[i], i).replace(arabicNumbers[i], i);
        }
    }
    return str;
};


// Chooice js --------------------------------------------------------------------------------------------------------
require('../../node_modules/choices.js/public/assets/scripts/choices.min');
