import {options} from '../general-form-functionality/fetch-post-options';
import {hideForm} from './hide-form';
import {showAlert} from './show-alert';
import {getAlert} from './get-alert';
import {showMessage} from '../general/show-message';
import {messages} from '../general/messages';
import {logInLinks} from '../general-form-functionality/links/log-in-links';
import {logOutlinks} from './links/log-out-links';
import {dashboardLinks} from './links/dashboard-links';

export function postFormFetch(form, wrapper = null){

    let formData = new FormData(form);

    fetch(form.action, options(formData))

    .then( response => (response.ok ? response.json() : false) )
    
    .then(function(response){
        if(response != false){

            switch (response['code']) {
                case 1:
                    switchOnLoggedInIconMenu();

                    if(wrapper != null)
                        hideForm(wrapper);
                    break;

                case 2:
                    showAlert( getAlert(form, response['errorType'] ) );
                    break;
            }

            showMessage(messages[response['code'] - 1], response['answer']);
        }
    })
}

function switchOnLoggedInIconMenu(){

    switchLinks(logInLinks, 'none');
    switchLinks(logOutlinks, 'block');
    switchLinks(dashboardLinks, 'block');
}

function switchLinks(links, style){

    for (const link of links) {
        link.parentElement.style.display = style;
    }
}