
import {addMask} from './general/add-mask';
import {unsetMask} from './general/unset-mask';

let formCardNumber, cardNumberString;

export function initializeCardNumberMask(){

    formCardNumber = document.querySelector('#form_card_number'),
    cardNumberString = "(9{4} ){3}9{5}";

    addMask(cardNumberString,formCardNumber);
    formCardNumber.addEventListener( 'keyup', cardNumberMasking );
}

function cardNumberMasking(){

    if(formCardNumber.value == "" && formCardNumber.inputmask == null)
        addMask(cardNumberString,formCardNumber);

    else if(formCardNumber.inputmask != null && formCardNumber.inputmask.unmaskedvalue().length > 16)
        unsetMask(formCardNumber);
}