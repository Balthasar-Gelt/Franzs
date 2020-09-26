import {logInFormWrapper} from './variables/log-in-form-wrapper';
import {registerFormWrapper} from './variables/register-form-wrapper';
import {hideForm} from '../general-form-functionality/hide-form';

let hideFormsLinks;

export function initializeHideFormsLinks(){

    hideFormsLinks = document.querySelectorAll(".form_wrapper img");
    
    hideFormsLinks[0].addEventListener('click', () => hideForm(logInFormWrapper));
    hideFormsLinks[1].addEventListener('click', () => hideForm(registerFormWrapper));
}