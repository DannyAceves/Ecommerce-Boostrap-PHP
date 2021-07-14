<script>
	function producto(targ,selObj,restore){
		eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
		if (restore)selObj.selectedIndex=0;

		
	}

</script>

<?php 
	include ('conectar.php');
	$consulta="SELECT id, nombre FROM registro ORDER BY nombre ASC"; 
	$result=mysqli_query($a,$consulta);
 

	echo "<form method='post'>";
 	echo "<select onChange='producto(\"parent\",this, 1)'>"; 
	echo "<option value=''>Productos</option>";
	
	while($fila=mysqli_fetch_row($result)){
		echo "<option value='agregar.php?id=".$fila["0"]."'>".$fila['1']."</option>";
	}
	echo "<br><a href='agregar.php?b=".$prod['id']."' class='btn btn-danger3'>Eliminar</a></section>";
    echo "</select></form>";
 ?>
