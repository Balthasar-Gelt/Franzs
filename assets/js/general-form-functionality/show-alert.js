export function showAlert(alert){

    alert.style.visibility = "visible";

    setTimeout(() => {
        alert.style.opacity = "1";
    }, 5);
}