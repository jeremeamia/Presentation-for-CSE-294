<?php

class Model_Person extends Model
{
	protected $db;
	protected $data;

	public function __construct()
	{
		$this->db = mysql_connect('localhost', 'jeremy', 'secret-password')

		if ( ! $this->db)
			throw new Exception('Could not connect: '.mysql_error());

		if ( ! mysql_select_db('address_book', $this->db))
			throw new Exception('Cannot connect to database: address_book');
	}

	public function set_data(array $data)
	{
		$this->data = $data;
	}

	public function create()
	{
		if ( ! $this->validate($this->data))
			throw new Exception('The data is invalid for this Person.');

		$sql = sprintf(
			'INSERT INTO people (first_name, last_name, age, gender) VALUES ("%s", "%s", "%s", "%s")',
			$this->data['first_name'],
			$this->data['last_name'],
			$this->data['age'],
			$this->data['gender'],
		);

		$success = mysql_query($sql, $this->db);

		if ( ! $success)
			throw new Exception('The was an error creating this Person.');
	}

	protected function validate( & $data)
	{
		foreach ($data as $key => & $value)
		{
			$value = trim($value);
		}

		if ( ! isset($data['first_name']) || empty($data['first_name']) || strlen($data['first_name'] > 32))
			return FALSE;

		if ( ! isset($data['last_name']) || empty($data['last_name']) || strlen($data['last_name'] > 32))
			return FALSE;

		if ( ! isset($data['age']) || empty($data['age']) || !is_numeric($data['age']))
			return FALSE;

		if ( ! isset($data['gender']) || empty($data['gender']) || !in_array($data['gender'], array('M', 'F')))
			return FALSE;

		foreach ($data as $key => & $value)
		{
			$value = mysql_real_escape_string($value);
		}

		return TRUE;
	}
}