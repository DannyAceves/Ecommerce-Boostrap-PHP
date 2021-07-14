<?php 
include('conectar.php');
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
				$ssql = "SELECT*FROM productos WHERE tipo='".$tipo."'"; 
				$rs = mysqli_query($conexion,$ssql); 
				$num_total_registros = mysqli_num_rows($rs);

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
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="estyle.css">
</head>
<body>
<!--Buscador-->
<div id="titulo" >Tienda Online</div>
	<header>
	
		<form action="inicio3.php" method="POST" id="busqueda">

		<font color="white">Buscar Articulo</font>
			<input type="text" name="buscar" placeholder="Buscar Producto..." size="30">
			<select name="categoria[]" id="categoria" >
				<option>Busca por categoria</option>
				<option value="Electronica">Electronica</option>
				<option value="Videojuegos">Consolas/Videojuegos</option>
				<option value="Linea Blanca">Linea Blanca</option>
				<option value="Juguetes">Juguetes</option>
				<option value="Audio y Video">Audio y Video</option>
			</select>
			<input type="submit" value="buscar">
		</form>
<div id="caja2">
Usuario Registrado
<form method="get" action="iniciarSesion.php" >
<input type="submit" value="Iniciar Sesion" /></form>	
</div></header>
<section>
<?php 
	if(isset($num_total_registros)){
		$rs = mysqli_query($conexion,$ssql);
		echo "<table border=''>
				<tr>
					<td width='20%'>Nombre</td>
					<td width='50%'>Descripion</td>
					<td width='12%'>Foto</td>
					<td>Precio $</td>
				</tr>
";
		while ($fila = mysqli_fetch_object($rs)){ 
		 //ESTO CREO QUE MUESTRA EL NOMBRE DE LAS CONSULTAS POR AHORA LO DEJARE ASI
		 	echo "<table border=''>
		 		<tr>
					<td width='20%'>".$fila->nombre."</td>
					<td width='50%'>".$fila->descripcion."</td>
					<td width='12%'><img src='image/".$fila->nombre.$fila->foto."' width='100px' height='140px'></td>
					<td>".$fila->tipo."</td>
				</tr>
				</table>";
		} 
			//pongo el número de registros total, el tamaño de página y la página que se muestra 
		echo "<br>Número de registros encontrados: " . $num_total_registros . "<br>"; 
		//echo "Se muestran páginas de " . $TAMANO_PAGINA . " registros cada una<br>"; 
		
		//cerramos el conjunto de resultado y la conexión con la base de datos 
		mysqli_free_result($rs); 
		mysqli_close($conexion);
	}

	 
?>
</section>


<footer>
<?php 
//Para mostrar los hipervinculos de la paginacion
if ($total_paginas > 1){ 
  	for ($i=1;$i<=$total_paginas;$i++){ 
      	if ($pagina == $i){
         	//si muestro el índice de la página actual, no coloco enlace 
         	echo $pagina . " ";}
      	else {
         	//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página 
	         	if (isset($tipo)) {
	         		
	         		echo "<a href='inicio3.php?pagina=".$i."&tipoo=".$tipo."&registros=".$num_total_registros."' color='red'>".$i."</a> ";

	         	}else {

	         		echo "<a href='inicio3.php?pagina=".$i."&busqueda=".$buscar."&registros=".$num_total_registros."'>".$i."</a> ";
	         	}
	         }
			
	} 
}
echo "Mostrando la página " . $pagina . " de " . $total_paginas . "<p>";
		
 ?>



 <p>*Todos los derechos reservados</p></footer>
</body>
</html>