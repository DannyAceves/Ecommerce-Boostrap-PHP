<?php 
include("conect.php");
$consulta="SELECT id, nombre FROM registro ORDER BY nombre ASC"; 
$result=mysqli_query($a,$consulta);


if (isset($_REQUEST['nombre']) && !empty($_REQUEST['nombre'])){
	$n=$_REQUEST['nombre'];
	$c=$_REQUEST['carac'];
	$f=$_FILES['foto']['name'];
    $fa=$_REQUEST['fa'];
    $p=$_REQUEST['precio'];
    $st=$_REQUEST['stock'];
	$checar=mysqli_num_rows(mysqli_query($a,"SELECT * FROM usuario WHERE user='".$u."'"));
    $foto="";
    if($f!=""){
        $foto=$p;
        move_uploaded_file($_FILES['foto']['tmp_name'],"image/".$n.$f);
        }
    else{
        $foto=$fa;
    }
    mysqli_query($a,"UPDATE registro SET nombre='$n', descripcion='$c', foto='$f' Precio='$p' stock='$st' WHERE nombre='".$_REQUEST['nombre']."'");
    echo '<script language="javascript">alert("Usuario registrado con éxito");</script> ';
    //echo $sql;
    header("location:index.php");
}
 ?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="css/REG.css">
	<title>Modificar Producto</title>
  <meta name="viewport" content="width=device-widht, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, min-scale=1.0">
</head>
<body>
      
    <form method="post" action="modificar.php" enctype="multipart/form-data" id="registro" align="center">
        
        <fieldset>
        <legend  style="font-size: 18pt;  color: #000;" align="center"><b>Modificar Producto</b></legend>
        <div class="form-group">
           <img src="image/<?php echo $prod['foto'];?>" alt="">
            <input style="border-radius: 15px" type="text" name="nombre" class="form-control" value="<?php echo $prod['nombre'];?>" placeholder="Nombre de producto" />
        </div>
        <div class="form-group">
              <textarea style="border-radius: 5px;" width:"949px" height:"84px" cols="30" type="text" name="carac" class="form-control" value="<?php echo $prod['descripcion'];?>" required placeholder="Caracteristicas"></textarea>
        </div>
        <div class="form-group">
              <input style="border-radius: 15px" type="text" name="precio" class="form-control" value="<?php echo $prod['precio'];?>"  placeholder="Precio" />
        </div>
        <div class="form-group">
              <input style="border-radius: 15px" type="text" name="stock" class="form-control" value="<?php echo $prod['stock'];?>" placeholder="Cantidad en Stock" />
        </div> 
        <div class="form-group">
              <label style="font-size: 14pt; color: #FFF;"><b>Ingresa una nueva foto</b></label>
              <input type="file" name="foto" required style="border-radius: 15px">
        </div>
        <br>
        <input  class="btn btn-warning" type="submit" name="submit" value="Guardar"/>
    </fieldset>
        
        <hr>
        <?php 
            include('menusalto2.php');
        ?>
        
        
       <form id="dos" align="center" style="color:white;font-size:17px;">           
           <?php 
            if (isset($_REQUEST['id'])) {
                $_SESSION['id']=$_REQUEST['id'];
                $prod=mysqli_fetch_assoc(mysqli_query($a,"SELECT * FROM registro WHERE id='".$_SESSION['id']."'"));
                echo "<section>";
                echo "<article style='font-size:25px;color:white;'> Producto: " .$prod['nombre']."</article>";
                echo "<br>";
                echo   "<article> <img src='image/".$prod['nombre']."".$prod['foto']."'width=320px height=350px style='border-radius:70px;'> </article><br>";
                echo "<article> Caracteristicas: <br>" .$prod['descripcion']."</article>";
                echo "<br><a href='modificar.php?id=".$prod['id']."' class='btn btn-info'>Modificar</a></section>";
            }
           ?>
       </form>
       
    </form>

<section>
  <article></article>
</section>


</body>
</html>