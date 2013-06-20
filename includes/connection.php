<?php require("constants.php"); ?>
<!-- 1. Connect to DB -->
<?php 
	$connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
	if(!$connection){
		die("Database connection failed: " . mysql_error()); 
	}
?>
<!-- 2. Select specific DB -->
<?php 
	$db_select = mysql_select_db(DB_NAME, $connection);
	if(!$db_select){
		die("Database selection failed: " .mysql_error()); 
	}
?>