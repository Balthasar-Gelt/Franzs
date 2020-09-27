import {monetarySymbol} from '../general/monetary-symbol';

let cartContent, cartTotal, cartEmptyElement, cartCheckoutButton, cartHrefValue;

export function initializeDeleteFromCart(){

    cartContent = document.querySelector('#cart_content');
    cartTotal = document.querySelector('.cart_total span');
    cartEmptyElement = '<div class="empty_cart">Your cart is empty</div>';
    cartCheckoutButton = document.querySelector('#checkout_link');
    cartHrefValue = "checkout.php";

    cartContent.addEventListener('click', e => deleteFromCart(e) );
}

function deleteFromCart(event){

    event.preventDefault();

    if(event.target.classList.contains('remove_product')){

        let deleteLink = event.target.parentElement.href;

        fetch(deleteLink, { headers: { fetch : 'true' }})

        .then( response => (response.ok ? response.json() : false) )
        
        .then(function(response){

            if(response != 'false' && response['code'] == 1){

                cartTotal.innerHTML = response['answer']['cartTotal'] + ' ' + monetarySymbol;

                let item = event.target.parentElement.parentElement.parentElement;
                removeItemDOM(item);

                if(response['answer']['isEmpty'])
                    makeCartEmpty();

                else{

                    let itemStatusArray = response['answer']['itemStatus'];
                    let disableCartButton = (itemStatusArray.includes('Reserved') || itemStatusArray.includes('Sold Out'));
                    let cartButtonStatus = checkIfButtonDisabled(cartCheckoutButton);
    
                    checkOnCartButton(disableCartButton, cartButtonStatus);
                }
            }
        })
    }
}

function removeItemDOM(item){

    item.classList.add('fade_out');
    setTimeout(function(){ item.remove(); }, 300);
}

function makeCartEmpty(){

    setTimeout(function(){ cartContent.innerHTML = cartEmptyElement; }, 280);
    disableButton(cartCheckoutButton);
}

function checkOnCartButton(disable, button){

    if(disable && !button)
        disableButton(cartCheckoutButton);

    else if(!disable && button)
        makeButtonActive(cartCheckoutButton, cartHrefValue);
}

function disableButton(button){

    button.classList.add('disabled_button');
    button.href = '#';
    button.setAttributeNode(document.createAttribute('disabled'));
}

function checkIfButtonDisabled(button){

    return (button.classList.contains('disabled_button') && button.hasAttribute('disabled'));
}

function makeButtonActive(button, link){

    button.classList.remove('disabled_button');
    button.href = link;
    button.removeAttribute('disabled');
}