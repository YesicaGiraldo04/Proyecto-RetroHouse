function validarDocumento(){
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    toastr['info']("El documento no se puede modificar manualmente, contacta con servicio a cliente.");
}

function validarNumero(id){
    let numero =  document.getElementById(id).value;
    const patron = /^[0-9]+$/;
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }
    if(!(patron.exec(numero))){
        toastr['info']('El el campo "'+id+'" no admite letras, ni caracteres especiales.');
        return false;
    }else{
        if(numero.length != 10){
            toastr['info']('El campo '+id+' no puede contener menos de diez dígitos');
            return false;
        }else{ 
            return true;
        }
    }
}

function validarNombre(){
    let nombre = document.getElementById('name').value;
    const patron = /^[a-zA-ZáéíóúñÑÁÉÍÓÚ\s]+$/;
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }
    if(!(patron.exec(nombre))){
        toastr['info']('El campo "Nombre" no admite números ni caracteres especiales.');
        return false;
    }else{
        return true;
    }
}

function validarVacios(){
    let vacios =  new Array(5);
    let numVacios= 0;
    vacios[0] = document.getElementById('celular').value;
    vacios[1] = document.getElementById('name').value;
    vacios[2] = document.getElementById('direccion').value;
    vacios[3] = document.getElementById('email').value;
    vacios[4] = document.getElementById('documento').value;
    for(let i=0; i<5; i++){
        let espacio = vacios[i].trim();
        if(vacios[i]== "" || espacio == ""){
            numVacios +=1;
        }
    }
    if(numVacios != 0){
        return false;
    }else{
        return true;
    }
}

function validarImagen(){
    let imagen = document.getElementById('imagen').value;
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }
    if(imagen == ""){
        toastr['info']('Se debe cargar una imagen primero.');
    }else{
        let extensión = imagen.substring(imagen.lastIndexOf('.'),imagen.length);
        let pattern = /(.jpg|.jpeg|.png|.gif)$/i;
        if(!(pattern.exec(extensión))){
            toastr['info']('No se permiten los archivos '+extensión+' en la Imagen');
        }else{
            document.formImagen.submit()
        }
    }
}

function validarEmail(){
    let email = document.getElementById("email").value;
    let patron = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }
    if(patron.test(email)){
        return true;
    }else{
        toastr['info']("El correo ingresado no es válido");
        return false;
    }
}


function validarTodo(){
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }
    if(validarVacios()){
        let nombre = validarNombre();
        let documento = validarNumero('documento');
        let celular = validarNumero('celular');
        let email = validarEmail();
        if(nombre && celular && documento && email){
            document.formulario1.submit();
        }else{
            toastr['info']('Solucionar los errores para poder modificar.');
        }

    }else{
        toastr['info']('No se permiten campos vacíos.');
    }
}
