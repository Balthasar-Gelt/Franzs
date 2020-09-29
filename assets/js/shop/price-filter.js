import noUiSlider from 'nouislider';

let snapSlider, snapValues, filterButton, products;

export function initializeFilter(){

    snapSlider = document.querySelector('.slider');

    noUiSlider.create(snapSlider, {
        start: [0, 1000],
        connect: true,
        range: {
            'min': 0,
            'max': 1000
        }
    });

    snapValues = [
        document.getElementById('slider-snap-value-lower'),
        document.getElementById('slider-snap-value-upper')
    ];
    
    snapSlider.noUiSlider.on('update', function (values, handle) {
        snapValues[handle].innerHTML = values[handle];
    });

    products = document.querySelectorAll('.item_list li');
    filterButton = document.querySelector('#filter_button');
    filterButton.addEventListener('click', e => filterButtonEventAction(e, snapValues[0].innerHTML, snapValues[1].innerHTML));
}

function filterButtonEventAction(event, minPrice, maxPrice){
    event.preventDefault();

    minPrice = parseFloat(minPrice),
    maxPrice = parseFloat(maxPrice);
console.log(products);
    products.forEach(product => {

        let productPrice = parseInt(product.dataset.price);
        
        if((productPrice < minPrice || productPrice > maxPrice))
        {
            product.classList.remove("fade_in");
            product.classList.add("fade_out");

            setTimeout(function(){
                product.style.display = "none";
            }, 300)
        }
        
        else if(productPrice >= minPrice && productPrice <= maxPrice)
        {
            product.style.display = "block";
            
            setTimeout(function(){
                product.classList.remove("fade_out");
                product.classList.add("fade_in");
            }, 100)
        }
    });
    
}