let rock = document.getElementById('toRock');
let pop =document.getElementById('toPop');
let jazz = document.getElementById('toJazz');

pop.addEventListener('click', () =>{
    window.location = '../pagina/pop.php';
})

jazz.addEventListener('click', () =>{
    window.location = '../pagina/jazz.php';
})
rock.addEventListener('click', () =>{
    window.location = '../pagina/rock.php';
})