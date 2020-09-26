import {initializeFilter} from './price-filter';
import {initializeResponsiveAside} from './aside-responsive';

if(window.location.pathname == '/Dealers/shop.php'){
    initializeFilter();
    initializeResponsiveAside();
}