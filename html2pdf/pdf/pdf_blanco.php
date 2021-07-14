<?php
ob_start();
include('../../conectar.php');
session_start();
if (!isset($_SESSION['user'])) {
    header("Location:../..index.php");
}

$user=mysqli_query($conexion,"SELECT * FROM usuario WHERE user='".$_SESSION['user']."'");
$a=$user->fetch_assoc();
if (isset($_REQUEST['cerrar'])) {
    session_destroy();
    header("Location:../..index.php");
}
$cal=mysqli_query($conexion,"SELECT*FROM registro,micarro where registro.id=micarro.idproducto and micarro.usuario='".$_SESSION['user']."'"); 
$ac=mysqli_fetch_assoc($cal);
$sc=mysqli_num_rows($cal);
$dia=date("d");
$m=date("m");
$anio=date("Y");
$mes="";
switch ($m) {
    case 1: $mes="Enero";break;
    case 2: $mes="Febrero";break;
    case 3: $mes="Marzo";break;
    case 4: $mes="Abril";break;
    case 5: $mes="Mayo";break;
    case 6: $mes="Junio";break;
    case 7: $mes="Julio";break;
    case 8: $mes="Agosto";break;
    case 9: $mes="Sepiembre";break;
    case 10: $mes="Octubre";break;
    case 11: $mes="Noviembre";break;
    case 12: $mes="Diciembre";break;
}
$productos=mysqli_query($conexion,"SELECT registro.nombre,registro.tipo,registro.precio, micarro.idcompra, registro.id FROM registro, micarro WHERE registro.id=micarro.idproducto AND micarro.usuario='".$_SESSION['user']."'");
$producto=$productos->fetch_assoc();
$siesta=mysqli_num_rows($productos);
?>
<style>
<!--
#encabezado {padding:10px 0; border-bottom: 1px solid; width:100%;}
#encabezado .fila #col_1 {width: 25%; text-align: right;}
#encabezado .fila #col_2 {text-align:left; width: 75%}

#encabezado .fila #col_2 #span1{font-size: 25px;}
#encabezado .fila #col_2 #span2{font-size: 15px; color: #ccc;}

#footer {padding-bottom:5px 0;border-top: 2px solid #46d; width:100%;}
#footer .fila td {text-align:center; width:100%;}
#footer .fila td span {font-size: 10px; color: #000;}

#fecha {margin-top:100px; width:100%;}
#fecha tr td {text-align: right; width:100%;}

#central {margin-top:20px; width:100%;}
#central tr td {padding: 10px; text-align:center; width:100%;}

#datos {border:1px double; margin:auto; width:100%;}
#datos td{border-top:1px double;}
-->
</style>
<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="20mm">
   
   
    <page_header>
        <table id="encabezado">
            <tr class="fila">
                <td id="col_1" >
                    
                </td>
                <td id="col_2">
                    <span id="span1">NATIONAL SPORT STORE</span>
                    <br>
                    <span id="span2">Guadalupe Aguirre & Daniel Aceves Espinoza</span>
                </td>
                <td><br></td>
                <td><br></td>
            </tr>
        </table>
    </page_header>
        
   
        <page_footer> 
        <table id="footer">
            <tr class="fila">
                <td>
                    <span>&copy; National Gym Store 2016</span>
                </td>
            </tr>
        </table>
    </page_footer>
    
    
    
    <table id="fecha">
        <tr class="fila">
            <td>
            <?php echo "Tecámac F.V a $dia de $mes de $anio"; ?>
            </td>
        </tr>
    </table>
    

    <table id="central">
        <tr class="fila">
            <td>
              <b> Comprador <?php echo $a['nombre']; ?> ¡Muchas gracias por su compra!</b>
            </td>
        </tr>       
        <tr>
            <td >
            <table id="datos" >
                <tr class="fila">
                    <td style="width:15%">Foto</td>
                    <td style="width:15%">Nombre</td>
                    <td style="width:15%">tipo</td>
                    <td style="width:15%">Precio</td>
                    <td style="width:15%">Cantidad</td>
                </tr>
                <?php 
                if ($siesta>0) {
                do {
                echo "<tr class='fila'>";
                    echo"<td style='width:15%'><img src='../../image/".$ac['nombre']."".$ac['foto']."' width=30 height=30></td>";
                    echo "<td style='width:15%'>".$ac['nombre']."</td>";
                    echo "<td style='width:15%'>".$ac['tipo']."</td>";
                    echo "<td style='width:15%'> $ ".$ac['Precio']."</td>";
                    echo "<td style='width:15%'>".$ac['cantidad']."</td>";
                echo "</tr>";
                }while ($ac=mysqli_fetch_assoc($cal));
                }
                ?>
            </table>
            </td>
        </tr>
        <tr>
            <td>Total a Pagar: <?php echo $_SESSION['suma']; ?></td>
        </tr>
    </table>
</page>
<?php
    $content = ob_get_clean();
    require_once(dirname(__FILE__).'/../html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', 3); 
        $html2pdf->pdf->SetDisplayMode('fullpage'); 
        $html2pdf->writeHTML($content);
        $html2pdf->Output('calificaciones.pdf'); 
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>
