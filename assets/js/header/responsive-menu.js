let burger, menuOverlay, overlayEscape;

export function initializeBurger(){

    burger = document.querySelector('.menu_icon');
    menuOverlay = document.querySelector('.menu_overlay');
    overlayEscape = document.querySelector('.menu_overlay img');

    burger.addEventListener('click', showMenuOverlay);
    overlayEscape.addEventListener('click', hideMenuOverlay);
}

function showMenuOverlay(){

    menuOverlay.classList.toggle('display_block');

    setTimeout(() => {
        menuOverlay.classList.toggle('fade_in');
    }, 50);
}

function hideMenuOverlay(){

    menuOverlay.classList.toggle('fade_in');

    setTimeout(() => {
        menuOverlay.classList.toggle('display_block');
    }, 300);
}