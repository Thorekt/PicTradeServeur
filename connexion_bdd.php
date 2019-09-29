<?php


function connexion_bdd(){
	define('DB_USER', "php-PicTrade"); // db user
	define('DB_PASSWORD', "PicTrade10-"); // db password (mention your db password here)
	define('DB_DATABASE', "PicTrade"); // database name
	define('DB_SERVER', "localhost"); // db server

	$mysqli = new mysqli(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);

	// Check connection
	if($mysqli->connect_errno){
		echo "connection echoué: " . $mysqli->connect_error."\n";
		exit();
	}else{
		echo "connection reussie\n";
		return	$mysqli;
	}
}

?>
