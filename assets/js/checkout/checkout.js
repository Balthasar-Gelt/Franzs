import {initializeCheckoutForm} from './checkout-form';
import {initializeShippingOptions} from './checkout-cart';
import {initializeCardExpirationDate} from '../general-form-functionality/masks/card-expiration-date-mask';
import {initializeCardNumberMask} from '../general-form-functionality/masks/card-number-mask';
import {initializeCardSecurityCodeMask} from '../general-form-functionality/masks/card-security-code-mask';
import {initializePhoneMask} from '../general-form-functionality/masks/phone-mask';
import {inintializeItemPreviewButton} from './item-preview-button';

if(window.location.pathname == '/Dealers/checkout.php'){
    
    initializeCheckoutForm();
    initializeShippingOptions();
    initializeCardExpirationDate();
    initializeCardNumberMask();
    initializeCardSecurityCodeMask();
    initializePhoneMask();
    inintializeItemPreviewButton();
}