let searchLinks, searchBar, closeSearchButton, searchField, listOfSearchedProducts, url, containerOfSearchedProducts;

export function initializeSearch(){

    url = 'page-funcs/helper-funcs/search-product.php?searchText=';

    searchLinks = document.querySelectorAll(".search_link");
    searchBar = document.querySelector("#search_bar");
    closeSearchButton = document.querySelector("#close_search");
    searchField = document.querySelector("#search_field");
    containerOfSearchedProducts = document.querySelector(".products_search_container");
    listOfSearchedProducts = document.querySelector(".products_search_container ul");

    for (const link of searchLinks) {
        link.addEventListener('click', e => toggleSearchBar(e));
    }

    closeSearchButton.addEventListener('click', closeSearchBar);
    searchField.addEventListener('keyup', e => searchFetch(e));
}

function closeSearchBar(){

    searchBar.style.visibility = "hidden";
    containerOfSearchedProducts.style.maxHeight = "0px";
}

function toggleSearchBar(e){

    e.preventDefault();

    if(searchBar.style.visibility == "hidden"){
        searchBar.style.visibility = "visible";
        searchField.focus();
    }
    else{
        closeSearchBar();
    }

    searchField.value = "";
    listOfSearchedProducts.innerHTML = "";
}

function searchFetch(e){

    if(e.target.value != ""){

        let fetchUrl = url;
        fetchUrl += e.target.value;

        fetch(fetchUrl)
        .then(function (response) {
        return response.text();
        })
        .then(function (response) {
        containerOfSearchedProducts.style.maxHeight = "none";
        listOfSearchedProducts.innerHTML = response;
        });
    }
}