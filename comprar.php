<?php 
session_start();
include('conectar.php');
  if (!isset($_SESSION['user'])) {
  header("Location:index.php");
  }
  $user=mysqli_query($conexion,"SELECT * FROM usuario WHERE user='".$_SESSION['user']."'");
  $a=mysqli_fetch_assoc($user);
  if (isset($_REQUEST['t'])) {
  $pro=mysqli_fetch_assoc(mysql_query("SELECT * FROM registro,micarro where registro.id=micarro.idproducto and micarro.usuario='".$_SESSION['user']."'"));
  }
$cal=mysqli_query($conexion,"SELECT*FROM registro,micarro where registro.id=micarro.idproducto and micarro.usuario='".$_SESSION['user']."'"); 
$ac=mysqli_fetch_assoc($cal);
$sc=mysqli_num_rows($cal);
$consulta=mysqli_query($conexion,"SELECT registro.nombre,registro.tipo,registro.precio, micarro.idcompra, registro.id FROM registro, micarro WHERE registro.id=micarro.idproducto AND micarro.usuario='".$_SESSION['user']."'");
$siestas=mysqli_num_rows($consulta);
$assoc=mysqli_fetch_assoc($consulta);
if (isset($_REQUEST['tipo'])) {
	$categoria=$_POST['tipo'];
	for ($i=0;$i<count($categoria);$i++) { 
		$tipo=$categoria[$i]; 
    }
    $categoria1=$_POST['tipo1'];
	for ($i=0;$i<count($categoria1);$i++) { 
		$tipo1=$categoria1[$i]; 
    }

    $nb=$_REQUEST['nombre'];
    $ap=$_REQUEST['apellidos'];
    $nt=$_REQUEST['numero'];

     mysqli_query($conexion,"INSERT INTO compras VALUES(NULL,'".$_SESSION['user']."','$tipo','$nb','$ap',$nt,'$tipo1',".$_SESSION['suma'].")");

    //sirve para poder actualzar existencias de tabla productos
   	do{
		$resultad=$ac['stock']-$ac['cantidad'];
		mysqli_query("UPDATE registro SET  stock=".$resultad." WHERE id=".$ac['idproducto']."");
		
	}while($ac=mysqli_fetch_assoc($cal));
    echo "<script>alert('Gracias por su compra')</script>";
    header("Location:html2pdf/pdf/pdf_blanco.php");

 
}
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="css/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/lol.css">

<head>
	<title>Comprar</title>
</head>
<body>
<section class="main container">
	<div class="row">
		<section class="posts col-md-7">
<article class="post clearfix">
	<h2 class="post-title">Tus Articulos</h2>
      <table class="posts col-md-9 table table-stirped">
      <tr>
          <td>Foto</td>
          <td>Nombre</td>
          <td>Tipo</td>
          <td>Precio</td>
          <td>Cantidad</td>

        </tr>
        <?php 
  		if ($siestas>0) {
          do {
            echo "<tr><td><img src='image/".$ac['nombre']."".$ac['foto']."'width=60px height=60px class='img-thumbnail'></td>";
            echo "<td>".$ac['nombre']."</td>";
            echo "<td>".$ac['tipo']."</td>";
            echo "<td> $  ".$ac['Precio']."</td>";
            echo "<td>".$ac['cantidad']."</td>";
            }while ($ac=mysqli_fetch_assoc($cal));
            echo "<tr><td colspan=3>Total: $".$_SESSION['suma']."</td>";
            echo "<td></td>";
            echo "</tr>";
          }else {
          echo "<tr><td>El Carrito esta vacio</td></tr>";
          }
           ?>
      </table>
</article>
      <form method="post" action="comprar.php"  enctype="multipart/form-data" id="registro" align="center">
  <fieldset>
    <div class="form-group">
      <input style="border-radius: 15px" type="text" name="nombre" class="form-control" placeholder="Nombre" value="<?php echo $a['nombre']; ?>" />
    </div>
    <div class="form-group">
      <input style="border-radius: 15px" type="text" name="apellidos" class="form-control"  placeholder="Apellidos" />
      
    </div>
    <div class="form-group">
      <input style="border-radius: 5px";  type="texto" name="numero" class="form-control" required placeholder="Ingresa tu numero telefonico"></input>
    </div>
    <div class="form-group">
      <legend>Forma de pago</legend>
      <div class="form-group"></div>
      <select name="tipo[]" id="tipo" class="form-control"> 
				<option value="credito">Tarjeta de Credito</option>
        <option value="debito"> Tarjeta de Debito</option>
	</select>
	</div>
	<div class="form-group">
	<input type="text" name="nombre" placeholder="Nombre" size="30" required style="border-radius: 15px" class="form-control" value="<?php echo $a['nombre']; ?>">
	</div>
	<div class="form-group">
	<input type="text" name="apellidos" placeholder="Apellidos" size="30" required style="border-radius: 15px" class="form-control">
	</div>
	<div class="form-group">
	<input type="number" name="numero" placeholder="Numero de Tarjeta" size="30" required style="border-radius: 15px" class="form-control"> 
	</div>
  
	<select name="tipo1[]" id="tipo1" class="form-control"> 

				<option value="visa">Visa</option>
        <option value="mastercard">Master Card</option>
        <option value="banorte">Banorte</option>
        <option value="banamex">Banamex</option>
        <option value="bancomer">Bancomer</option>
        <option value="paypal">Paypal</option>
	</select>
    </div> 

    <br><input  class="btn btn-success" type="submit" name="submit" value="Finalizar Compra" align="center" />
</fieldset>
</form>

		</section>
	</div>
</section>

</body>
</html>