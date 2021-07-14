<?php 
include('conect.php');
session_start();
if (!isset($_SESSION['user'])) {
	header("Location:index.php");
}
$user=mysqli_query($a,"SELECT * FROM usuario WHERE user='".$_SESSION['user']."'");
$a=mysqli_fetch_assoc($user);

if (isset($_REQUEST['cerrar'])){
	session_destroy();
	header("Location:index.php");
}
if (isset($_REQUEST['pass']) && !empty(['pass'])) {
	$u=$_REQUEST['user'];
	$p=$_REQUEST['pass'];
	$n=$_REQUEST['nombre'];
	$f="";
	$img=$_FILES['foto']['name'];
	if ($img=="") {
		$f=$_REQUEST['leo'];
	}else{
		$f=$img;
		move_uploaded_file($_FILES['foto']['tmp_name'],"bootstrap/".$_SESSION['user'].$f);
	}
	mysqli_query($a,"UPDATE `usuario` SET password='$p', nombre ='$n', foto='$f' WHERE user='".$_SESSION['user']."'");
	header("Location:index2.php");
	echo ' <script language="javascript">alert("Se a guardado correctamente");</script> ';
}
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="bootstrap/css/lol.css">
		<link rel="stylesheet" href="css/REG.css">

		
		
	<title>EDITAR PERFIL</title>
	<meta name="viewport" content="width=device-widht, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, min-scale=1.0">
</head>
<body  style="background-attachment: fixed">
<div class="container">
 <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navegacion-leo" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <br><br>
      <a class="navbar-brand" href="index2.php"><img id="logo" src="iconos/NSS.png"></a>
    </div>
<form method="post" action="editar.php"  enctype="multipart/form-data" align="center">
  <fieldset>
    <legend  style="font-size: 18pt;  color: #333;"><b>Editar Perfil</b></legend>
    <div class="form-group">
      <label style="font-size: 14pt; color: #333;"><b>Usuario: <?php echo $a['nombre']; ?> </b></label>
    </div>
    <div class="form-group">
      <label style="font-size: 12pt; color: #333;"><b>Cambiar Nombre</b></label>
      <input type="text" name="nombre" class="form-control" value="<?php echo $a['nombre']; ?>" required />
    </div>

    <div class="form-group">
      <label style="font-size: 12pt; color: #333;"><b>Cambiar Contraseña</b></label>
      <input type="password" name="pass" class="form-control" value="<?php echo $a['password']; ?>" required />
      
    </div>
      <div class="form-group">
      <label style="font-size: 14pt; color: #333;"><b>Foto actual: <?php echo $a['foto']; ?> </b></label>
      <input class="form-control" type="file" name="foto" value="<?php echo $a['foto']; ?> ">
      <input type="hidden" name="leo" value="<?php echo $a['foto']; ?>">

    </div>
    <br>
     <input  class="btn btn-success" type="submit" name="submit" value="Guardar"/>
    </div>
       

  </fieldset>
</form>
</div>
</body>
</html>