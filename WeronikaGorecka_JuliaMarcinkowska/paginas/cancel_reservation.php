<?php

include "../basedados/basedados.h";

session_start();
if (!isset($_SESSION["user"]) || !isset($_SESSION["type"]) || $_SESSION["type"] == -1) {
    echo "Error, you are not logged in, redirecting to main page.";
    header('refresh:2; url=index.html');
    exit();
}

global $conn;
if (isset($_SESSION["user"])) {
    $user_id = $_SESSION["user"];
    $ticket_id = $_GET["ticket_id"];
    $sql = "SELECT * FROM tickets WHERE ID=" . $ticket_id;
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
        die('Could not get data: ' . mysqli_error($conn));
    }
    $row = mysqli_fetch_array($retval);
    $sql_cr = "UPDATE tickets SET status='" . -1 . "' WHERE id=" . $ticket_id;
    $retval_cr = mysqli_query($conn, $sql_cr);
    if (!$retval_cr) {
        die('Could not update data: ' . mysqli_error($conn));
    }
    if (mysqli_affected_rows($conn) == 1)
        echo "Your reservation has been successfully cancelled.";
    else
        echo "Cancellation of your reservation failed. Try again later or contact us.";
    if ($_SESSION["type"] == 1) {
        header('refresh:2; url=client_page.php');
    } else {
        header('refresh:2; url=employee_page.php');
    }
}
?>