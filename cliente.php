<?php 
include('conectar.php');
session_start();
if (isset($_SESSION['user'])) {
	
}
$user=mysqli_query($conexion,"SELECT * FROM usuario WHERE user='".$_SESSION['user']."'");
$a = $user->fetch_assoc();

$miembros=mysqli_query($conexion,"SELECT * FROM micarro");

?>