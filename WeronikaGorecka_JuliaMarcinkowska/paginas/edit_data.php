<?php
include "../basedados/basedados.h";

session_start();

if (isset($_SESSION["user"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $login = $_POST["login"];
    $password = $_POST["password"];
    $user_id = $_SESSION["user"];
    global $conn;
    $sql = "SELECT * FROM users WHERE ID=" . $user_id;
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
        die('Could not get data: ' . mysqli_error($conn));
    }
    $row = mysqli_fetch_array($retval);
} else {
    session_destroy();
    header("refresh:0;url = ./index.html");
}

?>