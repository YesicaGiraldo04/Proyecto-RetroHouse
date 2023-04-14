function productoBuscar(){
    let valor ={"nombre": document.getElementById("nombreBuscar").value};
    $.ajax({
        data:valor,
        url: "./buscarPop.php",
        method:"POST",
        success:function(message){
            $("#divProductos").html(message);
        }
    });
} 

let rock = document.getElementById('toRock');
let jazz = document.getElementById('toJazz');

jazz.addEventListener('click', () =>{
    window.location = '../pagina/jazz.php';
})
rock.addEventListener('click', () =>{
    window.location = '../pagina/rock.php';
})


