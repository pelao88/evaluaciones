<?php
/*
 * <c> 2004 SEL
 * login.php : modulo de administracion
 * Author: Andres Velasco Gordillo <phantomimo@gmail.com> 
 */
 
require_once('db.php');
require_once('funciones.php');
$langfile = "../lang/".$language.".php";

if (!file_exists($langfile)){
  rep_error(FILE_NOT_FOUND);
  exit;  
}
include ($langfile);
require('template.php');


class moduloadmin {	
	function login_form($message="")
	{
		$tpl = new template("templates/");
		$tpl->load ("login.html");
		$tpl->set_block("form"); 
		$tpl->set_variable("AppTitle", traducir_cadena("AppTitle"));
		$tpl->set_variable("AdminModule", traducir_cadena("AdminModule"));
		$tpl->set_variable("Institute", traducir_cadena("Institute"));
		$tpl->set_variable("WelcomeAdmin", traducir_cadena("WelcomeAdmin"));
		$tpl->set_variable("message", traducir_cadena($message));
		$tpl->set_variable("user", traducir_cadena("user"));
		$tpl->set_variable("password", traducir_cadena("password"));		
		$tpl->parse_block("form");		
		return $tpl->get();
	}

	function login()
	{		
		if(isset($_POST["user"]) && isset($_POST["password"])) {
			$sqllogin = "SELECT idusuario, nombre FROM tusuarios 
						 WHERE nombre = '".$_POST["user"]."' AND passwd = '". $_POST["password"] ."'";
			$consulta = mysql_query($sqllogin);
		
			if ($fila = mysql_fetch_object($consulta))
			{			
				$session_id = rand();
				setcookie ("logged", $session_id);
				setcookie ("idusuario", $fila->idusuario);					
				session_start();
				//session_is_registered('admin');
				$_SESSION['user'] = "admin";

				header("Location: index.php");
			} else {
				return $this->login_form(traducir_cadena(LOGIN_ERROR));		
			}
		}
		else {
			return $this->login_form(traducir_cadena(LOGIN_ERROR));		
		}		
	}

	function logout()
    {				
		session_start();
		setcookie("logged",0);		
		setcookie ("idusuario", '');							
		session_destroy();
		header("Location: login.php"); 		
    }
}

$modadmin = new moduloadmin();
if(isset($_REQUEST["action"])) {
	if ($_REQUEST["action"] == "login") {
		print $modadmin->login();		
	} 
	else { 
		if ($_REQUEST["action"] == "logout") {
				print $modadmin->logout();
					} 
	}
}
else {							
		print $modadmin->login_form(traducir_cadena(LOGIN_DATA));
}
	
?>
      