import {showMessage} from '../general/show-message';
import {messages} from '../general/messages';

let addProductToCartButton;

export function initializeAddToCartButton(){

    addProductToCartButton = document.querySelector('.add_product');

    if(addProductToCartButton != null)
        addProductToCartButton.addEventListener( 'click', e => addToCartFetch(e) );
}

function addToCartFetch(event){

    event.preventDefault();

    var url = addProductToCartButton.href;

    fetch(url, {
        headers: {
            fetch : 'true'
        }
    })
    .then(function(response){
        if(response.ok){
            return response.json();
        }
        else
            return 'false';
    })
    .then(function(response){

        showMessage(messages[response['code'] - 1], response['answer']);
    })
}