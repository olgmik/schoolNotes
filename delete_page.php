<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php if(intval($_GET['page']) == 0 ){
		redirect_to("content.php"); 
	}

$id = mysql_prep($_GET['page']); 

	if ($page = get_page_by_id($id)){
		$query = "DELETE FROM pages WHERE id = {$id} LIMIT 1"; 
		$result = mysql_query($query, $connection); 
		if(mysql_affected_rows() == 1) {
			redirect_to("content.php"); 
		} else {
			echo "<p>Page deletion failed. </p>"; 
			echo "<p>" . mysql_error() . "</p>"; 
			echo "<a href = \"content.php\">Return to Main Page</a>";
		}
	} else {
		redirect_to("content.php"); 
	}
	?>
<?php mysql_close($connection); ?>