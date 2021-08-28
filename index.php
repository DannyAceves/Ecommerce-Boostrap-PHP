<?php
 include('conect.php');
session_start();
if (isset($_SESSION['user'])) {
	header("Location:index2.php");
}
if(isset($_REQUEST['u']) && !empty($_REQUEST['u'])){
	$u=$_REQUEST['u'];
	$p=$_REQUEST['p'];
	$siesta=mysqli_num_rows(mysqli_query($a,"SELECT * FROM usuario WHERE user='$u' AND password='$p'"));
	if ($siesta==1) {
		$_SESSION['user']=$u;
		header("Location:index.php");
	}else{
		echo ' <script language="javascript">alert("Usuario o Contraseña incorrecta");</script> ';
	}
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<title>National Sport Store</title>
	<link rel="stylesheet" href="css/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/lol.css">
</head>
<body>
	<header>
		<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navegacion-fm">
						<span class="sr-only">Desplegar / Ocultar Menu</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="#" class="navbar-brand"><img id="logo" src="iconos/NSS.png"></a>
				</div>

				<!-- Inicia Menu -->
				<div class="collapse navbar-collapse" id="navegacion-fm">
					<form class="form-inline" id="sesion">
						<div class="form-group">
						    <label class="sr-only" for="exampleInputEmail3">Email address</label>
						    <input type="email" class="form-control" id="exampleInputEmail3" placeholder="&#128272; Email" name="u" >
						</div>
						<div class="form-group">
						    <label class="sr-only" for="exampleInputPassword3">Password</label>
						    <input type="password" class="form-control" id="exampleInputPassword3" placeholder="&#128272; Password" name="p" >
						</div>
						<button type="submit" class="btn btn-success">Iniciar Sesion</button>
						
					</form>
					<form id="registro" action="registro.php" class="navbar-form navbar-right">
				            <a href="registro.php"><button  class="btn btn-warning">Registrarse</button></a>
						</form>
				</div>
			</div>
		</nav>
	</header>

	<section class="jumbotron">
		<div class="container">
			<h1>National Sport</h1>
			<p>Encuentra tus Productos de Deportes a costos muy accesibles</p>
		</div>
	</section>

	<section class="main container">
		<div class="row">
			<section class="posts col-md-9">
				<div class="miga-de-pan">
					<ol class="breadcrumb">
						<li><a href="#">Inicio</a></li>

					</ol>
				</div>

				<article class="post clearfix">
					<a href="#" class="thumb pull-left">
						<img class="img-thumbnail" src="image/Tenis Adidastenis.jpg" alt="">
					</a>
					<h2 class="post-title">
						<a href="#">Tenis Adidas</a>
					</h2>
					<p class="post-contenido text-justify">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
					</p>

					<div class="contenedor-botones">
						<a href="#" class="btn btn-success" onclick="agregar()">Agregar al Carrito</a>
					</div>
				</article>

				<article class="post clearfix">
					<a href="#" class="thumb pull-left">
						<img class="img-thumbnail" src="image/Tenis Nikenike-air-max-zero.jpg" alt="">
					</a>
					<h2 class="post-title">
						<a href="#">Tenis Nike</a>
					</h2>
					<p class="post-contenido text-justify">
						<strong>Tenis Nike</strong> con un modelo rudo, pero comodo a el estilo basquetbolista de un impresionante diseño y modelo. Util y satisfacorio para entrenar o realizar algún deporte en especifico.
					</p>

					<div class="contenedor-botones">
						<a href="#" class="btn btn-success" onclick="agregar()">Agregar al Carrito</a>
					</div>
				</article>

				<article class="post clearfix">
					<a href="#" class="thumb pull-left">
						<img class="img-thumbnail" src="image/OUTFITFB_IMG_14649196755508837.jpg" alt="">
					</a>
					<h2 class="post-title">
						<a href="#">Outfit </a>
					</h2>
					<p class="post-contenido text-justify">
				        <strong>Outfit</strong> comodo para todo tipo de personas ya que tienen a entrenar y a muchos les gusta lucir de una manera explendida al hacer sus rutinas y entrenamientos.
					</p>

					<div class="contenedor-botones">
						<a href="#" class="btn btn-success" onclick="agregar()">Agregar al Carrito</a>
					</div>
				</article>

				
			</section>

			
		</div>
	</section>

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-xs-6">
					<p style="color:white;">&copy; 2015 National Sport by DannyAceves	</p>
				</div>
				
			</div>
		</div>
	</footer>

	<script src="js/jquery.js"></script>
<script src="css/js/bootstrap.min.js"></script>
<script>
		function agregar(){
			a=confirm("No puedes Agregar al carrito primero debes iniciar sesion o Registrarte");
    	if(a){
      	window.location.href="index.php";
    }
		}
	</script>
</body>
</html>