export function showMessage(message, value){

    message.firstElementChild.innerHTML = value;

    message.style.visibility = 'visible';
    message.style.opacity = '1';

    setTimeout(() => {
        message.style.opacity = '0';

        setTimeout(() => {
            message.style.visibility = 'hidden'; 
        }, 400);

    }, 1500);
}