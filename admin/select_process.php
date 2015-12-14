<?php

function validaSelect($selectDestino)
{
	global $listadoSelects;
	if(isset($listadoSelects[$selectDestino])) return true;
	else return false;
}

function validaOpcion($opcionSeleccionada)
{
	if(is_numeric($opcionSeleccionada)) return true;
	else return false;
}

$selectDestino=$_GET["select"]; $opcionSeleccionada=$_GET["opcion"];

if(validaOpcion($opcionSeleccionada))
{
	include 'db.php';
	$sql = "SELECT unidades FROM tmaterias WHERE idmateria = '$opcionSeleccionada'";
	$req = mysql_query($sql) or die(mysql_error().$sql);
	
	echo "<select name='unidad' id='".$selectDestino."'>";
	echo "<option value='0'>seleccione una Unidad...</option>";
	$i= 1;
	$registro=mysql_fetch_row($req);
	$total = $registro[0];
	while($total >= $i)
	{
		echo "<option value='".$i."'>Unidad ".$i."</option>";
		$i++;
	}			
	echo "</select>";
}
?>