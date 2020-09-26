import {logInFormWrapper} from './variables/log-in-form-wrapper';
import {registerFormWrapper} from './variables/register-form-wrapper';
import {switchVisibility} from '../general-form-functionality/switch-visibility';

let formLinks;

export function initializeSwitchFormsButtons(){

    formLinks = document.querySelectorAll(".form_wrapper a");

    formLinks.forEach(link => {
    
        link.addEventListener( 'click', e => switchBetweenForms(e) );
    })
}

function switchBetweenForms(e){
    
    e.preventDefault();

    e.target.id == 'register_here' ? switchToRegisterForm() :  switchToLogInForm();
}

function switchToLogInForm(){

    switchVisibility(registerFormWrapper, "slide_up", 400);

    setTimeout(() => {
        switchVisibility(logInFormWrapper, "slide_up", 400);
    }, 350);
}

function switchToRegisterForm(){

    switchVisibility(logInFormWrapper, "slide_up", 400);

    setTimeout(() => {
        switchVisibility(registerFormWrapper, "slide_up", 400);
    }, 350);
}