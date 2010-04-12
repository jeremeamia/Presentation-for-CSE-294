<?php
session_start();

$db = mysql_connect('localhost', 'jeremy', 'secret-password') OR die('Could not connect: '.mysql_error());
mysql_select_db('address_book', $db) OR die ('Cannot connect to database: address_book');

if (!isset($_SESSION['logged_in']) OR !$_SESSION['logged_in'])
{
	header('Location: login.php');
	exit(0);
}

echo '<html><head><title>Create Person Record</title></head>';

function validate(&$data)
{	
	foreach ($data as $key => $value)
		$data[$key] = trim($value);

	if (!isset($data['first_name']) || empty($data['first_name']) || strlen($data['first_name'] > 32))
		return FALSE;
	if (!isset($data['last_name']) || empty($data['last_name']) || strlen($data['last_name'] > 32))
		return FALSE;
	if (!isset($data['age']) || empty($data['age']) || !is_numeric($data['age']))
		return FALSE;
	if (!isset($data['gender']) || empty($data['gender']) || !in_array($data['gender'], array('M', 'F')))
		return FALSE;

	$data['first_name'] = mysql_real_escape_string($data['first_name']);
	$data['last_name'] = mysql_real_escape_string($data['last_name']);

	return TRUE;
}

echo '<body><h1>Create Person Record</h1>';

if ($_POST)
{
	$valid = validate($_POST);
	$sql = "INSERT INTO people (first_name, last_name, age, gender) VALUES ($_POST[first_name], $_POST[last_name], $_POST[age], $_POST[gender]);"
	if ($valid)
	{
		$success = mysql_query($sql, $db);
		if ($success)
			echo '<p><strong>SUCCESS:</strong> The person was created.</p>';
		else
			echo '<p><strong>ERROR:</strong> The person could not be created.</p>';
	}
	else
	{
		echo '<p><strong>ERROR:</strong> The person could not be created.</p>';
	}
}

echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'">';
echo '<p><label>First Name:</label> <input type="text" name="first_name" /></p>';
echo '<p><label>Last Name:</label> <input type="text" name="last_name" /></p>';
echo '<p><label>Age:</label> <input type="text" name="age" /></p>';
echo '<p><label>Gender:</label> <input type="text" name="gender" /></p>';
echo '<p><input type="submit" /></p></form>';
echo '</body></html>';