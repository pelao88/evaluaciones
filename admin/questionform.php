<?php
/*
 * questionform.php : modulo de examen 
 * Author: Andres Velasco Gordillo <phantomimo@gmail.com>

 * Basado en phpexam de Senthil Nayagam
 * http://sourceforge.net/projects/phpexam/
 
 * <c> 2004 SEL-0.2beta
 */ 

session_start();
if  ($_SESSION['user']="admin"){
	include ('db.php');

	require_once ('config.inc.php');
	$langfile = "../lang/".$language.".php";
	require_once ($langfile);
	

	$questionid="";
	$subjectidedit="";			
	$question="";
	$choice1="";
	$choice2="";
	$choice3="";
	$choice4="";
	$answer="";	
	$unit="";
	
	if(isset($_REQUEST['action'])) {
		$action = $_REQUEST['action'];
	}
	else
		$action = 'insert';
		
	if($action == 'edit') {
		$query =  "SELECT * FROM tbancopreguntas WHERE idpregunta='".$_REQUEST['id']."' ORDER BY idpregunta ASC";
		$req = mysql_query($query);

		if($row = mysql_fetch_object($req)){
			$questionid=$row->idpregunta;
			$subjectidedit=$row->idmateria;			
			$question=$row->pregunta;
			$choice1=$row->opcion1;
			$choice2=$row->opcion2;
			$choice3=$row->opcion3;
			$choice4=$row->opcion4;
			$answer=$row->respuesta;	
			$unit=$row->unidad; 
		}
	}
	else
	if(isset($_REQUEST['idmateria'])) {
		$subjectidedit = $_REQUEST['idmateria'];
		if(isset($_REQUEST['idunidad'])) 
			$unit = $_REQUEST['idunidad'];		
		else
			$unit = 1;
	}
?>
<html>
<head>
	<?php	echo "<title>".AppTitle." - ".AdminModule."</title>"; ?>
	<link rel="stylesheet" href="../css/estilo.css"/>  
	<script type="text/javascript" src="js/ajax.js"></script>	
</head>

<body> 
<?php	include ('menu.php'); ?>
<h2>Agregar una pregunta por formulario</h2>
<h3>Banco de preguntas</h3>

<form name="formz" method="post" action="question_<?php echo $action ?>.php?action=<?php echo $action ?>">
<table border="1" width="90%">
<tr><td class="bgblue">Campo</td>
	<td class="bgblue">Entrada</td>
</tr>
<tr><td class="bggray">materia</td>
		<td>
		<?php 
			$query="SELECT * FROM tmaterias";		
			$req1 = mysql_query($query);
			echo 
				"<select name=\"idmateria\" id=\"select1\" onchange='cargaContenido(this.id)'>\n";
				 echo "<option value=\"\">".SelSub. "</option>\n";
				 while($row = mysql_fetch_object ($req1)){
						$subjectid =$row->idmateria;
						$subject =$row->nombre;     	
						echo "<option value=\"$subjectid\"";
						if((($action == 'edit') || ($action == 'insert')) && ($subjectidedit==$subjectid)) echo "selected";
						echo ">$subject</option>\n";									
				 }		
				mysql_free_result($req1); 
			echo "</select>";
		?> </td>
</tr>
<tr>
	<td class="bggray">unidad</td>
	<td>
		<?php	
		if(($action == 'edit') || (isset($subjectidedit))) {
			$sql = "SELECT unidades FROM tmaterias WHERE idmateria = '$subjectidedit'";
			$req = mysql_query($sql) or die(mysql_error().$sql);
			echo "<select name='unidad' id='select2'>";
			$i= 1;
			$registro=mysql_fetch_row($req);
			$total = $registro[0];
			while($total >= $i)	{
				echo "<option value=\"$i\"";
				if($i == $unit) echo "selected";
				echo ">Unidad ".$i."</option>\n";									
				$i++;
			}			
			echo "</select>";
		 	
			 
		}
		else { ?>
			<select disabled="disabled" name="unidad" id="select2">
				<option value="0">seleccione una Unidad...</option>
		  </select>				
		<?php } ?>
	</td>
</tr>
<tr><td class="bggray">pregunta</td>
	<td ><textarea name="pregunta" cols="70" rows="5"><?php echo $question ?></textarea></td>
</tr>
<tr>
	<td class="bggray">opcion1</td>
	<td><input type="text" name="opcion1" maxlength="100" size="80" value="<?php echo $choice1 ?>" /></td>
	</tr>
<tr>
	<td class="bggray">opcion2</td>
	<td><input type="text" name="opcion2" maxlength="100" size="80" value="<?php echo $choice2 ?>" /></td>
	</tr>
<tr><td class="bggray">opcion3</td>
	<td><input type="text" name="opcion3" maxlength="100" size="80" value="<?php echo $choice3 ?>" /></td>
	</tr>
<tr><td class="bggray">opcion4</td>
	<td><input type="text" name="opcion4" maxlength="100" size="80" value="<?php echo $choice4 ?>" /></td>
	</tr>
<tr><td class="bggray">respuesta</td>
	<td><input type="text" name="respuesta" size="4" value="<?php echo $answer ?>" /></td>
	</tr>

</table>
<br/>
<input type="hidden" name="id" value="<?php echo $questionid; ?>" />
<input type="submit" name="Submit" value="Guardar" />
<?php if(($action == 'edit') || isset($idmateria)) { ?>
	<input type="button" onclick="history.back(-1);" value="Cancelar" />
<?php } else { ?>
	<input type="button" onclick="top.frames.location='index.php'" value="Cancelar" />
<?php } ?>
</form>
</body> 
</html>
<?php
}
else {
	 header('Location: login.php');
	}

?>