import {options} from '../general-form-functionality/fetch-post-options';
import {showAlert} from '../general-form-functionality/show-alert';
import {showMessage} from '../general/show-message';
import {getAlert} from '../general-form-functionality/get-alert';
import {messages} from '../general/messages';

let checkoutFormButton, checkoutForm, checkoutLink;

export function initializeCheckoutForm(){

    checkoutFormButton = document.querySelector("#checkout_form_button");
    checkoutForm = document.querySelector(".checkout_form");
    checkoutLink = checkoutForm.action;

    checkoutFormButton.addEventListener( 'click', e => checkoutFormEventAction(e) );
}

function checkoutFormEventAction(e){
    e.preventDefault();

    let formData = new FormData(checkoutForm);

    fetch(checkoutLink, options(formData))

    .then( response => (response.ok ? response.json() : false) )

    .then(function(response){
        if(response != false){

            switch (response['code']) {
                case 1:
                    window.location = response['answer'];
                    break;

                case 2:
                    showAlert( getAlert(checkoutForm, response['errorType']) );
                    showMessage(messages[response['code'] - 1], response['answer']);
                    break;
                
                case 3:
                    showMessage(messages[response['code'] - 1], response['answer']);
                    break;
            }
        }
    })
}