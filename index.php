<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Samantha Nakis Clock L4 Ex2</title>
	<link rel="stylesheet" type="text/css" href="password.css">
	<?php require 'logic.php'; ?>
</head>

<body>
	<h1>XKCD Password Generator</h1>
	<p>This application is meant to provide random words (and optionally a character and number) in a sequence to create a password. This password is meant to be more secure and easier to remember than your average password.</p>

	<form action='index.php' method='GET'>
		Number of Words to include:<br>
		<input type='text' name='numwords'><br>
		<div class="error_display">
			<?php
				if($error_message != ''){
					echo $error_message;
				}
			?>
		</div>
		<input type="checkbox" name="specialchar" value="ispecialchar">Include Symbol<br>
		<input type="checkbox" name="number" value="inumber">Include Number<br>
		<input type='submit' value='Give me a password!'><br>
	</form>
	<br>
	<h3>Your password is:</h3>
	<div id="pswdsection">
		<h3><?=$password?></h3>
	</div>
	<br>
	<img id= "comicpic" src="images/password_strength.png" alt="XKCD Comic">

</body>
</html>
