function contenido(where,id){
	var texto=document.getElementById("text"+where+id);
	var img=document.getElementById("image"+where+id);
	var titulo=document.getElementById("title"+where+id);
	if(texto!==null){
		var parametros={
			"id" : where+id
		};
		$.ajax({
			data:  parametros,
			url:   'php/base.php',
			type:  'post',
			success:  function (response) {
				var tex=$.parseJSON(response);
				if(tex.length!==0){
					if(texto){
						texto.innerHTML=tex[0][2];
					}
					if(titulo){
						titulo.innerHTML=tex[0][1];
					}
					if(img){
						img.src=tex[0][3];
					}
					let noticias=document.getElementById("noticias");
					if(where=="News"){
						news(id+1);
					}else if(where=="TimeLine"){
						let fecha=document.getElementById("fecha"+where+id);
						fecha.innerHTML=tex[0][4];
						timeLine(id+1);
					}else{
						contenido(where,id+1);

					}
				}else{
					if(where=="News"){
						texto.parentElement.remove();
						$('.noticias').slick({
							slidesToShow: 1,
							slidesToScroll: 1,
							autoplay: true,
							autoplaySpeed: 3000,
						});
					}else if(where=="TimeLine"){
						img.remove();
						texto.innerHTML="Ultima de este año";
					}
				}
			}
		});
	}
}

function news(id){
	let noticias=document.getElementById("noticias");
	if(noticias!==null){
		let general=document.createElement("div");
		let noticiaTitle=document.createElement("div");
		let noticia=document.createElement("div");
		noticiaTitle.setAttribute('id','titleNews'+id);
		noticia.setAttribute('id','textNews'+id);
		noticiaTitle.classList.add('noticiaTitle');
		noticia.classList.add('noticia');
		general.appendChild(noticiaTitle);
		general.appendChild(noticia);
		noticias.appendChild(general);
		contenido("News",id);
	}
}
function timeLine(id){
	let timeLine=document.getElementById("TimeLine");
	if(timeLine!==null){
		let step=document.createElement("div");
		let head=document.createElement("div");
		let body=document.createElement("div");
		let fecha=document.createElement("div");
		let fechaNumber=document.createElement("span");
		let titulo=document.createElement("h2");
		let texto=document.createElement("p");
		let img=document.createElement("img");
		step.classList.add("demo-card","demo-card--step"+id);
		head.classList.add("head");
		fecha.classList.add("number-box");
		body.classList.add("body");
		img.setAttribute("height","75%");
		img.setAttribute("alt","Graphic");
		fechaNumber.setAttribute("id","fechaTimeLine"+id);
		titulo.setAttribute("id","titleTimeLine"+id);
		texto.setAttribute("id","textTimeLine"+id);
		img.setAttribute("id","imageTimeLine"+id);
		fecha.appendChild(fechaNumber);
		head.appendChild(fecha);
		head.appendChild(titulo);
		body.appendChild(texto);
		body.appendChild(img);
		step.appendChild(head);
		step.appendChild(body);
		timeLine.appendChild(step);
		contenido("TimeLine",id);
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
			if($.parseJSON(response)==false){
				alert("el usuario y la contraseña no coinciden");
			}
			else if(typeof calendar!="undefined"){
				calendar.calendarLogin($.parseJSON(response));	
			}
		}
	});
}
function logout(){
	var parametros={
		"userFlag" : 1
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
		"userFlag" : 2
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
news(1);
timeLine(1);
contenido("Home",1);
login();
logout();
