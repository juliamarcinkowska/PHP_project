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
if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["login"]) && isset($_POST["password"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $login = $_POST["login"];
    $password = $_POST["password"];
    $type = $_POST["usertype_select"];
    global $conn;
    $sql_ch = "SELECT * FROM users WHERE login='" . $login . "'";
    $result_ch = mysqli_query($conn, $sql_ch);
    if (mysqli_num_rows($result_ch) != 0) {
        echo "Adding new user failed, this login already exists, please select another one.";
        header('refresh:2; url=./add_user_view.php');
        exit();
    }
    if ($type == 1){
        $sql = "INSERT INTO users (name, email, login, password, usertype) VALUES (" . "'" . $name . "'" . "," . "'" . $email
            . "'" . "," . "'" . $login . "'" . "," . "'" . $password . "'" . "," . $type . ")";
    }
    elseif ($type == 2 || $type == 3 ){
        $sql = "INSERT INTO users (name, email, login, password, usertype, status) VALUES (" . "'" . $name . "'" . "," . "'" . $email
            . "'" . "," . "'" . $login . "'" . "," . "'" . $password . "'" . "," . $type . ", '1'" .")";
    }

    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
        die('Could not insert data: ' . mysqli_error($conn));
    }
    if (mysqli_affected_rows($conn) == 1)
        echo "Adding new user successful, please wait for account confirmation.";
    else
        echo "Adding new user failed, try again later.";
    header('refresh:2; url=./employee_page.php');

} else {
    session_destroy();
    header("refresh:0;url = ./index.html");
}

?>