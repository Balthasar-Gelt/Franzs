# Franzs

Eshop with antique items built in pure PHP and Javascript.

Packages used
- Cartalyst Sentinel - php authorization and authentication
- RobinHerbots/Inputmask - js input masking library
- noUiSlider - js slider library used as price filter at shop.php page

File structure

- in root you will find php files for every individual page: index, shop, product-page,....
- assets - this file contains all javascript and all scss code, icons and product images
- form-actions - contains php code that deals with form actions
- partials - html code for header and footer, header contains more partials in itself, those are: 
    - search (search bar for product search)
    - cookies-disclaimer
    - messages (messages pop ups used for informing users if their actions were successful or not, for example adding products to cart)
    - log in and register forms
    - header menus
