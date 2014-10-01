<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Samantha Nakis Clock L4 Ex2</title>
	<?php require 'logic.php'; ?>

<style>
body{
	text-align: center;
	margin-left: 200px;
	margin-right: 200px;
	background-color: #FFE4E1;
}
#pswdsection{
    padding: 0;
    margin: 0; 
    border-style: solid;
    border-color: gray;
    border-width: 5px;
    text-align: center;
    background-color: #DB7093;	
    min-height: 50px;
}
.error_display{
	color: #ff0000;
	font-style: italic;
}

</style>
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
