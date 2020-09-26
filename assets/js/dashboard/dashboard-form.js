import {postFormFetch} from '../general-form-functionality/post-form-fetch';

export function initializeChangeUserDataFetch(){

    let changeUserDataFormButton = document.querySelector('#change_user_data_form_button'),
    changeUserDataForm = document.querySelector("#change_user_data_form");

    changeUserDataFormButton.addEventListener('click', function(e){
        e.preventDefault();
    
        postFormFetch(changeUserDataForm);
    })
}