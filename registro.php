<?php 
include('conect.php');
if (isset($_REQUEST['user']) && !empty($_REQUEST['user'])){
	$u=$_REQUEST['user'];
	$p=$_REQUEST['pass'];
	$n=$_REQUEST['nombre'];
	$f=$_FILES['foto']['name'];
	$checar=mysqli_num_rows(mysqli_query($a,"SELECT * FROM usuario WHERE user='".$u."'"));
	if ($checar==1) {
		echo ' <script language="javascript">alert("Ya estas Registrado");</script> ';
	}else if (filter_var($u,FILTER_VALIDATE_EMAIL)) {
		mysqli_query($a,"INSERT INTO usuario VALUES('$u','$p','$n','$f','')");
		move_uploaded_file($_FILES['foto']['tmp_name'],"images/".$u.$f);
		echo ' <script language="javascript">alert("Usuario registrado con éxito");</script> ';
		header("Location:index2.php");
		}else{
			echo "<script>alert('Correo invalido escribe un correo parecido a este ******@hotmail.com')</script>";
		}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Registro</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.6-dist/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/css/bootstrap.min.css">
<link rel="stylesheet" href="css/REG.css">
</head>
<body>

    <section class="container">
    <div class="row">
    <section class="posts col-md-7">
    <center>
       <form method="post" action="registro.php"  enctype="multipart/form-data" id="registro">
        <fieldset>
           <legend  style="font-size: 18pt;  color: #333;" align="center"><b>Registro</b></legend>
           <div class="form-group">
              <input style="border-radius: 15px" type="text" name="user" class="form-control"  required placeholder="Ingresa Email"/>
           </div>
           <div class="form-group">
              <input style="border-radius: 15px" type="text" name="nombre" class="form-control" placeholder="Ingresa tu nombre" />
           </div>
           <div class="form-group">
              <input style="border-radius: 15px" type="password" name="pass" class="form-control"  placeholder="Ingresa contraseña" />
           </div>
             <div class="form-group">
                 <input style="border-radius: 15px" type="password" name="rpass" class="form-control" required placeholder="repite contraseña" />
             </div>
             <div class="form-group">
                 <label style="font-size: 14pt; color: #FFFFFF;"><b>Ingresa una Foto</b></label>
                 <input type="file" name="foto" required style="border-radius: 15px">
             </div>
             <br>
             <br>
             <input  class="btn btn-warning" type="submit" name="submit" value="Registrarse"/>
        </fieldset>
    </form>
    </center>
    </div>
    </section>
	</div>
  </section>
  
  
</body>
</html>