let button, overlay, aside;

export function initializeResponsiveAside(){

    overlay = document.querySelector("#aside_overlay");
    aside = document.querySelector(".side_content");
    button = document.querySelector("#aside_button");

    button.addEventListener('click', toggleResponsiveAside);
}

function toggleResponsiveAside(){

    window.getComputedStyle(overlay).display == 'none' ? showOverlay() : hideOverlay();
}

function showOverlay(){

    overlay.style.display = 'block';
    aside.style.display = 'block';

    setTimeout(() => {
        overlay.classList.toggle('fade_in');
        aside.classList.toggle('slide_in');
    }, 50);
}

function hideOverlay(){

    aside.classList.toggle('slide_in');
    overlay.classList.toggle('fade_in');

    setTimeout(() => {
        aside.style.display = 'none';
        overlay.style.display = 'none';
    }, 300);
}