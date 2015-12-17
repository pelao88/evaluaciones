<?php
/*
 * students.php : modulo de administracion 
 * Author: Andres Velasco Gordillo <phantomimo@gmail.com>

 * Basado en phpexam de Senthil Nayagam
 * http://sourceforge.net/projects/phpexam/
 
 * <c> 2004 SEL-0.1beta
 */ 

session_start();
if ($_SESSION['user']="admin"){	

	require_once ('config.inc.php');
	$langfile = "../lang/".$language.".php";
	require_once ($langfile);
	
	echo " 
	<html>
	<head>
		<title>".StudentsModule."</title>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
		<link href=\"../css/estilo.css\" rel=\"stylesheet\" content=\"text/css\">
	</head>
	<body>";

include ('menu.php');


		
class modalumnos { 
			
	function consultar ($action, $idalumno, $txtnombre, $txtnumctrl, $curso) {
		$query = "SELECT a.*, g.* FROM talumnos a INNER JOIN tgrupos g ON g.idgrupo = a.idgrupo";
		$req = mysql_query($query);

		$get=mysql_query("SELECT * FROM tgrupos ORDER BY grupo ASC");
		$option = '';
		while($row1 = mysql_fetch_assoc($get))
		{
		  $option .= 	'<option value = "'.$row1['idgrupo'].'">'.$row1['grupo'].'</option>';
		}


		echo "<table border=1>
				<caption> Alumnos </caption>
					<tr><td class=\"bgblue\">Control </td>
					<td class=\"bgblue\">Nombre </td>
				  	<td class=\"bgblue\">Grupo </td>
					<td class=\"bgblue\" align=\"center\" colspan=\"2\">Acciones</td>    				  	
					</tr>";
		while ($row=mysql_fetch_object($req)){
			  echo "<tr><td>".$row->numcontrol."</td>
			  			  	<td>".$row->nombre."</td>
							<td>".$row->grupo."</td>
					 		<td><input type=\"button\" onclick=\"location='students.php?action=editar&id=".$row->idalumno."&txtnombre=".$row->nombre."&txtnumctrl=".$row->numcontrol."&idgrupo=".$row->idgrupo."'\" value=\"Editar\"></td>
							<td><input type=\"button\" onclick=\"if(confirm('¿Desea eliminar el alumno seleccionado?')) location='students.php?action=borrar&id=".$row->idalumno."'\" value=\"Eliminar\"></td> 							
			 		</tr>";	
		}

		echo "</table><hr>						
					<form name=\"frmagregar\" method=\"post\" action=\"students.php?action=$action\">
					<input type=\"hidden\" name=\"txtidalumno\" value=\"".$idalumno."\">
						<table border=0>								
							<tr><td>nombre: </td> <td><input type=\"text\" name=\"txtnombre\" value=\"".$txtnombre."\" size=\"40\"></td></tr>";
							if($action != 'editar'){
								echo "<tr><td>Curso: </td> <td><select name=\"curso\">'<option value = \"0\">Seleccionar curso...</option>".$option."</select></td></tr>";
							} else{
								echo "<tr><td>Curso: </td> <td><select name=\"curso\">'<option value = \"".$curso."\">".$grupo."</option>";
							}							
		echo				"<tr><td>numero de ctrl.: </td> <td><input type=\"text\" name=\"txtnumctrl\" value=\"".$txtnumctrl."\" size=\"40\"></td></tr>							
							<tr><td></td>
									<td><input type=\"submit\" name=\"agregar\" value=\"".$action."\">
											<input type=\"button\" onclick=\"location='students.php';\" value=\"Cancelar\" />
											</td>    
									</tr>								
						</table><hr>
					</form>";
		echo"</body>";
	}
		
	function agregar($txtnombre, $txtnumctrl, $curso) {		
		$sql = "INSERT INTO talumnos(nombre, numcontrol, idgrupo) VALUES('".$txtnombre."','".$txtnumctrl."','".$curso."')";	
		if((trim($txtnombre) != '')	&& (trim($txtnumctrl) != '0') && (trim($curso) != '') ) {
			if ($consulta = mysql_query($sql)) {
					return $this->consultar("agregar", "", "", "", "");
			}
			else {
				echo "(agregar alumno) error al ejecutar el script SQL <br /> " . mysql_error();
			}			
		}
		else {
				echo "(agregar alumno) datos incompletos <br /> ";
		}		
	}
		
	function editar($action, $idalumno, $txtnombre, $txtnumcontrol, $curso){
		return $this->consultar($action, $idalumno, $txtnombre, $txtnumcontrol, $curso);
	}
		
	function guardar(){
		$sql = "UPDATE talumnos SET nombre='".$_POST['txtnombre']."', numcontrol='".$_POST['txtnumctrl']."', idgrupo='".$_POST['curso']."'  WHERE idalumno = " . $_POST['txtidalumno'];			
		if ($consulta = mysql_query($sql)) {
			return $this->consultar("agregar", "", "", "", "");			
		} else {
			echo "(guardar alumno) error al ejecutar el script SQL: ";			
		}			
	}
		
	function borrar() {
		$sql = "DELETE FROM talumnos WHERE idalumno=".$_REQUEST['id'];
		$consulta = mysql_query($sql);			
		return $this->consultar("agregar", "", "", "", "");
	}		
}
	
	$conn = mysql_connect($servidor,$usuario,$password);
	$base = mysql_select_db($basedatos,$conn);

	if(isset($_REQUEST['action'])) {
		$action = $_REQUEST['action'];
		if(isset($_REQUEST['id']))					
			$idalumno = $_REQUEST['id'];
		else
			$idalumno = "";		
		if(isset($_REQUEST['txtnombre']))					
			$txtnombre = $_REQUEST['txtnombre'];
		else
			$txtnombre = "";		
		if(isset($_REQUEST['txtnumctrl']))						
			$txtnumctrl = $_REQUEST['txtnumctrl'];
		else
			$txtnumctrl = "";
		if(isset($_REQUEST['curso']))						
			$curso = $_REQUEST['curso'];
		else
			$curso = "0";
	}
	else {
		$action 	= "consultar";	
		$idalumno	= "";		
		$txtnombre 	= "";
		$txtnumctrl = "";
		$curso 		= "0";			
	}
	
	$alumnos = new modalumnos();		
	
	if($action == "consultar") {
		 $alumnos->consultar("agregar", $idalumno, $txtnombre, $txtnumctrl, $curso);	
	}
	else
	if ($action == "agregar") {
			print $alumnos->agregar($txtnombre, $txtnumctrl, $curso);
		} 
		else if ($action == "editar") {
					print $alumnos->editar("guardar", $idalumno, $txtnombre, $txtnumctrl, $curso);
				}
				else if ($action == "guardar") {
							print $alumnos->guardar();
						}
						else if ($action == "borrar") {
							 	print $alumnos->borrar();
								}

}
else {
	header('Location: login.php');
}
?>