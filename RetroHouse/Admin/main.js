
function verifyToAddStyles() {
  let confirmPassword = document.getElementById('confirmPwd').value;
  let password = document.getElementById('pwd').value;
  let label = document.getElementById('labelPwd');
  if (password !== confirmPassword) {
      label.style.color = "#F00";
  }else{
      label.style.color = "#302d04";
  }
}

function validarNombre() {
let nombre = document.getElementById('name').value;
const patternName = /^[a-zA-ZáéíóúñÑÁÉÍÓÚ\s]+$/;
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
if (!patternName.test(nombre)) {
  nombre.value = "*";
  toastr['info']("El nombre ingresado no es válido", "Nombre Completo")
  return false
}
}

function validarNumero() {
let dni = document.getElementById('dni').value;
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
const patternNumber = /^[0-9]+$/;
if (!patternNumber.test(dni)) {
  toastr['info']("El documento no puede contener letras.", "Documento");
  return false;
}
if(dni.length < 6){
  toastr['info']("El documento debe de tener mínimo seis dígitos.", "Documento")
  }else{
    return true;
  }
}

function validarNumero2() {
let celular = document.getElementById('number').value;
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


const patron = /^[0-9]+$/;
if (!patron.test(celular)) {
  toastr['info']("El celular no puede contener letras.", "Celular");
  return false;
}else if(celular.length < 10){
  toastr['info']("El celular debe tener mínimo 10 números", "Celular");
  return false;
}else{
  return true;
}

}

function validarPassword() {
const password = form.elements.pwd.value;
const confirmPwd = form.elements.confirmPwd.value;
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
if (password.length < 8) {
  toastr['info']("La contraseña debe de contener mínimo 8 caracteres.", "Contraseña")
  return false;
}else if(password !== confirmPwd){
  toastr['info']("Las contraseñas deben de coincidir.", "Confirmar Contraseña")
  return false;
}

return true;
}



function validarTodo(){
  const password = form.elements.pwd.value;
  const confirmPwd = form.elements.confirmPwd.value;
  const email = form.elements.email.value;
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  let celular = document.getElementById('number').value;
  let dni = document.getElementById('dni').value;
  let nombre = document.getElementById('name').value;
  let ciudad = document.getElementById('city').value;
  const patternName = /^[a-zA-ZáéíóúñÑÁÉÍÓÚ\s]+$/;

  // Configuramos los estilos de las alertas
  toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": true,
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
  if (!patternName.test(nombre)) {
    nombre.value = "*";
    toastr['info']("El nombre ingresado no es válido", "Nombre Completo")
    return false
  }
  const patternNumber = /^[0-9]+$/;
  if (!patternNumber.test(dni)) {
    toastr['info']("El documento no puede contener letras.", "Documento");
    return false;
  }
  if(dni.length < 6){
    toastr['info']("El documento debe de tener mínimo seis dígitos.", "Documento")
    return false
    }
  const patron = /^[0-9]+$/;
  if (!patron.test(celular)) {
    toastr['info']("El celular no puede contener letras.", "Celular");
    return false;
  }else if(celular.length < 10){
    toastr['info']("El celular debe tener mínimo 10 números", "Celular");
    return false;
  }
  if (password.length < 8) {
    toastr['info']("La contraseña debe de contener mínimo 8 caracteres.", "Contraseña")
    return false;
  }
  if(password !== confirmPwd){
    toastr['info']("Las contraseñas deben de coincidir.", "Confirmar Contraseña")
    return false;
  }
  if(ciudad == "N/N"){
    toastr['info']("Seleccionar una ciudad", "Ciudad");
    return false;
  }
  if(!emailRegex.test(email)){
    toastr['info']("El Email ingresado es inválido", "Correo Electrónico");
    return false;
  }

  return true;
};


function validarEmail() {
// Expresión regular para validar el formato del email
const email = form.elements.email.value;
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

if(!emailRegex.test(email)){
  toastr['info']("El Email ingresado es inválido", "Correo Electrónico");
  return;
}
}