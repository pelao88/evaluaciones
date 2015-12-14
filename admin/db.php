<?php

	require_once ('config.inc.php');
	
	$db_connect = mysql_connect($servidor,$usuario,$password);
	$base_selection = mysql_select_db($basedatos,$db_connect);
	
?>