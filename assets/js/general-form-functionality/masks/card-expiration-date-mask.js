import Inputmask from "inputmask";
import {addMask} from './general/add-mask';

let formCardExpirationDate;

export function initializeCardExpirationDate(){

    formCardExpirationDate = document.querySelector('#form_card_expiration');

    formCardExpirationDate.addEventListener( 'keyup', cardExpirationDateMasking );
}

function cardExpirationDateMasking(){

    if(formCardExpirationDate.inputmask == null){

        if(formCardExpirationDate.value > 1)
            addMask("0" + "9/9{4}",formCardExpirationDate);

        else if(formCardExpirationDate.value == 1)
            addMask("9(0|1|2)/9{4}",formCardExpirationDate);

        else if(formCardExpirationDate.value == 0 && formCardExpirationDate.value != "")
            Inputmask("9*/9{4}",{definitions: {'*':{validator: "[1-9]"}},jitMasking: true, showMaskOnHover: false}).mask(formCardExpirationDate);
    }

    else if(formCardExpirationDate.inputmask != null && formCardExpirationDate.value == "")
        formCardExpirationDate.inputmask.remove();
}