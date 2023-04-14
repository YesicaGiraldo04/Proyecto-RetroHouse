// (Safir) obtener la información del text area.
function obtenerInfo(){
    let texto = document.getElementById('texto').value;
    document.getElementById('descripcion').value = texto;
}

// (Jose) Esta función valida los campos para que solo puedan contener numeros
function valNum(num){
    let comprobar = document.getElementById(num).value;
    let pattern = /^[0-9]+$/;
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
    if(!pattern.test(comprobar)){
        toastr['info']('No se permiten letras ni números negativos en  el campo'+num);
        return false;
    }else{
        return true;
    }
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
        toastr['info']('El el campo "'+id+'" no admite letras.');
        return false;
    }else if(numero.length < 10){
        toastr['info']('El campo '+id+' no puede contener menos de diez dígitos')
    }else{
        return true;
    }
}
// (Jose) Esta función valida que se escoja una categoria para el producto.
function valCat(){
    let categoria = document.getElementById('categoria').value;
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
    if(categoria == "N/N"){
        toastr['info']('Seleccionar una categoría');
    }else{
        return true;
    }
}
// (Jose) Esta función valida que se seleccione un archivo correcto para la imagen.
function validarImagen(){
    let imagen = document.getElementById('imagenProducto').value;
    let extensión = imagen.substring(imagen.lastIndexOf('.'),imagen.length);
    let pattern = /(.jpg|.jpeg|.png|.gif)$/i;
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
    if(!pattern.exec(extensión)){
        toastr['info']('No se permiten los archivos '+extensión+' en la Imagen');
        return false;
    }else{
        return true;
    }
}
// (Jose) Esta función valida que se seleccione un archivo correcto para la musica.
function validarMusica(){
    let musica = document.getElementById('musicaProducto').value;
    let extensión = musica.substring(musica.lastIndexOf('.'),musica.length);
    let pattern = /(.mp3|.aac|.flac|.wav)$/i;
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
    if(!pattern.exec(extensión)){
        toastr['info']('No se permiten los archivos '+extensión+' en la música');
        return false;
    }else{
        return true;
    }
}
// (Jose) Esta función permite verificar que todos los campos tengan información y no esten vacios o llenados solamente con espacios.
function validarVacios(){
    let vacios =  new Array(5);
    let numVacios= 0;
    vacios[0] = document.getElementById('nombreProducto').value;
    vacios[1] = document.getElementById('descripcion').value;
    vacios[2] = document.getElementById('precio').value;
    vacios[3] = document.getElementById('imagenProducto').value;
    vacios[4] = document.getElementById('musicaProducto').value;
    for(let i=0; i<5; i++){
        let espacios = vacios[i].trim();
        if(vacios[i]== "" || espacios == ""){
            numVacios +=1;
        }
    }
    if(numVacios > 0){
        return false;
    }else{
        return true;
    }

}

// (Jose) Esta función se ejecuta para poder validar todo justo antes de enviar el formulario.
function validarTodo(){
    if(validarVacios()){
        let precio = valNum('precio');
        let categoria =valCat();
        let imagen = validarImagen();
        let musica = validarMusica();
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
        if(precio && categoria && imagen && musica){
            document.formularioAgregar.submit(); 
        }else{
            toastr['info']('Por favor corregir los errores para continuar.');
        }
    }else{
        toastr['info']("No se permiten campos vacíos.");
    }
}
// (Jose) Esta función solo se aplica en el archivo modificarProducto.php pues en ese formulario se acepta que los archivos de imagen estén vacios.
function validarImagen2(){
    let validar = document.getElementById('imagenProducto').value;
    if(validar == ""){
        return true;
    }else{
        validar = validarImagen();
        return validar;
    }
}
// (Jose) Esta función solo se aplica en el archivo modificarProducto.php pues en ese formulario se acepta que los archivos de música estén vacios.
function validarMusica2(){
    let validar = document.getElementById('musicaProducto').value;
    if(validar == ""){
        return true;
    }else{
        validar = validarMusica();
        return validar;
    }
}
// (Jose) Esta función valida que no hayan campos vacios, dejando excentos los archivos.
function validarVacios2(){
    let vacios =  new Array(4);
    let numVacios= 0;
    vacios[0] = document.getElementById('nombreProducto').value;
    vacios[1] = document.getElementById('descripcion').value;
    vacios[2] = document.getElementById('cantidad').value;
    vacios[3] = document.getElementById('precio').value;
    for(let i=0; i<4; i++){
        let espacios = vacios[i].trim();
        if(vacios[i]== "" || espacios == ""){
            numVacios +=1;
        }
    }
    if(numVacios > 0){
        return false;
    }else{
        return true;
    }

}
// (Jose) Esta función valida que no hayan campos vacios en el formulario de modificarProveedor.php
function validarProveedor(){
    let vacios = new Array(3);
    let numVacios = 0;
    vacios[0] = document.getElementById('nombreProveedor').value;
    vacios[1] = document.getElementById('correoProveedor').value;
    vacios[2] = document.getElementById('telefono').value;
    for(let i =0; i<3; i++){
        let espacios = vacios[i].trim();
        if(vacios[i] == "" || espacios == ""){
            numVacios += 1;
        }
    }
    if(numVacios > 0){
        return false;
    }else{
        return true;
    }
}
// (Jose) Esta función valida todo para antes de enviar el formulario, se aplica solo en modificarProducto.php
function validarTodo2(){
    if(validarVacios2()){
        let precio = valNum('precio');
        let cantidad = valNum('cantidad');
        let categoria =valCat();
        let imagen = validarImagen2();
        let musica = validarMusica2();
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
        if(precio && cantidad && categoria && imagen && musica){
            document.formularioAgregar.submit(); 
        }else{
            toastr['info']('Por favor corregir los errores para continuar.');
        }
    }else{
        toastr['info']("No se permiten campos vacíos.");
    }
}

// (Jose) Esta función valida el email
function validarEmail(){
    let email = document.getElementById("correoProveedor").value;
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
// (Jose) Esta función valida todo para antes de enviar el formulario, se aplica solo en modificarProveedor.php
function validarTodo3(){
    if(validarProveedor()){
        let telefono = validarNumero('telefono');
        let email = validarEmail();
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
        if(telefono && email){
            document.proveedor.submit(); 
        }else{
            toastr['info']('Por favor corregir los errores para continuar.');
        }
    }else{
        toastr['info']("No se permiten campos vacíos.");
    }
}