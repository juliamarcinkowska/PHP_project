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
    $sql = "UPDATE users SET name='" . $name . "', email='" . $email . "', login='" . $login . "', 
            password='" . $password . "' WHERE id=" . $user_id;
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
        die('Could not update data: ' . mysqli_error($conn));
    }
    if (mysqli_affected_rows($conn) == 1)
        echo "Edition of personal information successful.";
    else
        echo "Edition of personal information failed or no changes were made. Try again later or contact us.";

    switch ($_SESSION["type"]) {
        case 1:
            header('refresh:4; url=client_page.php');
            break;
        case 3:
        case 2:
            header('refresh:4; url=employee_page.php');
            break;
    }
} else {
    session_destroy();
    header("refresh:0;url = ./index.html");
}

?>