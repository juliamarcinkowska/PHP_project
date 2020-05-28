<?php
include "../basedados/basedados.h";

session_start();

if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["login"]) && isset($_POST["password"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $login = $_POST["login"];
    $password = $_POST["password"];
    global $conn;
    $sql = "INSERT INTO users (name, email, login, password, usertype) VALUES (" . "'" . $name . "'" . "," . "'" . $email
        . "'" . "," . "'" . $login . "'" . "," . "'" . $password . "'" . "," . "1" . ")";
    echo $sql;
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
        die('Could not insert data: ' . mysqli_error($conn));
    }
    if (mysqli_affected_rows($conn) == 1)
        echo "Registration successful, please wait for account confirmation.";
    else
        echo "Registration failed, try again later or contact us.";
    header('refresh:2; url=./index.html');

} else {
    session_destroy();
    header("refresh:0;url = ./index.html");
}

?>