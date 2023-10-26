<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Plantilla para Ejercicios Tema 3</title>
  <link href="dwes.css" rel="stylesheet" type="text/css">
</head>
<?php
$conn = new mysqli("localhost","root","","dwes");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$registros=mysqli_query($conn,"SELECT nombre_corto, cod FROM producto");
?>
<body>

<div id="encabezado">
	<h1>Ejercicio: </h1>
	<form id="form_seleccion" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
	<p>Selección de producto</p>
	<select name="mercancia">
	<?php
	while ($reg = mysqli_fetch_array($registros)) {
		echo('<option value="'.$reg["cod"].'">'.$reg["nombre_corto"].'</option>');
		
	}
	?>
	</select>
	<input type="submit" value="Buscar.">
	</form>
</div>
<?php
if(isset($_POST["cantidad"])){
	$stmt = $conn->prepare("UPDATE stock SET unidades = ? WHERE producto=? AND tienda=?");
	$cantidad=intval($_POST["cantidad"]);
	$codigo=$_POST["mercancia"];
	$tienda=intval($_POST["tienda"]);
	//La función bind param No aceptará parametros que no se pasen a través de una variable.
	$stmt->bind_param("isi",$cantidad,$codigo,$tienda);
	$stmt->execute();
	$stmt->close();
}
?>
<div id="contenido">
	<h2>Contenido</h2>
	<table>
	<tr><td>Tienda</td><td>Cantidad</td></tr>
	<?php
	if(isset($_POST["mercancia"])){
		$registros=mysqli_query($conn,"SELECT tienda, unidades FROM stock WHERE producto='".$_POST["mercancia"]."';");
		while ($reg = mysqli_fetch_array($registros)) {
			echo("<tr><td>".$reg["tienda"]."</td><td><form action='modificar.php' method='post'>
			<input type='hidden' name='mercancia' value=".$_POST["mercancia"].">
			<input type='hidden' name='tienda' value=".$reg["tienda"].">
			<input type='number' min='0' name='cantidad' value=".$reg["unidades"]."></td><td>
			<input type='submit' value='Editar.'></form></td></tr>");
		}
	}
	?>
	</table>
</div>

<div id="pie">
</div>
</body>
</html>
