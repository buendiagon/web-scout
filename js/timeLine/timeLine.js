function pasar(){

  window.sr = ScrollReveal();

  if ($(window).width() < 768) {

  	if ($('.timeline-content').hasClass('js--fadeInLeft')) {
  		$('.timeline-content').removeClass('js--fadeInLeft').addClass('js--fadeInRight');
  	}

  	sr.reveal('.js--fadeInRight', {
	    origin: 'right',
	    distance: '300px',
	    easing: 'ease-in-out',
	    duration: 800,
	  });

  } else {
  	
  	sr.reveal('.js--fadeInLeft', {
	    origin: 'left',
	    distance: '300px',
		  easing: 'ease-in-out',
	    duration: 800,
	  });

	  sr.reveal('.js--fadeInRight', {
	    origin: 'right',
	    distance: '300px',
	    easing: 'ease-in-out',
	    duration: 800,
	  });

  }
  
  sr.reveal('.js--fadeInLeft', {
	    origin: 'left',
	    distance: '300px',
		  easing: 'ease-in-out',
	    duration: 800,
	  });

	  sr.reveal('.js--fadeInRight', {
	    origin: 'right',
	    distance: '300px',
	    easing: 'ease-in-out',
	    duration: 800,
	  });


}

function timeLine(){
	let timeLine=document.getElementById("TimeLine");
	if(timeLine!==null){
		var parametros={
			"timeLine" : 'TimeLine'
		};
		$.ajax({
			data:  parametros,
			url:   'php/base.php',
			type:  'post',
			success:  function (response) {
				var array = $.parseJSON(response);
				for (var i = 0; i < array.length+1; i++) {
					// id=(i%6)+1;
					let side="js--fadeInLeft";
					if((i+1)%2==0){
						side="js--fadeInRight"
					}
					var id=i+1;
					let item=document.createElement("div");
					let imgTime=document.createElement("div");
					let content=document.createElement("div");
					let imgHeader=document.createElement("div");
					let titulo=document.createElement("h2");
					let fecha=document.createElement("div");
					let texto=document.createElement("p");
					let img=document.createElement("input");


					titulo.setAttribute("id","tituloTime");
					fecha.setAttribute("id","fecha");
					texto.setAttribute("id","texto");
					item.classList.add("timeline-item");
					imgTime.classList.add("timeline-img");
					content.classList.add("timeline-content", "timeline-card", side);
					imgHeader.classList.add("timeline-img-header");
					fecha.classList.add("date");
					imgHeader.appendChild(titulo);
					content.appendChild(imgHeader);
					content.appendChild(fecha);
					content.appendChild(texto);
					item.appendChild(imgTime);
					item.appendChild(content);
					if(i==array.length){


						replaceDiv(fecha);
						replaceDiv(texto);
						replaceDiv(titulo);
						let form=document.createElement("form");
						form.setAttribute("name","subida-imagenes");
						form.setAttribute("method","POST");
						form.setAttribute("enctype","multipart/form-data");
						form.setAttribute("action","php/base.php");
						let input = document.createElement("input");
						img.setAttribute("type","file");
						img.setAttribute("accept","image/*");
						img.setAttribute("name","imagenTime");
						img.classList.add("subir-img");
						input.setAttribute("type","submit");
						input.setAttribute("name","btn_time");
						input.setAttribute("value","subir");
						input.classList.add('bnt-more');
						content.appendChild(img);
						content.appendChild(input);
						form.appendChild(content);
						item.appendChild(form);
						timeLine.appendChild(item);



					}else{
						timeLine.appendChild(item);
						imgHeader.setAttribute("style","background: linear-gradient(transparent, rgba(0, 0, 0, 0.4)), url('"+array[i][3]+"') center center no-repeat;background-size: cover");
						// imgHeader.setAttribute("style","background-size: cover;");
						texto.innerHTML=array[i][2];
						titulo.innerHTML=array[i][1];
						fecha.innerHTML=array[i][4];
					}
					// contenido("TimeLine",id);
				}
				pasar();
			}
		});
	}
}
function replaceDiv(element){
	let parent=element.parentElement;
	let idAttribute=element.getAttribute("id");
	let classAttribute=element.getAttribute("class");
	console.log(classAttribute);
	parent.removeChild(element);
	let newElement = document.createElement("input");
	newElement.setAttribute("type","text");
	newElement.setAttribute("id",idAttribute+"Time");
	newElement.setAttribute("name",idAttribute);
	// newElement.setAttribute("va")
	if(classAttribute!=null){
		newElement.classList.add(classAttribute);
	}
	parent.appendChild(newElement);
	parent.setAttribute("style","font-size:10px");
	newElement.setAttribute("style","color:black");
}
timeLine();