<?php 
include('conectar.php');
session_start();
if (!isset($_SESSION['user'])) {
	header("Location:index.php");
}

        // mysql_query("SELECT * FROM registro ASC LIMIT 0,5");
$user=mysqli_query($conexion,"SELECT * FROM usuario WHERE user='".$_SESSION['user']."'");
$a = $user->fetch_assoc();

if (isset($_REQUEST['cerrar'])){
	session_destroy();
	header("Location:index.php");
}
$TAMANO_PAGINA = 5; 
//examino la página a mostrar y el inicio del registro a mostrar 
@$pagina  = $_GET["pagina"];
if (!$pagina) { 
   	$inicio = 0; 
   	$pagina=1; 
} 
else { 
   	$inicio = ($pagina - 1) * $TAMANO_PAGINA;   	
}
//para las paginas
if (isset($_GET['busqueda'])) {

	$buscar=$_GET['busqueda'];
	$ssql = "SELECT*FROM registro WHERE nombre='".$buscar."' or tipo='".$buscar."' or nombre like '%".$buscar."%' "; 
	$rs = mysqli_query($conexion,$ssql); 
	$num_total_registros = mysqli_num_rows($rs); 
	//calculo el total de páginas 
	$ssql = "SELECT*FROM registro WHERE nombre='".$buscar."' or tipo='".$buscar."' or nombre like '%".$buscar."%' LIMIT " . $inicio . "," . $TAMANO_PAGINA; 
}else if (isset($_GET['tipoo'])) {
				$tipo=$_GET['tipoo'];
				$ssql = "SELECT*FROM registro WHERE tipo='".$tipo."'"; 
				$rs = mysqli_query($conexion,$ssql); 
				$num_total_registros=mysqli_num_rows($rs);

$ssql= "SELECT*FROM registro WHERE tipo='".$tipo."' LIMIT " . $inicio . "," . $TAMANO_PAGINA;
}





//para las categorias.
if(isset($_REQUEST['buscar']) && !empty($_REQUEST['buscar'])) {
		$buscar=$_POST['buscar'];
		//miro a ver el número total de campos que hay en la tabla con esa búsqueda 
		$ssql = "SELECT*FROM registro WHERE nombre='".$buscar."' or tipo='".$buscar."' or nombre like '%".$buscar."%' "; 
		$rs = mysqli_query($conexion,$ssql); 
		$num_total_registros = mysqli_num_rows($rs); 
		//calculo el total de páginas 

		$ssql = "SELECT*FROM registro WHERE nombre='".$buscar."' or tipo='".$buscar."' or nombre like '%".$buscar."%' LIMIT " . $inicio . "," . $TAMANO_PAGINA; 
//para la lista desplegable
}else if (isset($_REQUEST['categoria'])) {
			$categoria=$_POST['categoria'];
		 	for ($i=0;$i<count($categoria);$i++) { 
	      		$tipo=$categoria[$i]; 
      		}
      		//miro a ver el número total de campos que hay en la tabla con esa búsqueda 
			$ssql = "SELECT*FROM registro WHERE tipo='".$tipo."'"; 
			$rs = mysqli_query($conexion,$ssql);
			$num_total_registros = mysqli_num_rows($rs);

$ssql= "SELECT*FROM registro WHERE tipo='".$tipo."' LIMIT " . $inicio . "," . $TAMANO_PAGINA;
//para que se quede como estaba
//		$query=$rs;
//		$row= mysqli_fetch_assoc($query);
}
//par ambos medios de envio de informacion
if (isset($_GET['registros'])) {
	$num_total_registros=$_GET['registros'];
	$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA); 
}else{
	@$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA); 
}
?>
<html>
<link rel="stylesheet" type="text/css" href="css/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/lol.css">
<head>
	<title>National Sport | Inicio</title>
	<meta name="viewport" content="width=device-widht, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, min-scale=1.0">
</head>
<body > 


<header>
<nav class="navbar navbar-default">
<div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header" id="mibarra">
	    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navegacion-leo" aria-expanded="false">
		    <span class="sr-only">Toggle navigation</span>
		    <span class="icon-bar"></span>
		    <span class="icon-bar"></span>
		    <span class="icon-bar"></span>
	    </button>
	    <a class="navbar-brand" href="index2.php"><img id="logo" src="iconos/NSS.png"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
 	<div class="collapse navbar-collapse" id="navegacion-leo">
	    <ul class="nav navbar-nav">
	        <li class="active"><a href="index2.php">Inicio<span class="sr-only">(current)</span></a></li>
		    <!--<ul class="dropdown-menu">
		            <li role="separator" class="divider"></li>  
		        </ul> -->
	        
	        <form action="index2.php" method="POST" id="busqueda" class="navbar-form navbar-left" role="search" >
				<input type="text" name="buscar" placeholder="Buscar por nombre" size="30" class="form-control" id="search_form">
				<div class="form-group">
					<select name="categoria[]" id="categoria" class="form-control">
						<option>Busca por categoria</option>
						<option value="ropa">Ropa</option>
						<option value="tenis">Tenis Deportivos</option>	
					</select>
				</div>
				<input type="submit" value="buscar" class="btn btn-primary" class="glyphicon glyphicon-search">
			</form>	
	    </ul>

		 
      <?php 
      $s = "SELECT*FROM micarro WHERE usuario='".$_SESSION['user']."'"; 
			$rs = mysqli_query($conexion,$s);
			$cc = mysqli_num_rows($rs);
       ?>
    <ul class="nav navbar-nav navbar-right">
		<a href="car.php?"><button class="btn btn-danger"><span class="glyphicon glyphicon-shopping-cart" class="badge"><?php echo $cc; ?></span></button></a>        
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img id="setting" src="iconos/setting.png"></a>
          <ul class="dropdown-menu">
            <li role="separator" class="divider"></li>
            <li><a href="index2.php? cerrar=1">Cerrar Sesión</a></li>
            <li><a href='agregar.php'>Agregar Productos</a></li>
            <li><a href='modificar.php'>Modificar Productos</a></li>		
          </ul>
        </li>
    </ul>

	</div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>
</header>
<!-- Seccion Gray-->
<section class="jumbotron">
	<div class="container">
		<h1>National Sport</h1>
		<p>Encuentra todo lo que Buscas.</p>
	</div>
</section>
<!-- /Seccion Gray-->

<!-- /Seccion mostrar imagenes-->
<section class="main container">
	<div class="row">
		<section class="posts col-md-9">
			<div class="miga-de-pan">
				<ol class="breadcrumb">
					<li class="active">Inicio</li>
				</ol>
			</div>
	        
	        <!-- //<a href="#" class="thumb pull-left">
						<img class="img-thumbnail" height="300px" src="image/Tenis Adidastenis.jpg" alt="">
					</a>
					<h2 class="post-title" style='color:white;'>
						<a href="#">Tenis Adidas</a>
					</h2>
					<p class="post-contenido text-justify" style='color:white;'>
						TENIS ADIDAS IDEALES PARA CORRER O HACER CUALQUIER TIPO DE ACTIVIDAD FISICA. ES UN MODELO SENCILLO PERO MUY BONITO Y BARATO. 
					</p>

					<div class="contenedor-botones">
						<a href="#" class="btn btn-success" onclick="agregar()">Agregar al Carrito</a>
            </div> //-->
            <nav>
               <hr>
               <hr>
            </nav>
			
</section>

<!-- /Seccion Mostrar imagenes-->

<script src="js/jquery.js"></script>
<script src="css/js/bootstrap.min.js"></script>
<br>
<!-- Pie de pagina-->
<div width="100">
<?php 
//Para mostrar los hipervinculos de la paginacion
if($total_paginas>1){ 
  	for($i=1;$i<=$total_paginas;$i++){ 
      	if($pagina==$i){
         	//si muestro el índice de la página actual, no coloco enlace 
         	echo $pagina ." ";
        }else {
         	//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página 
	           if(isset($tipo)) {
	         		echo "<td><a href='index2.php?pagina=".$i."&tipoo=".$tipo."&registros=".$num_total_registros."' color='red'>" .$i. "</a></td>";
	         	}else {
	         		echo "<td><a href='index2.php?pagina=".$i."&busqueda=".$buscar."&registros=".$num_total_registros."'>" .$i. "</a></td>";
	         		}
	         }		
	} 
}
echo "<br>";
 ?>
</div>
<!-- /Pie de pagina-->


<br>
<br>
<br>
<section class="container">
<br><br>
<?php 
	if(isset($num_total_registros)){
		$rs = mysqli_query($conexion,$ssql);
		while ($fila = mysqli_fetch_object($rs)){ 
		 //ESTO CREO QUE MUESTRA EL NOMBRE DE LAS CONSULTAS POR AHORA LO DEJARE ASI
			  echo "<link rel='stylesheet' type='text/css' href='css/css/bootstrap.min.css'>
				  	<link rel='stylesheet' type='text/css' href='bootstrap/css/lol.css'>
		 		  	<section class='contenido'>
			 			 <br><br>
                         <article>
				 			<a href='' class='thumb pull-left'><img src='image/".$fila->nombre.$fila->foto." 'class='thumbnail' width='190' height='120'></a><br><br><br>
							<h2 class='post-title'>".$fila->nombre."</h2>
							<p></p>
							<p class='post-contenido text-justify' style='color:white;'>".$fila->descripcion."</p>
							<p class='post-contenido text-justify style='color:white;''>$ ".$fila->Precio."</p>
							<a href='index4.php?id=".$fila->id."' class='btn btn-info'>Leer mas</a>
							<a href='car.php?id=".$fila->id."' class='btn btn-success'>Agregar al carrito</a>
							<br>
							<br>
                            <br>
							<hr><hr>
						</article>
                        
					</section>";
		} 
		//pongo el número de registros total, el tamaño de página y la página que se muestra 
		//echo "<br>Número de registros encontrados: " . $num_total_registros . "<br>"; 
		//echo "Se muestran páginas de " . $TAMANO_PAGINA . " registros cada una<br>"; 
		//cerramos el conjunto de resultado y la conexión con la base de datos 
		mysqli_free_result($rs); 
		mysqli_close($conexion);
	}
?>
</section>






</body>
</html>



