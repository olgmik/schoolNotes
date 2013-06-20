<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php
	find_selected_page(); 
?>
<?php 
	// form validation
	$errors = array(); 
	$required_fields = array('menu_name', 'position', 'visible', 'content'); 
	foreach($required_fields as $fieldname){
		if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
		$errors[] = $fieldname; 
		}
	}

	$fields_with_lengths = array('menu_name' => 30); 
	foreach($fields_with_lengths as $fieldname => $maxlength){
		if(strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength) {
			$errors[] = $fieldname; 
		}
	}
	if(!empty($errors)){
		redirect_to("new_page.php"); 
	}
?>

<?php 
	$menu_name = mysql_prep($_POST['menu_name']); 
	$subject_id = mysql_prep($_GET['subj']); 
	$position = mysql_prep($_POST['position']);
	$visible = mysql_prep($_POST['visible']);
	$content = mysql_prep($_POST['content']); 
?>
<?php 
	$query = "INSERT INTO pages (
				menu_name, subject_id, position, visible, content
				) VALUES (
				'{$menu_name}', {$subject_id}, {$position}, {$visible}, '{$content}'
				)"; 
				$result = mysql_query($query, $connection); 
	if($result){
		// Success!!
		header("Location: content.php"); 
		exit; 
	} else {
		echo "<p>Page creation failed.</p>"; 
		echo "<p>" . mysql_error() . "</p>"; 
	}
?>
<?php mysql_close($connection); ?>
