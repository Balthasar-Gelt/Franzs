let disclaimer, closeButton;

export function initializeDisclaimer(){

    disclaimer = document.querySelector('.disclaimer');
    closeButton = document.querySelector('.disclaimer img');

    if(disclaimer && closeButton != null)
        closeButton.addEventListener('click', e => closeDisclaimer(e));
}

function closeDisclaimer(e){

    e.preventDefault();

    disclaimer.style.display = 'none';

    fetch(e.target.parentElement.href);
}