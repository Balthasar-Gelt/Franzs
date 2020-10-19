import {initializeFilter} from './price-filter';
import {initializeResponsiveAside} from './aside-responsive';
import { siteName } from '../general/site-name';

if(window.location.pathname == '/'+ siteName +'/shop.php'){
    initializeFilter();
    initializeResponsiveAside();
}