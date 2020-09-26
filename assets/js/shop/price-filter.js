//
//  PRICE FILTER
//

let inputLeft, inputRight, handleLeft, handleRight, range,
priceMin, priceMax, valueOffset, maxValue, trackWidth,
filterButton, products;

export function initializeFilter(){

    inputLeft  = document.querySelector("#input_left");
    inputRight = document.querySelector("#input_right");

    handleLeft = document.querySelector(".handle.left");
    handleRight = document.querySelector(".handle.right");

    priceMin = document.querySelector('.min_price');
    priceMax = document.querySelector('.max_price');

    trackWidth = document.querySelector(".slider .track").offsetWidth;
    range = document.querySelector(".slider .range");
    maxValue = inputLeft.max;
    valueOffset = 50;

    filterButton = document.querySelector("#filter_button"),
    products = document.querySelectorAll(".item");

    inputLeft.addEventListener('input', leftInputEventAction);
    inputRight.addEventListener('input', rightInputEventAction);

    filterButton.addEventListener('click', e => filterButtonEventAction(e) );
}

function leftInputEventAction(){

    let valueLeft = Math.min(inputLeft.value, parseInt(inputRight.value) - valueOffset);

    inputLeft.value = valueLeft;

    handleLeft.style.left = CalculateValue(CalculatePercentage(inputLeft.value,maxValue), trackWidth) + 'px';
    
    range.style.left = CalculateValue(CalculatePercentage(inputLeft.value,maxValue), trackWidth) + 'px';

    priceMin.innerHTML = inputLeft.value;
}

function rightInputEventAction(){

    let valueRight = Math.max(inputRight.value, parseInt(inputLeft.value) + valueOffset);

    inputRight.value = valueRight;
    
    handleRight.style.right = CalculateRight(CalculateValue(CalculatePercentage(inputRight.value,maxValue), trackWidth), trackWidth) + "px";

    range.style.right = CalculateRight(CalculateValue(CalculatePercentage(inputRight.value,maxValue), trackWidth), trackWidth) + "px";

    priceMax.innerHTML = inputRight.value;
}

function CalculatePercentage(value, maxValue){

    return (value / maxValue) * 100;
}

function CalculateValue(percentage, maxValue){
    
    return (maxValue / 100) * percentage;
}

function CalculateRight(value, maxValue){

    return maxValue - value;
}

//
//  FILTER BUTTON
//

function filterButtonEventAction(event){
    event.preventDefault();

    let minPrice = parseInt(inputLeft.value),
        maxPrice = parseInt(inputRight.value);

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
