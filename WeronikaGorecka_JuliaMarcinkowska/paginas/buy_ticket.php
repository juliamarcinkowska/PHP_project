<?php
include "../basedados/basedados.h";

session_start();
if (!isset($_SESSION["user"]) || !isset($_SESSION["type"])) {
    echo "Error, you are not logged in, redirecting to main page.";
    header('refresh:2; url=index.html');
    exit();
}

if (isset($_SESSION["user"])) {
    $user_id = $_SESSION["user"];
    $date = $_GET["date"];
    $course_id = $_GET["course_id"];
    $pass_no = $_GET["pass_no"];
    global $conn;
    $sql = "INSERT INTO tickets (course_id, user_id, pass_no, date) VALUES (" . "'" . $course_id . "'" . "," . "'" . $user_id
        . "'" . "," . "'" . $pass_no . "'" . "," . "'" . $date . "')";
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
        die('Could not insert data: ' . mysqli_error($conn));
    }
    if (mysqli_affected_rows($conn) == 1)
        echo "Reservation successful. You will receive an email with payment information. If we don't receive payment
         in 3 working days, your reservation will be canceled.";
    else
        echo "Registration failed, try again later or contact us.";
    header('refresh:4; url=./client_page.php');

} else {
    session_destroy();
    header("refresh:0;url = ./index.html");
}

?>