<?php
	define("USER_DB","root");
	define("PASS_DB","");
	define("NAME_DB","CBBus");
	$hostname_conn = "localhost";

	//Connect to MySQL services
	if(!($conn = mysqli_connect($hostname_conn, USER_DB, PASS_DB)))
	{
	   echo "Erro ao conectar ao MySQL.";
	   exit;
	}
	//Select database
	if(!($con = mysqli_select_db($conn, NAME_DB)))
	{
	   echo "Erro ao selecionar ao MySQL.";
	   exit;
	}

?>
