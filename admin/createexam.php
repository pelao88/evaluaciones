<?php
/*
 * crearexamen.php : modulo de administracion 
 * Authors: Senthil Nayagam nellianet@yahoo.com, Andres Velasco Gordillo <phantomimo@gmail.com>
 * <c> 2004 SEL-0.1beta
 */
session_start();
if ($_SESSION['user']="admin"){	

	require ('db.php');
	$langfile = '../lang/'.$language.'.php';
	include ($langfile);
	
	$query="SELECT * FROM tmaterias";		
		
	$req1 = mysql_query($query);

	echo  "<html> 
	<head><title>".AppTitle." - ".AdminModule."</title>
		<link rel=\"stylesheet\" href=\"../css/estilo.css\">
	</head>";
	echo "<body>";
	include("menu.php");
	echo "	
				<h2>Evaluaciones</h2>				  
			  <br><br>	  
			  <form name=\"form1\" method=\"post\" action=\"createexam2.php\">
			  \n ".Subjects.": <select name=\"idmateria\" onchange=\"submit();\">\n
			  <option value=\"\">".SelSub."</option>\n";

			while($row = mysql_fetch_object ($req1)){
				$idmateria = $row->idmateria;
				$nombre = $row->nombre;     	
				echo "<option value=\"$idmateria\">$nombre</option>\n";
			 }		
			mysql_free_result($req1); 			
		echo "</select>";
		echo "<input type=\"hidden\" name=\"idusuario\" value=\"". $_COOKIE['idusuario'] ."\">";
		echo "<input type=\"submit\" name=\"Enviar\" value=\"Aceptar\">";
		echo "</form>
		  </body>
		  </html> ";
 }
else{
	 header("Location: login.php");
	}
?>