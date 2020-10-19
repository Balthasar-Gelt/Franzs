import {initializeAddToCartButton} from './add-item-to-cart';
import {siteName} from '../general/site-name';

if(window.location.pathname == '/'+ siteName +'/product-page.php'){
    initializeAddToCartButton();
}