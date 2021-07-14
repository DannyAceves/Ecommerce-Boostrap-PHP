<?php 
  session_start();
  include('conectar.php');

  if (!isset($_SESSION['user'])) {
  header("Location:index.php");
  }
  $user=mysqli_query($conexion,"SELECT * FROM usuario WHERE user='".$_SESSION['user']."'");
  $a=mysqli_fetch_assoc($user);
  if (isset($_REQUEST['id'])) {
  $cc=mysqli_query($conexion,"SELECT * FROM usuario WHERE user='".$_SESSION['user']."'");
  $siestas=mysqli_fetch_assoc($cc);
  
  if ($siestas>0) {
    $u=$_SESSION['user'];
    $c=$_REQUEST['id'];
    $cantidad=1;
    mysqli_query($conexion,"INSERT INTO micarro VALUES(NULL,'$u','$c','$cantidad')");
  }
}
$con=mysqli_query($conexion,"SELECT * FROM micarro");
$ct=mysqli_fetch_assoc($con);
if (isset($_REQUEST['cantidad']) && !empty($_REQUEST['cantidad'])) {
  $u=$_SESSION['user'];
  $ca=$_REQUEST['cantidad'];
  $l=$_REQUEST['leo'];
  mysqli_query($conexion,"UPDATE micarro SET cantidad='$ca' WHERE idproducto='$l' AND usuario='$u'");

 
}
$consulta=mysqli_query($conexion,"SELECT registro.nombre,registro.tipo,registro.precio, micarro.idcompra, registro.id FROM registro, micarro WHERE registro.id=micarro.idproducto AND micarro.usuario='".$_SESSION['user']."'");
$siestas=mysqli_num_rows($consulta);
$assoc=mysqli_fetch_assoc($consulta);
if (isset($_REQUEST['u'])) {
  mysqli_query($conexion,"DELETE FROM micarro WHERE idproducto='".$_REQUEST['u']."'");
  header("Location:car.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="css/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/lol.css">
<head>
<meta name="viewport" content="width=device-widht, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, min-scale=1.0">

  <meta charset="UTF-8">
  <title>Carrito</title>
</head>
<body>
<div class="container">
</div>
 <header>
 <nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navegacion-leo" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index2.php">National Sport</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navegacion-leo">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index2.php">Inicio<span class="sr-only">(current)</span></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span></a>
          <ul class="dropdown-menu">
            <li><a href="editar.php?">Editar Perfil  <span class="glyphicon glyphicon-user"></span></a></li>
            <li role="separator" class="divider"></li>
            <li><a href="index2.php? cerrar=1">Cerrar Sesión  <span class="glyphicon glyphicon-off"></span></a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
<section class="main container">
<div class="row">
    <section class="posts col-md-9">
      <div class="miga-de-pan">
        <ol class="breadcrumb">
          <li><a href="index2.php">Inicio</a></li>
          <li class="active">Carrito</li>
        </ol>
      </div>

      <article class="post clearfix">
      <table class="table table-hover">
      <?php 
          $cal=mysqli_query($conexion,"SELECT*FROM registro,micarro where registro.id=micarro.idproducto and micarro.usuario='".$_SESSION['user']."'"); 
          $ac=mysqli_fetch_assoc($cal);
          $sc=mysqli_num_rows($cal); ?>
        <tr>
          <td>Articulo</td>
          <td>Nombre</td>
          <td>Tipo</td>
          <td>Precio</td>
          <td>Cantidad</td>
          <td>Eliminar</td>

        </tr>
  
        <?php
          if ($siestas>0) {
            $i=0;
            $suma=0;
          do {
            echo "<tr><form method='post'action='car.php' ><td>Producto ".($i+1)."</td>";
            echo "<td>".$ac['nombre']."</td>";
            echo "<td>".$ac['tipo']."</td>";
            echo "<td> $  ".$ac['Precio']."</td>";
            echo "<td><input type='text' name='cantidad' value='".$ac['cantidad']."'><input type='hidden'name='leo' value='".$ac['idproducto']."'></form></td>";
            if (isset($_REQUEST['cantida'])) {
             echo "<input type= name='modificar' value='".$_REQUEST['cantida'].  "'>";
           } 
            $i++;
            $suma+=($ac['Precio']*$ac['cantidad']);
            echo "<td><button class='btn btn-danger' onclick='elimina(\"".$ac['idproducto']."\");'>
              <span class='glyphicon glyphicon-trash'></span></button></td>";
              echo "</tr>";
            }while ($ac=mysqli_fetch_assoc($cal));
            $_SESSION['suma']=round($suma);
            echo "<tr><td colspan=3>Total: $".round($suma)."</td>";
            echo "<td><button class='btn btn-warning' onclick='comprar(\"".$_SESSION['user']."\");'>
              <span class='glyphicon glyphicon-usd'></span>Comprar</button></td>";
            echo "</tr>";
          }else {
          echo "<tr><td>El Carrito esta vacio<br>";
          echo "<a href='index2.php'><button class='btn btn-primary'>Volver <span class='glyphicon glyphicon-arrow-left'> </span></button></a></td></tr>";
          }
        ?>
        </table>
      </article>
    </section>
  </div>
</section>
</body>
<script src="js/jquery.js"></script>
<script src="css/js/bootstrap.min.js"></script>
<script >
  function elimina(compra){
    a=confirm("Estas seguro?");
    if(a){
      window.location.href="car.php?u="+compra;
    }
  }
</script>
<script >
  function comprar(total){
    a=confirm("¿Seguro que solamente deseas comprar estos productos?");
    if(a){
    window.location.href="envio.php?t="+total;  
    }
  }  
</script>

</html>
