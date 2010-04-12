<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo $title ?></title>
	</head>
	<body>
		<h1><?php echo $title ?></h1>
		<?php if ( ! empty($message): ?>
			<p>
				<strong><?php echo strtoupper($message['type']) ?>:</strong>
				<?php echo $message['content'] ?>
			</p>
		<?php endif; ?>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
			<p>
				<label>First Name:</label>
				<input type="text" name="first_name" />
			</p>
			<p>
				<label>Last Name:</label>
				<input type="text" name="last_name" />
			</p>
			<p>
				<label>Age:</label>
				<input type="text" name="age" />
			</p>
			<p>
				<label>Gender:</label>
				<input type="text" name="gender" />
			</p>
			<p>
				<input type="submit" />
			</p>
		</form>
	</body>
</html>