import {initializeDeleteFromCart} from './delete-from-cart';
import {siteName} from '../general/site-name';

if(window.location.pathname == '/'+ siteName +'/cart.php'){
    
    initializeDeleteFromCart();
}