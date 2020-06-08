<?php

include "../basedados/basedados.h";

session_start();
if (!isset($_SESSION["user"]) || !isset($_SESSION["type"]) || $_SESSION["type"] == -1) {
    echo "Error, you are not logged in, redirecting to main page.";
    header('refresh:2; url=index.html');
    exit();
}

if (isset($_SESSION["user"]) && isset($_SESSION["type"]) && $_SESSION["type"] == 1) {
    echo "Error, redirecting to client page.";
    header('refresh:2; url=client_page.php');
    exit();
}
global $conn;
if (isset($_SESSION["user"])) {
    $user_id = $_GET["user_id"];
    $sql = "UPDATE users SET status='" . -1 . "' WHERE id=" . $user_id;
    $retval= mysqli_query($conn, $sql);
    if (!$retval) {
        die('Could not update data: ' . mysqli_error($conn));
    }
    if (mysqli_affected_rows($conn) == 1)
        echo "User has been successfully deleted.";
    else
        echo "Deletion of user failed. Try again later.";
    if ($_SESSION["type"] == 1) {
        header('refresh:2; url=client_page.php');
    } else {
        header('refresh:2; url=employee_page.php');
    }
}
?>