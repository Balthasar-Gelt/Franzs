import { hideAlert } from './hide-alert';

let inputs;

export function initializeLabelManager(){

    inputs = document.querySelectorAll('form input');

    for (const input of inputs) {

        toggleInputLabel(input);
        
        input.addEventListener( 'keyup', e => toggleLabelAndHideAlert(e) );
    }
}

function toggleInputLabel(input){

    let inputVal = input.value;
    inputVal = inputVal.replace(/\s/g,'');

    if(input.previousElementSibling != null){
        inputVal != '' ? input.previousElementSibling.style.opacity = '1' :
        input.previousElementSibling.style.opacity = '0';
    }
}

function toggleLabelAndHideAlert(e){
    toggleInputLabel(e.target);

    if(e.target.nextElementSibling != null && e.target.nextElementSibling.classList.contains('alert')){
        hideAlert(e.target.nextElementSibling);
    }
}