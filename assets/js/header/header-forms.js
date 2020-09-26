import {initializeRegister} from './register';
import {initializeLogIn} from './log-in';
import {initializeSwitchFormsButtons} from './switch-forms-buttons';
import {initializeHideFormsLinks} from './hide-forms';

export function initializeHeaderForms(){

    initializeRegister();
    initializeLogIn();
    initializeSwitchFormsButtons();
    initializeHideFormsLinks()
}