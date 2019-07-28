function cambio_ventana(item){
    if(item==='productos'){
        document.getElementById("productos").style.display = 'block';
        document.getElementById("informes").style.display = 'none';
        document.getElementById("configuracion").style.display = 'none';
    }
    if(item==='informes'){
        document.getElementById("productos").style.display = 'none';
        document.getElementById("informes").style.display = 'block';
        document.getElementById("configuracion").style.display = 'none';
    }
    if(item==='configuracion'){
        document.getElementById("productos").style.display = 'none';
        document.getElementById("informes").style.display = 'none';
        document.getElementById("configuracion").style.display = 'block';
    }
}