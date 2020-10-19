import {showMessage} from '../general/show-message';
import {messages} from '../general/messages';
import {logOutlinks} from '../general-form-functionality/links/log-out-links';
import {logInLinks} from '../general-form-functionality/links/log-in-links';
import {dashboardLinks} from '../general-form-functionality/links/dashboard-links';
import { siteName } from '../general/site-name';

let badSite;

export function initializeLogOutLink(){

    badSite = 'http://localhost:8888/'+ siteName +'/dashboard.php';

    for (const link of logOutlinks) {
        link.addEventListener('click', e => logOutLinkClickAction(e, link));
    }
}

function logOutLinkClickAction(e, logOutLink){
    e.preventDefault();

    fetch(logOutLink.href,{ headers: { fetch : 'true' }})

    .then( response => (response.ok ? response.json() : false) )

    .then(function(response){
        if(response != false){

            if(response['code'] == 1){

                hideLogInIconMenu();

                if(window.location.href == badSite)
                    window.location.href = "http://localhost:8888/"+ siteName +"/index.php";
            }

            showMessage(messages[response['code'] - 1], response['answer']);
        }
    })
}

function hideLogInIconMenu(){

    switchStyle(logInLinks, 'block');
    switchStyle(logOutlinks, 'none');
    switchStyle(dashboardLinks, 'none');
}

function switchStyle(links, style){

    for (const link of links) {
        link.parentElement.style.display = style;
    }
}