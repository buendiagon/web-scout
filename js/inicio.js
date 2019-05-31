
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
		<ul>
			<li><a href="index.html">Inicio</a></li>
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
<footer id="footer">
	<div class="inner">
		<h2>Somos Scout Guaviare</h2>
		<a href="#">Ub&iacute;canos</a> 
		<p class="copyright">© 2019 Scout de San Jose del Guaviare. Todos los derechos reservados</p>
		<p class="copyright">Unete y explora, estamos todos unidos.</p>
	</div>
</footer>
<!-- Aqui termina el footer	 -->`;