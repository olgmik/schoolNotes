<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>

<?php
	find_selected_page(); 
?>

<?php include("includes/header.php");?>

	<table id="structure">
		<tr>
			<td id="navigation">
				<?php echo navigation($sel_subject, $sel_page); ?>
				<br/>
				<a href="new_subject.php">+ Add a new subject</a>
			</td>
			<td id="page">
					<h2>Adding New Page</h2>

					<form action="create_page.php?subj=<?php echo urlencode($sel_subject['id']); ?>" method="post">
						
						<?php $new_page = true; ?>
						<?php include "page_form.php" ?>

						<input type="submit" name="submit" value="Add Page" />
					</form>
				<br/>
				<a href=" content.php">Cancel</a> 
				</td>
			</tr>
		</table>
<?php require("includes/footer.php");?>