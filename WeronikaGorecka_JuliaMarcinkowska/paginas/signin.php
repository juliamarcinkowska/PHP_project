<?php
include "../basedados/basedados.h";

session_start();

if (isset($_POST["login"]) && isset($_POST["password"])) {
    $login = $_POST["login"];
    $password = $_POST["password"];
    global $conn;
    $sql = "SELECT * FROM users WHERE login='" . $login . "' AND password='" . $password . "'";
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
        die('Could not get data: ' . mysqli_error($conn));
    }
    $row = mysqli_fetch_array($retval);
    if (!$row) {
        $_SESSION["user"] = -1;
        $_SESSION["type"] = -1;
        echo "Invalid login or password, please try to log in again or contact administrator.";
        header('refresh:3; url=index.html');
    } else if (strcmp($row["login"], $login) == 0 && strcmp($row["password"], $password) == 0 && $row["status"] == 1) {
        $_SESSION["user"] = $row["ID"];
        $_SESSION["type"] = $row["usertype"];
    } else if (strcmp($row["login"], $login) == 0 && strcmp($row["password"], $password) == 0 && $row["status"] == 0) {
        echo "Your account is registered, but not yet confirmed.";
        $_SESSION["user"] = -1;
        $_SESSION["type"] = -1;
        header('refresh:3; url=index.html');
    } else {
        $_SESSION["user"] = -1;
        $_SESSION["type"] = -1;
        echo "Invalid login or password, please try to log in again or contact administrator.";
        header('refresh:3; url=index.html');
    }

    switch ($_SESSION["type"]) {
        case 1:
            header('refresh:0.5; url=client_page.php');
            break;
        case 3:
        case 2:
            header('refresh:0.5; url=employee_page.php');
            break;
    }
} else {
    session_destroy();
    header("refresh:0;url = ./index.html");
}

