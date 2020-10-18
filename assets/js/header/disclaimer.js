let disclaimer, closeButton;

export function initializeDisclaimer(){

    disclaimer = document.querySelector('.disclaimer');
    closeButton = document.querySelector('.disclaimer img');

    closeButton.addEventListener('click', closeDisclaimer);
}

function closeDisclaimer(){

    disclaimer.style.display = 'none';
}