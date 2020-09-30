let burger, menuOverlay, overlayEscape, menuLists;

export function initializeBurger(){

    burger = document.querySelector('.menu_icon');
    menuOverlay = document.querySelector('.menu_overlay');
    overlayEscape = document.querySelector('.menu_overlay img');
    menuLists = document.querySelectorAll('.menu_overlay ul');

    burger.addEventListener('click', showMenuOverlay);
    overlayEscape.addEventListener('click', hideMenuOverlay);
}

function showMenuOverlay(){

    menuOverlay.classList.toggle('display_block');

    setTimeout(() => {

        menuOverlay.classList.toggle('fade_in');

        menuLists.forEach(list => {
            list.classList.add('slide_up');
        });
    }, 50);
}

function hideMenuOverlay(){

    menuLists.forEach(list => {
        list.classList.remove('slide_up');
    });

    menuOverlay.classList.toggle('fade_in');

    setTimeout(() => {
        menuOverlay.classList.toggle('display_block');
    }, 300);
}