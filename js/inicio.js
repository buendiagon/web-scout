
document.getElementById("menu").innerHTML=`
<section id="banner" data-img="images/banner">
	<div class="inner">
		<header>
			<h1>Scout del Guaviare</h1>
			<p>Grupo #2 Nukak Maku del Guaviare</p>
		</header>
		<a href="#lista" class="more">M&aacute;s</a>
	</div>
</section>
<div class="ancho">
	<div class="logo">
		<p>Scout Guaviare</p>
	</div>
	<nav id="lista">
		<ul class="nav2">
			<li><a href="index.html">Inicio</a></li>
			<li><a href="_manada.html">Manada</a>
				<ul class="expand_ramas">
					<li><a href="_tropa.html">Tropa</a></li>
					<li><a href="_comunidad.html">Comunidad</a></li>
					<li><a href="_clan.html">Clan</a></li>
				</ul>
			</li>
			<li><a href="time_line.html">Linea de Tiempo</a></li>
			<li><a href="biblioteca.html">Biblioteca</a></li>
			<li id="perfil"></li>
			<li id="config"></li>	
			<li>
				<a href="#" id="loginButton">
				<span>Iniciar sesi&oacute;n</span></a>

		

				<div id="loginBox">               
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
					</form>
				</div>				
				<div class="clearfix"></div>				
			</li>

		</ul>
	</nav>
</div>`;
document.getElementById("footer").innerHTML=`
<!-- aqui empieza el footer -->
<footer class="footer_idColor" id="footer">
	<div class="inner">
		<h2>Somos Scout Guaviare</h2>
		<a href="https://satellites.pro/mapa_de_San_Jose_del_Guaviare#2.568024,-72.639499,19" target="_blanck">Ub&iacute;canos</a> 
		<a href="https://www.facebook.com/Grupo-Scout-2-Nukak-Maku-Del-Guaviare-1713784762236698/" target="_blanck">Facebook</a> 
		<p class="copyright">© 2019 Scout de San Jose del Guaviare. Todos los derechos reservados</p>
		<p class="copyright">Unete y explora, estamos todos unidos.</p>
	</div>
</footer>
<!-- Aqui termina el footer	 -->`;