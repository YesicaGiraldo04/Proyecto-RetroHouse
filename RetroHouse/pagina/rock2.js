let pop =document.getElementById('toPop');
let jazz = document.getElementById('toJazz');

pop.addEventListener('click', () =>{
    window.location = '../pagina/pop.php';
})

jazz.addEventListener('click', () =>{
    window.location = '../pagina/jazz.php';
})

function productoBuscar(){
    let valor ={"nombre": document.getElementById("nombreBuscar").value};
    $.ajax({
        data:valor,
        url: "./buscarRock.php",
        method:"POST",
        success:function(message){
            $("#divProductos").html(message);
        }
    });
}
