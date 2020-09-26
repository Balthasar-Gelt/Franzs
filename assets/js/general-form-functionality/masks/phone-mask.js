import {addMask} from './general/add-mask';
import {unsetMask} from './general/unset-mask';

let formPhone, phoneMaskString;

export function initializePhoneMask(){

    formPhone = document.querySelector("#form_phone"),
    phoneMaskString = "(+{1}9{3} |9)(9{3} ){2}9{4}";

    addMask(phoneMaskString,formPhone);
    formPhone.addEventListener( 'keyup', formPhoneMasking );
}

function formPhoneMasking(){

    if(formPhone.value == "" && formPhone.inputmask == null)
        addMask(phoneMaskString, formPhone);

    else if(formPhone.inputmask != null){

        if((formPhone.value.charAt(0) === '+' && 
        formPhone.inputmask.unmaskedvalue().length > 12) 
        || 
        (formPhone.value.charAt(0) !== '+' && 
        formPhone.inputmask.unmaskedvalue().length > 10))
            unsetMask(formPhone);
    }
}