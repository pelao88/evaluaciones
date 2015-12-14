<?php
/*
 * index.php : modulo de examen 
 * Author: Andres Velasco Gordillo <phantomimo@gmail.com>

 * Basado en phpexam de Senthil Nayagam
 * http://sourceforge.net/projects/phpexam/
 
 * <c> 2004 SEL-0.2beta
 */ 

require('model/model_exam.php');

$conexion_db = mysql_connect($servidor,$usuario,$password) or die ("error de conexion a la base de datos");
$seleccionar_db =  mysql_select_db($basedatos,$conexion_db);
   
if(isset($_GET["evid"]))
	$clave = $_GET["evid"];
else
	$clave = '';

$form_exam = new  moduloexamen();	
if(isset($_REQUEST["action"])) {
	if ($_REQUEST["action"] == "login") {
			print $form_exam->login($clave);
	} 
	else { 
		if ($_REQUEST["action"] == "logout") {
					print $form_exam->logout();
					} 
	}
}
else {							
		print $form_exam->login_form(traducir_cadena(FORM_DATA), $clave);
}

?>