<?php
ob_start();

try {
	heroku_395f1ee48aedde5
	//$con = new PDO("mysql:dbname=doodle;host=localhost", "root", "");
	$con = new PDO("mysql:dbname=heroku_395f1ee48aedde5;host=us-cdbr-iron-east-04.cleardb.net", "b41d7bab336c8b", "7a7f5fcf");
	
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch(PDOExeption $e) {
	echo "Connection failed: " . $e->getMessage();
}
?>
