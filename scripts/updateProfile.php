<?php

session_start();

require_once "../scripts/helpers/database.php";
require_once "../scripts/validators/password.php";

$dbConnection = databaseConnection();

// walidacja parametrow z formularza
$userId = $_POST['user_id'];
$old_password = $_POST['old_password'] ?? null;
$new_password = $_POST['new_password'] ?? null;
$repeat_new_password = $_POST['repeat_new_password'] ?? null;

if (!validatePasswordSet($dbConnection, $userId, $old_password, $new_password, $repeat_new_password)) {
    header('Location: ' . $_POST['redirect_error']);
}

$name = $_POST['name'];
$lastname = $_POST['lastname'];
$bday = $_POST['bday'];
$email = $_POST['email'];
$phonenumber = $_POST['phonenumber'];

if(!empty($new_password)) {
    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

    $statement = $dbConnection->prepare("UPDATE users SET name=?, lastname=?, bday=?, email=?, phonenumber=?, password=? WHERE id=?");
    $statement->bind_param('ssssssi', $name, $lastname, $bday, $email, $phonenumber, $password_hash, $userId);
} else {
    $statement = $dbConnection->prepare("UPDATE users SET name=?, lastname=?, bday=?, email=?, phonenumber=? WHERE id=?");
    $statement->bind_param('sssssi', $name, $lastname, $bday, $email, $phonenumber, $userId);
}

$result = $statement->execute();

$statement->close();

$_SESSION['profileUpdated'] = $result ? true : false;

header('Location: ' . $_POST['redirect_success']);

