function contenido(where){
	var texto=document.getElementById("text"+where+"1");
	let noticias=document.getElementById("noticias");
	if(texto!==null || noticias!==null){
		var parametros={
			"id" : where
		};
		$.ajax({
			data:  parametros,
			url:   'php/base.php',
			type:  'post',
			success:  function (response) {
				var tex=$.parseJSON(response);
				for (var i = 0; i < tex.length+1; i++) {
					if(i!==tex.length){
						if(where=="News"){
							news(i+1,tex[i][1],tex[i][2],tex[i][3]);
						}else if(where=="Home"){
							let titulo=document.getElementById("title"+where+(i+1));
							let texto=document.getElementById("text"+where+(i+1));
							let img=document.getElementById("image"+where+(i+1));
							titulo.innerHTML=tex[i][1];
							texto.innerHTML=tex[i][2];
							img.src=tex[i][3];
						}
					}if(i==tex.length){
						if(where=="News"){
							$('.noticias').slick({
								slidesToShow: 1,
								slidesToScroll: 1,
								autoplay: true,
								autoplaySpeed: 3000,
							});
						}
					}
				}
			}
		});
	}
}

function news(id,titulo,texto,imagen){
	let noticias=document.getElementById("noticias");
	if(noticias!==null){
		let general=document.createElement("div");
		let noticiaTitle=document.createElement("div");
		let noticia=document.createElement("div");
		let img=document.createElement("img");
		noticiaTitle.setAttribute('id','titleNews'+id);
		noticia.setAttribute('id','textNews'+id);
		noticiaTitle.classList.add('noticiaTitle');
		img.classList.add("imgNews");
		noticia.classList.add('noticia');
		general.appendChild(noticiaTitle);
		general.appendChild(img);
		general.appendChild(noticia);
		noticias.appendChild(general);
		noticiaTitle.innerHTML=titulo;
		noticia.innerHTML=texto;
		img.src=imagen;

	}
}



function login(){
	var parametros={
		"userFlag" : 1
	};
	$.ajax({
		data:  parametros,
		url:   'php/base.php',
		type:  'post',
		success:  function (response) {
			console.log(response);
			if($.parseJSON(response)==false){
				alert("el usuario y la contraseña no coinciden");
			}else if($.parseJSON(response)[0][12]!=undefined){
				if($.parseJSON(response)[0][12]=="administrador"){
					var menu=document.getElementById("config");
					var config=document.createElement("a");
					config.setAttribute("id","bd");
					config.setAttribute("href","php/PHPhelp/index.php");
					config.setAttribute("target","_blank");
					config.innerHTML="Bases de Datos";
					menu.appendChild(config);
				}
				var perf=document.getElementById("perfil");
				var config=document.createElement("a");
				config.setAttribute("id","changeProfile");
				config.setAttribute("href","form_usuario.html");
				config.innerHTML="Perfil";
				perf.appendChild(config);
			}
			if(typeof calendar!="undefined"){
				calendar.calendarLogin($.parseJSON(response));	
			}
		}
	});
}
function logout(){
	var parametros={
		"userFlag" : 2
	};
	$.ajax({
		data:  parametros,
		url:   'php/base.php',
		type:  'post',
		success:  function (response) {
			var loginButton=document.getElementById("loginButton");
			var loginBox=document.getElementById("loginBox");
			if($.parseJSON(response)=="guest"){
				if(loginButton.removeEventListener){
					loginButton.removeEventListener("click",out);
				}
				loginButton.innerHTML= '<span>Iniciar sesi&oacute;n</span></a>';
				if(loginBox.childElementCount==0){
					loginBox.innerHTML=`               
					<form action="php/base.php" id="loginForm">
					<fieldset id="body">
					<fieldset>
					<label for="user">User</label>
					<input type="text" name="user" id="user">
					</fieldset>
					<fieldset>
					<label for="password">Password</label>
					<input type="password" name="password" id="password">
					</fieldset>
					<input type="submit" id="login" value="Iniciar">
					<label for="checkbox"><input type="checkbox" id="checkbox"> <i>Recordarme</i></label>
					</fieldset>
					<span><a href="#">¿Olvido su contrase&ntilde;a?</a></span>
					</form>`;
					loginBox.style.display="none";
					location.reload();
				}
				let menu=document.getElementById("config");
				let config=document.getElementById("bd");
				if(menu!==null && config!==null){
					menu.removeChild(config);
				}
			}else{
				loginButton.innerHTML='<span>Cerrar sesi&oacute;n</span></a>';
				loginBox.innerHTML="";
				loginButton.addEventListener("click",out);
			}
		}
	});
}
function out(){
	var parametros={
		"userFlag" : 3
	};
	$.ajax({
		data:  parametros,
		url:   'php/base.php',
		type:  'post',
		success:  function (response) {
			login();
			logout();
		}
	});
}
function biblioteca(rama){
	var main=document.getElementById("bibliotecaMain");
	if(main!=null){
		main.innerHTML="";
		var parametros={
			"rama" : rama
		};
		$.ajax({
			data:  parametros,
			url:   'php/base.php',
			type:  'post',
			success:  function (response) {
				var bibliotecaResponse=$.parseJSON(response);
				for (var i = 0; i < bibliotecaResponse.length+1; i++) {
					let article=document.createElement("article");
					let hiperVinculo=document.createElement("a");
					let img=document.createElement("img");
					let barra=document.createElement("div");
					let letra=document.createElement("div");

					article.classList.add('item');
					hiperVinculo.setAttribute("target","_blank");
					hiperVinculo.href=bibliotecaResponse[i][5];
					var imgUrl;
					if(bibliotecaResponse[i][4]=="lobato"){
						imgUrl="imagenes/biblioteca_img/lobatos/lobatos.png";
					}else if(bibliotecaResponse[i][4]=="scout"){
						imgUrl="imagenes/biblioteca_img/scout/scout.png";
					}else if(bibliotecaResponse[i][4]=="caminante"){
						imgUrl="imagenes/biblioteca_img/caminantes/caminantes.png";
					}else if(bibliotecaResponse[i][4]=="rover"){
						imgUrl="imagenes/biblioteca_img/rovers/rovers.png";
					}else{
						imgUrl="imagenes/pdf.png";
					}
					img.src=imgUrl;
					img.setAttribute("width","100%");
					img.setAttribute("height","100%");


					barra.setAttribute("id","barra");
					letra.setAttribute("id","letra");
					letra.innerHTML=bibliotecaResponse[i][1];
					letra.setAttribute("style","font-size:90%");

					barra.appendChild(letra);
					hiperVinculo.appendChild(img);
					hiperVinculo.appendChild(barra);
					article.appendChild(hiperVinculo);
					main.appendChild(article);
				}
			}
		});
	}
}

contenido("News");
contenido("Home");
biblioteca("");
login();
logout();
