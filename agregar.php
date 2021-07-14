<?php 
include("conect.php");
$consulta="SELECT id, nombre FROM registro ORDER BY nombre ASC"; 
$result=mysqli_query($a,$consulta);

if (isset($_REQUEST['nombre']) && !empty($_REQUEST['nombre'])){
	$n=$_REQUEST['nombre'];
	$c=$_REQUEST['carac'];
	$f=$_FILES['foto']['name'];
	$t=$_REQUEST['tipo'];
  $p=$_REQUEST['precio'];
  $st=$_REQUEST['stock'];
	$checar=mysqli_num_rows(mysqli_query($a,"SELECT * FROM usuario WHERE user='".$u."'"));
	 	mysqli_query($a,"INSERT INTO registro VALUES(NULL,'$n','$c','$f','$t','$p','$st')");
		move_uploaded_file($_FILES['foto']['tmp_name'],"image/".$n.$f);
		echo ' <script language="javascript">alert("Usuario registrado con éxito");</script> ';
		header("Location:index.php");
	
}
if(isset($_REQUEST['b'])){
    
    $b=$_REQUEST['b'];
    mysqli_query($a,"DELETE FROM registro WHERE id=$b");
    echo "<script> alert('Registro Borrado'); </script>";
}
 ?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="css/REG.css">
	<title>Comercio</title>
  <meta name="viewport" content="width=device-widht, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, min-scale=1.0">

</head>

<body>


<form method="post" action="agregar.php"  enctype="multipart/form-data" id="registro" align="center">
    <fieldset>
        <legend  style="font-size: 18pt;  color: #000;" align="center"><b>Producto</b></legend>
        <div class="form-group">
            <input style="border-radius: 15px" type="text" name="nombre" class="form-control" placeholder="Nombre de producto" />
        </div>
        <div class="form-group">
              <select name="tipo" id="tipo">
                  <option value="ropa">Ropa</option>
                  <option value="tenis">Tenis</option>
              </select>
        </div>
        <div class="form-group">
              <textarea style="border-radius: 5px"; width: "949px"; height:"84px"; cols="30" type="text" name="carac" class="form-control" required placeholder="Caracteristicas"></textarea>
        </div>
        <div class="form-group">
              <input style="border-radius: 15px" type="text" name="precio" class="form-control"  placeholder="Precio" />
        </div>
        <div class="form-group">
              <input style="border-radius: 15px" type="text" name="stock" class="form-control"  placeholder="Cantidad en Stock" />
        </div> 
        <div class="form-group">
              <label style="font-size: 14pt; color: #FFF;"><b>Ingresa una Foto</b></label>
              <input type="file" name="foto" required style="border-radius: 15px">
        </div>
        <br>
        <input  class="btn btn-warning" type="submit" name="submit" value="Registrar"/>
    </fieldset>
    
    <hr>

   <?php 
     include('menusalto.php');
   ?>
   <form id="dos" align="center" style="color:white;font-size:17px;">
     <?php 
        if (isset($_REQUEST['id'])) {
          $_SESSION['id']=$_REQUEST['id'];
          $prod=mysqli_fetch_assoc(mysqli_query($a,"SELECT * FROM registro WHERE id='".$_SESSION['id']."'"));
          echo "<section>";
          echo "<article style='font-size:18px;color:#3300FF;'> Producto: " .$prod['nombre']."</article>";
          echo "<br>";
          echo   "<article> <img src='image/".$prod['nombre']."".$prod['foto']."'width=320px height=350px style='border-radius:70px;'> </article>";
          echo "<article> Caracteristicas: <br>" .$prod['descripcion']."</article>";
          echo "<br><a href='agregar.php?b=".$prod['id']."' class='btn btn-danger3'>Eliminar</a></section>";
        }
      ?>
   </form>
</form>

</body>

 <section>
  <article></article>
</section>

</html>