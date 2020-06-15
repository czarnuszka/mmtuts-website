<?php

session_start();

require_once "connect.php";

// walidacja parametrow z formularza

$connection = @new mysqli($host, $db_user, $db_password, $db_name);

if ($connection->connect_errno!=0)
{
    die ("Error: " . $connection->connect_errno);
}

$id = $_SESSION['id'];
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$bday = $_POST['bday'];
$email = $_POST['email'];
$phonenumber = $_POST['phonenumber'];
$password = $_POST['new_password'] ?? null;

if(isset($password)) {
    $statement = $connection->prepare("UPDATE users SET name=?, lastname=?, bday=?, email=?, phonenumber=?, password=? WHERE id=?");
    $statement->bind_param('ssssssi', $name, $lastname, $bday, $email, $phonenumber, $password, $id);
} else {
    $statement = $connection->prepare("UPDATE users SET name=?, lastname=?, bday=?, email=?, phonenumber=? WHERE id=?");
    $statement->bind_param('sssssi', $name, $lastname, $bday, $email, $phonenumber, $id);
}

$result = $statement->execute();

$statement->close();

$_SESSION['profileUpdated'] = $result ? true : false;

if ($result == true) {
    $_SESSION['name'] = $name;
    $_SESSION['lastname'] = $lastname;
    $_SESSION['bday'] = $bday;
    $_SESSION['email'] = $email;
    $_SESSION['phonenumber'] = $phonenumber;
}

header('Location: ../profile.php');

