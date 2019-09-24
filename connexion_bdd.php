<?php
define('DB_USER', "php-PicTrade"); // db user
define('DB_PASSWORD', "PicTrade10-"); // db password (mention your db password here)
define('DB_DATABASE', "PicTrade"); // database name
define('DB_SERVER', "localhost"); // db server

$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);

// Check connection
if(mysqli_connect_errno()){
echo "connection echoué: " . mysqli_connect_error();
}else{
	echo "connection reussie";
}
?>
