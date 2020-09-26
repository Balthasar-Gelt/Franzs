export function hideAlert(alert){

    if(window.getComputedStyle(alert).getPropertyValue("opacity") == 1){

        alert.style.opacity = "0";
    
        setTimeout(() => {
            alert.style.visibility = "hidden";
        }, 300);
    }
}