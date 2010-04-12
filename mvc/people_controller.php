<?php 

class Controller_People extends Controller
{	
	public function create()
	{
		session_start();
		if ( ! isset($_SESSION['logged_in']) OR ! $_SESSION['logged_in'])
		{
			header('Location: /login');
			exit(0);
		}

		$message = array();

		if ($_POST)
		{
			$Person = new Person();
			$Person->set_data($_POST);

			try
			{
				$Person->create();
				$message = array('type' => 'success', 'content' => 'The person was created.');
			}
			catch (Exception $e)
			{
				$message = array('type' => 'error', 'content' => 'The person could not be created.')
			}
		}

		$View = new View('people/create');
		$View->set('title', 'Create Person Record');
		$View->set('message', $message);

		echo $View->render();
	}
}