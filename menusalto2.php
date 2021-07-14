<script>
	function producto(targ,selObj,restore){
		eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
		if (restore)selObj.selectedIndex=0;	
	}
</script>

<?php 
	include ('conectar.php');
	$consulta="SELECT id, nombre FROM registro ORDER BY nombre ASC"; 
	$result=mysqli_query($conexion,$consulta);
	echo "<center><form method='post'>";
 	echo "<select onChange='producto(\"parent\",this, 1)'>"; 
	echo "<option value=''>Productos</option>";
	while($fila=mysqli_fetch_row($result)){
		echo "<option value='modificar.php?id=".$fila["0"]."'>".$fila['1']."</option>";	
	}
    echo "</select></form></center>";
?>
