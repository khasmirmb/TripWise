import Datepicker from 'flowbite-datepicker/Datepicker';

const start_date = document.getElementById('start_date');

const end_date = document.getElementById('end_date');

new Datepicker(start_date, {
    title: "Starting Date",
    autoHide: true,
    todayHighlight: true,
    minDate: new Date()
});


new Datepicker(end_date, {
    title: "Ending Date",
    autoHide: true,
    todayHighlight: true,
    minDate: new Date()
});