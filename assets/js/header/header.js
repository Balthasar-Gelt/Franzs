import {initializeSearch} from './search';
import {initializeScrollDownButtons} from './about-contact-buttons';
import {initializeLogOutLink} from './log-out';
import {initializeHeaderForms} from './header-forms';
import {initializeLabelManager} from '../general-form-functionality/form-input-label-manager';
import {initializeBurger} from './responsive-menu';
import {initializeDisclaimer} from './disclaimer';

initializeDisclaimer();
initializeHeaderForms();
initializeSearch();
initializeScrollDownButtons();
initializeLogOutLink();
initializeLabelManager();
initializeBurger();