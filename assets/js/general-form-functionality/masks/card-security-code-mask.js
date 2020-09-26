import {addMask} from './general/add-mask';

let formCardSecurityCode, cardSecurityCodeString;

export function initializeCardSecurityCodeMask(){

    formCardSecurityCode = document.querySelector("#form_card_security_code"),
    cardSecurityCodeString = "9{3,4}";

    addMask(cardSecurityCodeString,formCardSecurityCode);
}