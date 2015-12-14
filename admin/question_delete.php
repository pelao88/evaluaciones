<?php 

session_start();
if ($_SESSION['user']="admin"){	

	  include('db.php');
	  
	  $query = "DELETE from tbancopreguntas WHERE idpregunta = " . $_REQUEST['id'];		
	  if (mysql_query($query)) {
	  	 echo " 1 pregunta eliminada...";
		 echo "<meta http-equiv=Refresh Content=\"1; url=listquestion_by_subject.php?idmateria=".$_REQUEST['idmateria']."\">";
	  }
	  else { 
	  	 echo "error al eliminar el registro...<br/>"; 
	  	 echo $query;
	  }
}
?>