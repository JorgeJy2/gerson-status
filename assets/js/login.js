let check_input = (event) => {
    let password = event.srcElement.value;

    let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{5,}/;

    let btnElement = document.getElementById('btn-access-login');

    //Se muestra un texto a modo de ejemplo, luego va a ser un icono
    if (password.match(regex)) {
        console.log("válido");
        btnElement.disabled = false;
    } else {
        console.log("incorrecto");
        btnElement.disabled = true;
    }
}