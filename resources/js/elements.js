// Time Picker Tailwind Elements
import { Datepicker, Input, initTE,} from "tw-elements";
    
initTE({ Datepicker, Input });
    
const datepickerDisablePast = document.getElementById('datepicker-disable-past');
new Datepicker(datepickerDisablePast, {
    disablePast: true
});
    
const datepickerDisablePast2 = document.getElementById('datepicker-disable-past2');
new Datepicker(datepickerDisablePast2, {
    disablePast: true
});