
<?php
/*
 * exam.php : modulo de examen 
 * Author: Andres Velasco Gordillo <phantomimo@gmail.com>

 * Basado en phpexam de Senthil Nayagam
 * http://sourceforge.net/projects/phpexam/
 
 * <c> 2004 SEL-0.2beta
 */ 
 
require_once('../admin/config.inc.php');
require_once('../admin/funciones.php');
$langfile = "../lang/".$language.".php";

if (!file_exists($langfile)){
  rep_error(FileNotFound);
  exit;  
}
include ($langfile);

//if (isset($_POST['sessionid']) && isset($_POST['studentid']) && isset($_POST['questionpaperid']) ){

//modificado el 20/Abril/2004 
session_start();
if (isset($_SESSION['usuario'])) {	


if(isset($_SESSION['numcontrol']))
	$numcontrol = $_SESSION['numcontrol'];
else
{
	rep_error("<br><br><p><a href=\"index.php\">".NotRegistered."</a></p>");		
	exit();
}
	

if (($_SESSION['sessionid'])) {
	$sessionid = $_SESSION['sessionid'];
	if(isset($_REQUEST['answer'])) 
		$answer = $_REQUEST['answer'];
	if(isset($_REQUEST['rightans']))		
		$rightans = $_REQUEST['rightans'];
}
else
{
		rep_error("<br><br><p><a href=\"index.php\">".NotRegistered."</a></p>");		
		exit();
}

echo " 
	<html>
	<head>
		<title>".AppTitle." - ".ExamModule."</title>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
		<link href=\"../css/estilo.css\" rel=\"stylesheet\" content=\"text/css\">
		<meta http-equiv=\"Expires\" content=\"0\" />
		<meta http-equiv=\"Pragma\" content=\"no-cache\" />		
		<script type=\"text/javascript\">
			if(history.forward(1))
				location.replace(history.forward(1));
		</script>
	</head>
	<body>
	
	<script>
		function ChecaOpc(){
			var i, ninguna;
			for (i=0; i<document.form1.answer.length; i++){
			   if (document.form1.answer[i].checked){
					document.form1.submit();					
					ninguna=false;
					break; 					
				}
				else { ninguna=true;}
			}
			if (ninguna) { 
				alert (\"Elige al menos una opcion\"); 
			}				  
		} 
</script>";

	$db_connect = mysql_connect($servidor,$usuario,$password);
	$base_selection = mysql_select_db($basedatos,$db_connect);
	$datetime=date("Y-m-d H:i");	
	
	//verificar que el alumno se encuentre registrado
	$sql = "SELECT * FROM talumnos where (numcontrol = '".$numcontrol."')";
	$req = mysql_query($sql);
	if (!($alumno = mysql_fetch_object($req))) { 
		rep_error("<br><br><p><a href=\"index.php\">".NotRegistered."</a></p>");		
		mysql_free_result($req);
		exit;
	}
	else {

		if(isset($_REQUEST["qid"]))
			$qid = $_REQUEST["qid"];
		else
			$qid = 0;
		
		//recuper los datos datos del alumno
		$idalumno = $alumno->idalumno;
		$nombrealumno = $alumno->nombre;
		 
		//verificar que la evaluacion exista
		$sql = "	SELECT texamenes.*, tmaterias.nombre as materia, tusuarios.nombre as docente FROM texamenes 
						LEFT JOIN tmaterias ON texamenes.idmateria = tmaterias.idmateria
						LEFT JOIN tusuarios ON texamenes.idusuario = tusuarios.idusuario 
						WHERE texamenes.claveexamen = '".$_SESSION['idexamen']."'";
		$req = mysql_query($sql);

		if (!($evaluacion = mysql_fetch_object($req))) { 
			rep_error("<a href=\"index.php\">".QPNotRegistered."</a>");
			//echo $sql;		
			mysql_free_result($req);
			exit;
		}
		else {
			$materia = $evaluacion->materia;			
			$docente = $evaluacion->docente;
			$fecha = $evaluacion->fecha;			
			$idexamen = $evaluacion->idexamen;			
			$totalpreg = $evaluacion->totalpreg;
			echo "  <h1>", traducir_cadena("Institute"), "</h1>
					<h4><b>Alumno:  </b>".$nombrealumno."<br>
						<b>Materia:     </b>".$materia."<br>
						<b>Fecha:       </b>".$datetime."<br>
						<b>Evaluador: </b>".$docente."<br> <br> </h4>";
			mysql_free_result($req);
		}
	}		
	
	$questionnumber = "q".$qid;
	$aid = $qid-1;
	$answernumber = "a".$aid;	
	
	if ($qid <= $totalpreg){
	  $query =  "SELECT ".$questionnumber." FROM texamenes WHERE idexamen = $idexamen";
	  $req = mysql_query($query);
	  if($req) {
		if ($row = mysql_fetch_object ($req)){
			$questionid=$row->$questionnumber;
		}
		mysql_free_result($req);
	  }
//	  print $query;
	}

	//modificado 23-04-2004 antes de insertar en tans1 es necesario comprobar que el alumno no haya sido registrado
	if ($qid == 0){
		$query1 = "SELECT * FROM tans1 WHERE idsesion='$sessionid'";
		$req = mysql_query($query1);
		if (!mysql_fetch_array($req)){
			$query2 =  "INSERT INTO tans1 (idexamen, fechahora, idalumno, idsesion) 
							VALUES('$idexamen','$datetime','$idalumno','$sessionid')";
			mysql_query($query2);
		}	
	}

	$sql = "SELECT MAX(contestadas) as contestadas FROM tans1 WHERE idsesion='$sessionid'";
	$consulta = mysql_query($sql);
	if ($resp = @mysql_fetch_object($consulta)){
	   $contestadas = $resp->contestadas;
	}
	else
		$contestadas = 0;
	
//	print "qid: ".$qid . " contestadas: ".$contestadas . " aid: ".$aid; 
	//si el numero de respuesta es mayor que cero
	if (($aid >= 0) & ($qid > $contestadas)){
//		print " idsession: ".$sessionid; 
		$query1 = "UPDATE tans1 SET $answernumber = '$answer' where idsesion = '$sessionid'";
		mysql_query($query1);
//		print $query1;

		//si la respuesta es correcta incrementar el numero de aciertos del alumno
		//la cookie es para verificar que no se incrementen los aciertos por recargar la pagina		
		if(isset($_COOKIE[$qid]))
			$cookie = $_COOKIE[$qid];
		else
			$cookie = 0;
		if (($rightans==$answer) && ($qid > $cookie)) {
			$query1 = "UPDATE tans1 SET aciertos = aciertos + 1 where idsesion ='$sessionid'";
			mysql_query($query1);			
		}

	   $sql = "UPDATE tans1 SET contestadas = contestadas + 1 WHERE idsesion='$sessionid'";
	   @mysql_query($sql);	   
	}

	if ($qid==$totalpreg){
		echo "<H1>".ThankYou."</H1>";
		echo Results."<br>";
		echo "<a href='index.php?action=logout'>".Logout."</a>";
		exit;
	}


	$query = "SELECT * FROM tbancopreguntas where idpregunta='$questionid'";
	$req = mysql_query($query);
	
	$qid++;	
		
	echo "<form name=\"form1\" method=\"post\" action=\"".$_SERVER['PHP_SELF']."\">";
	 if ($row = mysql_fetch_object($req)){
		$questionid = $row->idpregunta;
		$question = $row->pregunta;
		$choice1 = $row->opcion1;
		$choice2 = $row->opcion2;
		$choice3 = $row->opcion3;
		$choice4 = $row->opcion4;
		$rightans = $row->respuesta;
		
		echo "<div class=\"bgblue\"><br/><span style=\"font-weight:bold;\">".$qid.".</span> ".nl2br($question)."<br/><br/>\n </div>
			  <input type=\"hidden\" name=\"qid\" value=\"$qid\">";
		echo "<div style=\"padding:10px; font-size:14px;\">
				  <input type=\"radio\" name=\"answer\" value=\"1\">".$choice1."<br/>
				  <input type=\"radio\" name=\"answer\" value=\"2\">".$choice2."<br/>
				  <input type=\"radio\" name=\"answer\" value=\"3\">".$choice3."<br/>
				  <input type=\"radio\" name=\"answer\" value=\"4\">".$choice4."<br/>
			  </div>";  
		echo "<br/>"; 
		echo"<input type=\"hidden\" name=\"sessionid\" value=\"$sessionid\">
			 <input type=\"hidden\" name=\"numcontrol\" value=\"$numcontrol\">
			 <input type=\"hidden\" name=\"idexamen\" value=\"$idexamen\">
			 <input type=\"hidden\" name=\"rightans\" value=\"$rightans\">";			 
	 } //end while
 
	echo "<input type=\"button\" name=\"Submit Answers\" value=".txtsubmit." onClick=\"ChecaOpc();\">
		  <input type=\"reset\" name=\"reset\" value=".txtreset.">";		  
	echo "</form>
		  </body>
		  </html> ";
	}
else {
	header("Location: index.php");
	}
?>