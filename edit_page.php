<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php 
	if(intval($_GET['page']) == 0 ){
		redirect_to("content.php"); 
	}

	include_once("includes/form_functions.php"); 

	if(isset($_POST['submit'])) {

		$errors = array(); 
		$required_fields = array('menu_name', 'position', 'visible', 'content'); 
		$errors = array_merge($errors, check_required_fields($required_fields)); 

		$fields_with_lengths = array('menu_name' => 30);
		$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths)); 

		
			// perform update
			$id = mysql_prep($_GET['page']); 
			$menu_name = mysql_prep($_POST['menu_name']); 
			$position = mysql_prep($_POST['position']);
			$visible = mysql_prep($_POST['visible']); 
			$content = mysql_prep($_POST['content']); 

			if(empty($errors)) {

			$query = "UPDATE pages SET
				menu_name = '{$menu_name}', 
				position = {$position}, 
				visible = {$visible},
				content = '{$content}'
				WHERE id = {$id}"; 
			$result = mysql_query($query, $connection); 
			if(mysql_affected_rows() == 1 ) {
				// success
				$message = "The page was updated"; 
			} else {
				//failed
				$message = "The page update failed"; 
				$message .= "<br/>" . mysql_error(); 
			}
		} else {
			// errors occured
			if(count($errors) == 1){
				$message = "There was 1 errors in the form."; 
			} else {
				$message = "There were " . count($errors) . " errors in the form."; 
			}
		}
	} // if(isset($_POST['submit'])) {
?>
<?php find_selected_page(); ?>
<?php include("includes/header.php");?>

		<table id="structure">
			<tr>
				<td id="navigation">
					<?php echo navigation($sel_subject, $sel_page); ?>
					<br/>
					<a href ="new_subject.php"> + Add new subject</a>
				</td>
				<td id="page">
					<h2>Edit Page: <?php echo $sel_page['menu_name']; ?></h2>

					<?php 
						if(!empty($message)) {echo "<p class=\"message\">" . $message . "</p>"; }
					?>
					<?php 
						if(!empty($errors)) {display_errors($errors); }
					?>

					<form action="edit_page.php?page=<?php echo urlencode($sel_page['id']); ?>" method="post">
						
						<?php include "page_form.php" ?>

						<input type="submit" name="submit" value="Update Page" />
					
				<p>
				<a href = "delete_page.php?page=<?php echo urlencode($sel_page['id']); ?>" onclick = "return confirm('Are you sure?');"> Delete Page</a>
				</form>
				<p>
				<a href="content.php?page=<?php echo $sel_page['id']; ?>">Cancel</a><br/>
				</td>
			</tr>
		</table>
<?php require("includes/footer.php");?>
