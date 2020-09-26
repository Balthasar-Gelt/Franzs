import {registerFormWrapper} from './variables/register-form-wrapper';
import {postFormFetch} from '../general-form-functionality/post-form-fetch';

let registerFormButton, registerForm;

export function initializeRegister(){

    registerFormButton = document.querySelector('#register_form_button');
    registerForm = document.querySelector('#register_form_wrapper form');

    registerFormButton.addEventListener('click', function(e){
        e.preventDefault();
    
        postFormFetch(registerForm, registerFormWrapper);
    })
}