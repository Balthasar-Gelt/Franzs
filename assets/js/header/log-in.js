import {logInFormWrapper} from './variables/log-in-form-wrapper';
import {overlay} from '../general-form-functionality/overlay';
import {postFormFetch} from '../general-form-functionality/post-form-fetch';
import {switchVisibility} from '../general-form-functionality/switch-visibility';
import {logInLinks} from '../general-form-functionality/links/log-in-links';

let logInFormButton, logInForm;

export function initializeLogIn(){

    logInFormButton = document.querySelector('#log_in_form_button'),
    logInForm = document.querySelector('#log_in_form_wrapper form');

    for (const link of logInLinks) {
        link.addEventListener( "click", e => logInLinkAction(e) );
    }

    logInFormButton.addEventListener('click', function(e){
        e.preventDefault();
    
        postFormFetch(logInForm, logInFormWrapper);
    });
}

function logInLinkAction(e){

    e.preventDefault();

    switchVisibility(overlay,"fade_in",300);
    
    setTimeout(() => {
        switchVisibility(logInFormWrapper,"slide_up",400);
    }, 150);
}