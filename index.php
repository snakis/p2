<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Samantha Nakis Clock L4 Ex2</title>
	<?php require 'logic.php'; ?>

<style>

</style>
</head>

<body>
	<form action='index.php' method='GET'>
		<input type='text' name='numwords'><br>

		<input type='submit' value='Give me a password!'><br>
	</form>
	<?php foreach($password as $value): ?>
		<?php echo $value?>-<br>
	<?php endforeach; ?>
</body>
</html>
