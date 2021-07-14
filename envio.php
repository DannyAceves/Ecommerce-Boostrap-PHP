<?php
 include('conectar.php');
session_start();
 if (!isset($_SESSION['user'])) {
  header("Location:index.php");
 }
$user=mysqli_query($conexion,"SELECT * FROM usuario WHERE user='".$_SESSION['user']."'");
$a=mysqli_fetch_assoc($user);
 //si no se que hacer con estos datos
if (isset($_REQUEST['nombre'])) {
	$nombre=$_REQUEST['nombre'];
	$direccion=$_REQUEST['direccion'];
	$cp=$_REQUEST['codigop'];

	$tipo=$_POST['tipo'];
	$estado=$_POST['state'];
	for ($i=0;$i<count($tipo);$i++) { 
		$tipoo=$tipo[$i]; 
	}
	for ($i=0;$i<count($estado);$i++) { 
		$estadoo=$estado[$i]; 
	}

	mysqli_query($conexion,"INSERT INTO envio VALUES('".$_SESSION['user']."','".$a['nombre']."','$direccion',$cp,'$estadoo','$tipoo')");

	header("Location:comprar.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Envio</title>
	<link rel="stylesheet" type="text/css" href="css/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/lol.css">
</head>
<body>
<header>
</header>
<nav></nav>
<section class="main container">
	<section class="posts col-md-7">
	<center><form action="envio.php" method="POST" align="center">
	<input type="text" name="nombre" value="<?php echo "".$a['nombre'].""; ?>"  class="form-control" placeholder="Nombre">
	<input type="text" name="direccion" placeholder="Direccion" size="30" required class="form-control">
	<input type="number" name="codigop" placeholder="Codigo postal" size="30" required class="form-control"><br>
	
	<legend>Estado</legend>
	<select name="state[]" id="state" class="form-control">
		<option value="Aguascalientes">Aguascalientes</option>
		<option value="Baja California">Baja California</option>
		<option value="Baja California Sur">Baja California Sur</option>
		<option value="Campeche">Campeche</option>
		<option value="Chiapas">Chiapas</option>
		<option value="Chihuahua">Chihuahua</option>
		<option value="Coahuila">Coahuila</option>
		<option value="Colima">Colima</option>
		<option value="Distrito Federal">Distrito Federal</option>
		<option value="Durango">Durango</option>
		<option value="Estado de México">Estado de México</option>
		<option value="Guanajuato">Guanajuato</option>
		<option value="Guerrero">Guerrero</option>
		<option value="Hidalgo">Hidalgo</option>
		<option value="Jalisco">Jalisco</option>
		<option value="Michoacán">Michoacán</option>
		<option value="Morelos">Morelos</option>
		<option value="Nayarit">Nayarit</option>
		<option value="Nuevo León">Nuevo León</option>
		<option value="Oaxaca">Oaxaca</option>
		<option value="Puebla">Puebla</option>
		<option value="Querétaro">Querétaro</option>
		<option value="Quintana Roo">Quintana Roo</option>
		<option value="San Luis Potosí">San Luis Potosí</option>
		<option value="Sinaloa">Sinaloa</option>
		<option value="Sonora">Sonora</option>
		<option value="Tabasco">Tabasco</option>
		<option value="Tamaulipas">Tamaulipas</option>
		<option value="Tlaxcala">Tlaxcala</option>
		<option value="Veracruz">Veracruz</option>
		<option value="Yucatán">Yucatán</option>
		<option value="Zacatecas">Zacatecas</option>
	</select><br>
	<legend>Tipo de Envio</legend>
	<select name="tipo[]" id="tipo" class="form-control">
		<option value="DHL">DHL</option> 
		<option value="estafeta">Estafeta</option>
		<option value="correos de mexico">Correos de Mexico</option>
		<option value="fedex">FedEx</option>
	</select>
	</legend>
	<br>
	<input type="submit" value="Enviar" class="btn btn-info">
</form>
</section>
</section>
</center>

</body>
</html>