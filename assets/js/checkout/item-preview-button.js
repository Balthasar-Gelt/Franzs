import {checkIfVisible} from '../general-form-functionality/check-if-visible';

let button, cart;

export function inintializeItemPreviewButton(){

    button = document.querySelector(".checkout_item_preview");
    cart = document.querySelector(".product_table_checkout");

    button.addEventListener('click', toggleItemPreview);
}

function toggleItemPreview(){
    
    if(getComputedStyle(cart).display =='none')
        fadeCartIn();
        
    else
        fadeCartOut();
}

function fadeCartIn(){

    cart.style.display = 'block';

    setTimeout(() => {

        cart.classList.add('fade_in');
    }, 50);
}

function fadeCartOut(){

    cart.classList.remove('fade_in');

    setTimeout(() => {
        cart.style.display = 'none';
    }, 300);
}