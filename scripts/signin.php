<?php

	session_start();

	if ((!isset($_POST['login'])) || (!isset($_POST['password'])))
	{
		header('Location: ../signIn.php');
		exit();
	}

	require_once "connect.php";

	$connection = @new mysqli($host, $db_user, $db_password, $db_name);

	if ($connection->connect_errno!=0)
	{
		echo "Error: ".$connection->connect_errno;
	}
	else
	{
		$login = $_POST['login'];
		$password = $_POST['password'];

		$login = htmlentities($login, ENT_QUOTES, "UTF-8");

		if ($result = @$connection->query(
		sprintf("SELECT * FROM users WHERE email='%s'",
		mysqli_real_escape_string($connection,$login))))
		{
			$how_many_users = $result->num_rows;
			if($how_many_users>0)
			{
				$line = $result->fetch_assoc();

				if (password_verify($password, $line['password'])) {
					$_SESSION['logged'] = true;

					$_SESSION['id'] = $line['id'];
					$_SESSION['name'] = $line['name'];
					$_SESSION['lastname'] = $line['lastname'];
					$_SESSION['bday'] = $line['bday'];
					$_SESSION['email'] = $line['email'];
					$_SESSION['phonenumber'] = $line['phonenumber'];

					unset($_SESSION['error']);
					$result->free_result();
					header('Location: ../index.php');
				}
				else {
					$_SESSION['error'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
					header('Location: ../signIn.php');
				}

			} else {
				$_SESSION['error'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
				header('Location: ../signIn.php');
			}
		}

		$connection->close();
	}

?>
