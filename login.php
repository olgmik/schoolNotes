<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php 
	include_once("includes/form_functions.php"); 
	// Start Form Processing
	if(isset($_POST['submit'])){
		$errors = array(); 

		// perform validations on the form data
		$required_fields = array('username', 'password'); 
		$errors = array_merge($errors, check_required_fields($required_fields,$_POST)); 
		$fields_with_lengths = array('username' => 30, 'password' => 30);
		$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST)); 
		$username = trim(mysql_prep($_POST['username'])); 
		$password = trim(mysql_prep($_POST['password'])); 
		$hashed_password = sha1($password); 

		if(empty($errors)){
			// Check DB to see if username and hashed password exist there
			$query = "SELECT id,username "; 
			$query .= "FROM users "; 
			$query .= "WHERE username = '{$username}' "; 
			$query .= "AND hashed_password = '{$hashed_password}' "; 
			$result_set = mysql_query($query); 
			confirm_query($result_set); 
			if (mysql_num_rows($result_set) == 1){
				$found_user = mysql_fetch_array($result_set); 
				$_SESSION['user_id'] = $found_user['id']; 
				$_SESSION['username'] = $found_user['username'];
				redirect_to("staff.php"); 
			} else {
				$message = "Username/password combination incorrect.<br/>
					Please make sure your caps lock key is off and try again. "; 
			}

		} else {
			if(count($errors) == 1){
				$message = "There was 1 errors in the form.";
			} else {
				$message = "There were " . count($errors) . " errors in the form.";			
			}
		}

	} else {
		$username = "";
		$password = ""; 
	}
?>
<?php include("includes/header.php"); ?>

		<table id="structure">
			<tr>
				<td id="navigation">
					<a href="index.php">Return to public site</a>
					&nbsp;
				</td>
				<td id="page">
					<h2>Welcome back, please log in </h2>
					<form action = "staff.php" method = "post">
					<table>
					<tr><td>
						Username:
						</td>
						<td>
						 <input type="text" name="username" />
						</td>
					</tr>
					<tr><td>
						Password: 
					</td>
					<td>
						<input type="text" name="password" />
					</td></tr>
					<tr><td>
					<input type="submit" value="Login" />
					</td></tr>
			</table>
					</form>
				</td>
			</tr>
		</table>
<?php include("includes/footer.php");?>
