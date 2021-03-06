*{
	margin: 0px;
	padding: 0px;
}
.limpiar{
	clear:both;
}
.centrado{
	text-align: center;
}
.derecha{
	text-align: right;
}
.codigo, pre{
	background-color: #222;
	color:#43F143;
	width: 100%;
	padding-left: 30px;
    line-height: 1.5em;
	padding-bottom: 15px;
}

body{
  background-color: #DDD;
  min-width: 100px;
}

#cabecera{
	position: static;
	height: auto;
	min-width: 220px;
	width: 100%;
}

#cabecera #titulo, #navbar{
	display:block;
	font-family: arial;
	min-width: 220px;
}

#cabecera #titulo{
	font-size: 2em;
	line-height: 3em;
	text-align: center;
	background-color: #224466;
	max-height: 100%;
	color:orange;
	
}
#cabecera #titulo:after{
	content:" - Movil";
}
#cabecera #titulo a{
	text-decoration: none;
	color:#FFFFFF;
}

#cabecera #navbar{
	display: block;
	text-align: center;
}

#cabecera #navbar ul{
	background-color: #444444;

}

#cabecera #navbar ul li{
	list-style: none;
	height: 4em;
	display:block;
	width:100%;
	border: 1px dotted grey;

}

#cabecera #navbar ul li a{
	display: block;
	font-size: 2em;
	line-height: 2em;
	text-decoration: none;
	color: #FFFFFF;
	width: 100%;
	text-align: center;
	height: auto;
}

#contenedor{
	padding: 30px 10px 10px 10px;
}

#footer{
	display: none;
}

/* ======================= INICIO ==========================*/
#inicio_view img{
	display: block;
	width: 500px;
	height: 500px;
	margin: 0px auto;
}

#inicio_view{

}
#presentacion *{
	text-align: justify;
}
#presentacion{
	width: 100%;
}
#presentacion h3{
	text-align: center;
	background-color: #4444FF;
	color:white;
}

#accesos .acceso{
	margin: 50px 0px;
}

#accesos .acceso h4{
	text-align: center;
	background-color: #4444FF;
	color:white;
}
.enlace_boton{
	background-color: #5866B0;
	padding: 1px 15px 1px 15px;
	color: #FFFFFF;
	text-decoration: none;
	border-radius: 30px;
}

/* ======================= PERFIL ==========================*/

#perfil_view img{
	display: block;
	width: 300px;
	height: 300px;
	margin: 40px auto;
}
#perfil_view #info_personal #social{
	text-align: center;
}
#perfil_view #info_personal #social img{
	display: inline;
	width: 80px;
	height: 80px;
	margin: 40px 20px 10px 20px;
}
.frase{
	color: #DD5555;
	text-shadow: 0px 0px 3px grey;
	text-align: center;
}
#perfil_view #nombre{
	font-size: 1.4em;
	color: #FFFFFF;
	background-color:#4444FF;
	text-align: center;
	margin: 40px 20px 10px 20px;
}

/* ======================= BLOG ==========================*/

#blog_menu_lateral{
	display: none;
}

#blog_cabecera_titulo{
	font-size: 1.4em;
	color: #FFFFFF;
	background-color:#4444FF;
	text-align: center;
	margin: 40px 20px 10px 20px;
}

#blog_lista_articulos{
	margin: 40px 0px 0px 30px;
}

#blog_lista_articulos .articulo{
	border: 4px solid #444444;	
	margin: 50px 0px 20px 0px;

}

#blog_lista_articulos .articulo .articulo_contenido{
	padding: 0px 15px 15px 15px;
}
#blog_lista_articulos .articulo .articulo_titulo, #post_titulo{
	font-size: 1.8em;
	color: #FFFFFF;
	background-color: #777777;
	padding: 10px 20px 10px 20px;
	text-align: center;

}
#blog_lista_articulos .articulo .articulo_subtitulo, #post_subtitulo{
	font-size: 50%;
	color: #CCCCCC;
	background-color: #555555;
	padding: 10px 20px 10px 20px;
	

}

#blog_lista_articulos .articulo img, #post_view img{
	display: block;
	width: 70%;
	margin: auto;
}
.boton_continuar{
	display:block;
	background-color: #96B3FF;
	padding: 3px 6px 3px 6px;
	line-height: 1.3em;
	font-weight: bold;
	color:#FFFFFF;
	width: 100%;
	text-align: center;
}
.boton_continuar a{
	text-decoration: none;
}

.categoria a{
	background-color:#183C5A;
	border-radius: 3px;
		-o-border-radius: 3px;
		-moz-border-radius: 3px;
		-webkit-border-radius: 3px;
	color:#6EF9FF;
	
	cursor: pointer;
	margin: 0px 0px 0px 0px;
	padding: 3px 5px 3px 5px;
	text-decoration: none;
	
}

.categoria{
	margin:50px 0px 50px 30px;
}

/* ======================= CONTACTO VIEW ==========================*/

#contacto_view{
	width: 100%;
}
#contacto_view #contacto_titulo{
	width: 100%;
	text-align: center;
}
#contacto_view #contacto_titulo h1{
	font-size: 3.6em;
	color: #222222;
	text-shadow: 0px 0px 2px #AAAAAA;
}

#contacto_view table{
	width: 100%;
}
#contacto_view table tr{
	width: 100%;
}
#contacto_view table tr td{
	width: 100%;
}
#contacto_view table tr td label{
	width: 100%;
	font-size: 3em;
}
#contacto_view table tr td input, textarea{
	width: 100%;
	font-size: 4em;
	
}
#contacto_view table tr td input[type='button']{
	background-color: #3333AA;
	color:white;
	padding: 40px 0px 40px 0px;
}
	

