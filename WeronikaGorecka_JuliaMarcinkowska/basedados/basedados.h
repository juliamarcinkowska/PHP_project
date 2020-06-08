<?php
	define("USER_DB","root");
	define("PASS_DB","");
	define("NAME_DB","CBBus");
	$hostname_conn = "localhost";

	//Connect to MySQL services
	if(!($conn = mysqli_connect($hostname_conn, USER_DB, PASS_DB)))
	{
	   echo "Error while connecting to MySQL server.";
	   exit;
	}
	//Select database
	if(!($con = mysqli_select_db($conn, NAME_DB)))
	{
	   echo "Error while selecting MySQL database.";
	   exit;
	}

?>
