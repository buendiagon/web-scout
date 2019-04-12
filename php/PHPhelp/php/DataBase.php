<!--contenedorcreadoparaelcampodetextodelaelecciondelabasededatos--> 
<div id="contenedorBaseDatos"></div>
<!--scriptquealcargarlapaginacreauncampodetextovacioparapoderingresarlabasededatos--> 
<script type ="text/javascript"> 
	window.onload=function(){
	document.getElementById("contenedorBaseDatos").innerHTML='<form name="form" id="forma" action="" method="GET">nombreBD: <input type="text" name="nombreBD"><br /><input type="submit" id="crear" name="action" value="crear"/><input type="submit" id="eliminar" name="action" value="eliminar"/>' + '<input type="submit" id="acceder" name="action" value="acceder"/></form>';
}
</script>
<!-- script que permite desabilitar un elemento -->
<script type="text/javascript">
    function foranea(elementos,inputt){
    	var input=document.getElementsByName("Input[]")[inputt];
      	d = elementos.value;
	  	if(d != "foreign"){
	    	input.disabled = true;
	  	}else{
	    	input.disabled = false;
	  	}
    }
</script>