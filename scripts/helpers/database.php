<?php

require_once __DIR__ . "/../config/database.php";

function databaseConnection() : mysqli {
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if ($connection->connect_errno!=0)
    {
        die ("Error: " . $connection->connect_errno);
    }

    return $connection;
}

function getUserDataById(mysqli $connection, int $id) : array {
    $statement = $connection->prepare("SELECT * FROM users WHERE id=?");
    $statement->bind_param('i', $id);

    $statement->execute();

    $result = $statement->get_result();

    $statement->close();

    return $result->fetch_assoc();
}