import {checkIfVisible} from './check-if-visible';

export function switchVisibility(element, className, delay){

    if(checkIfVisible(element)){

        element.classList.remove(className);

        setTimeout(() => {
            element.style.visibility = "hidden";
        }, delay);
    }
    else{

        element.style.visibility = "visible";

        setTimeout(() => {
            element.classList.add(className)
        }, 50);
    }
}