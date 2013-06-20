 <html>
<head>
	<?php 
		$male_status = 'inchecked';
		$female_status = 'uncchecked'; 

		if(isset($_POST['Submit1'])){
		$selected_radio = $_POST['gender']; // puts which radio button was selected into the variable
		
		if($selected_radio == 'male'){
			$male_status = 'checked';
		
		} elseif($selected_radio == 'female'){
			$femailed_status = 'checked'; 
		}
		echo $selected_radio; 
		}
	?>
<title>Radio Buttons</title>
</head>
<body>

<Form name ="form1" Method ="Post" ACTION ="radioButton.php">
<Input type = 'Radio' Name ='gender' value= 'male'><?php echo $male_status; ?>Male
<Input type = 'Radio' Name ='gender' value= 'female'><?php echo $female_status; ?>Female
<P>
<Input type = "Submit" Name = "Submit1" Value = "Select a Radio Button">
</FORM>

</body>
</html>