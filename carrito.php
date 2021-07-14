<?php 
  session_start();
  include('conect.php');
  if (!isset($_SESSION['user'])) {
  header("Location:index.php");
  }
  $user=mysqli_query($a,"SELECT * FROM usuario WHERE user='".$_SESSION['user']."'");
  $a=mysqli_fetch_assoc($user);

  if(isset($_GET['id'])){
    $idproducto=mysqli_query($a,"SELECT * FROM registro WHERE id='".$_GET['id']."'");
    $u=$_SESSION['user'];
    $p=$_GET['id'];
    
  }

  if (isset($_SESSION['carrito'])) {
    $arreglo=$_SESSION['carrito'];
    $encontro=false;
    $numero=0;
    for ($i=0; $i <count($arreglo) ; $i++) { 
      if ($arreglo[$i]['Id']==$_GET['id']) {
         $encontro=true;
         $numero=$i;
      }
    }
    if ($encontro==true) {
      $arreglo[$numero]['Cantidad']=$arreglo[$numero]['Cantidad']+1;
      $_SESSION['carrito']=$arreglo;
    }else{
      $nombre="";
      $precio=0;
      $imagen="";
      $re=mysqli_query($a,"SELECT * FROM registro WHERE id=".$_GET['id']);
      while ($f=mysqli_fetch_array($re)) {
        $nombre=$f['nombre'];
        $precio=$f['Precio'];
        $imagen=$f['foto'];
      }
      $datosn=array('Id'=>$_GET['id'],'Nombre'=>$nombre,'precio'=>$precio,'Imagen'=>$imagen,'Cantidad'=>1);
      array_push($arreglo, $datosn);
      $_SESSION['carrito']=$arreglo;
    }
  }else{
    if (isset($_GET['id'])) {
      $nombre="";
      $precio=0;
      $imagen="";
      $re=mysqli_query($a,"SELECT * FROM registro WHERE id=".$_GET['id']);
      while ($f=mysqli_fetch_array($re)) {
        $nombre=$f['nombre'];
        $precio=$f['Precio'];
        $imagen=$f['foto'];
      }
      $arreglo[]=array('Id'=>$_GET['id'],'Nombre'=>$nombre,'precio'=>$precio,'Imagen'=>$imagen,'Cantidad'=>1);
      $_SESSION['carrito']=$arreglo;
    }
  }

 ?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<link rel="stylesheet" type="text/css" href="css/css/bootstrap.min.css">


<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index2.php">National Sport</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="editar.php?">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<section class="main-container">
  <?php 
    $total=0;
    if (isset($_SESSION['carrito'])) {
      $datos=$_SESSION['carrito'];
      for ($i=0; $i <count($datos) ; $i++) { 
      ?>
      <div>
        <center>
          <img src="image/"<?php echo $datos[$i]['Imagen']; ?>/>
          <span><?php echo $datos[$i]['Nombre']; ?></span>
          <span>PRECIO <?php echo $datos[$i]['precio']; ?></span>
          <span>Cantidad <input type="text" value="<?php echo $datos[$i]['Cantidad']; ?>"></span>
          <span>Subtotal <?php echo $datos[$i]['precio']*$datos[$i]['Cantidad']; ?></span>
        </center>

      </div>
      <?php 
      $total=($datos[$i]['Cantidad']*$datos[$i]['precio'])+$total;
      }
    }else{
      echo "El carro esta vacio";
    }
    echo "<br>TOTAL: ".$total
    ;
  ?>
<center><a href="index2.php">Ver mas productos</a></center>
</section>

<script src="js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>