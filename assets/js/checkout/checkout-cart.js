import {monetarySymbol} from '../general/monetary-symbol';

let shippingOptions, checkoutShipping, checkoutTotal, fetchCheckoutTotalLink;

export function initializeShippingOptions(){

    shippingOptions = document.querySelectorAll(".checkout_form .radio_button_wrapper label");
    checkoutShipping = document.querySelector("#product_table_shipping");
    checkoutTotal = document.querySelector(".checkout_total span");
    fetchCheckoutTotalLink = "page-funcs/helper-funcs/fetch-cart-total.php";

    shippingOptions.forEach( element => element.addEventListener( 'click', () => shippingOptionsFetch(element) ) );
}

function shippingOptionsFetch(element){

    fetch(fetchCheckoutTotalLink)

    .then( response => (response.ok ? response.text() : false) )

    .then(function(response){

        if(response != false){
            checkoutTotal.innerHTML = (parseFloat(response) + parseFloat(element.getAttribute('value'))) + ' ' + monetarySymbol;
            checkoutShipping.innerHTML = parseFloat(element.getAttribute('value')) + ' ' + monetarySymbol;
        }
    })
}