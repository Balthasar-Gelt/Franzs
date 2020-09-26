let linksStorage;

export function initializeScrollDownButtons(){

    linksStorage = [];
    linksStorage.push(document.querySelectorAll('.about_us_link'));
    linksStorage.push(document.querySelectorAll('.contact_link'));

    for (const links of linksStorage) {

        for (const link of links) {

            link.addEventListener('click', scrollToSection);
        }
    }
}

function scrollToSection(){

    window.scrollTo({
        left: 0,
        top: document.body.scrollHeight,
        behavior: 'smooth'
    });
}