

window.onload = (event) => {
    let myAlert = document.querySelector('.toast');
    let bsAlert = new bootstrap.Toast(myAlert);

    bsAlert._config.delay = 2000;
    bsAlert.show();

}