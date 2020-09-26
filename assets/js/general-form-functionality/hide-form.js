import {overlay} from './overlay';
import {switchVisibility} from './switch-visibility';

export function hideForm(element){

    switchVisibility(element, "slide_up",400);

    setTimeout(() => {
        switchVisibility(overlay,"fade_in",300);
    }, 150);
}