var blur = "blur(6px)";
function activar_pass(){
    document.getElementById("validar-admin").style.display = "block";
    document.getElementById("pass").value = "";
    document.getElementById("header").style.filter = blur;
    document.getElementById("contenedor").style.filter = blur;
    document.getElementById("footer").style.filter = blur;
    
    document.getElementById("pass").focus();
}
function cancelar(){
    document.getElementById("validar-admin").style.display = "none";
    document.getElementById("pass").value = "";
    document.getElementById("header").style.filter = "blur(0px)";
    document.getElementById("contenedor").style.filter = "blur(0px)";
    document.getElementById("footer").style.filter = "blur(0px)";
}