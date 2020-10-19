import {initializeChangeUserDataFetch} from './dashboard-form';
import {inintializeScrolling} from './dashboard-scrolling';
import {initializePhoneMask} from '../general-form-functionality/masks/phone-mask';
import {siteName} from '../general/site-name';

if(window.location.pathname == '/'+ siteName +'/dashboard.php'){
    
    initializeChangeUserDataFetch();
    inintializeScrolling();
    initializePhoneMask();
}