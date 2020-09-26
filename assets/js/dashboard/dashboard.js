import {initializeChangeUserDataFetch} from './dashboard-form';
import {inintializeScrolling} from './dashboard-scrolling';
import {initializePhoneMask} from '../general-form-functionality/masks/phone-mask';

if(window.location.pathname == '/Dealers/dashboard.php'){
    
    initializeChangeUserDataFetch();
    inintializeScrolling();
    initializePhoneMask();
}