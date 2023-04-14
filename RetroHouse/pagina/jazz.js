let rock = document.getElementById('toRock');
let pop =document.getElementById('toPop');

pop.addEventListener('click', () =>{
    window.location = '../pagina/pop.php';
})

rock.addEventListener('click', () =>{
    window.location = '../pagina/rock.php';
})

function productoBuscar(){
    let valor ={"nombre": document.getElementById("nombreBuscar").value};
    $.ajax({
        data:valor,
        url: "./buscarJazz.php",
        method:"POST",
        success:function(message){
            $("#divProductos").html(message);
        }
    });
}
