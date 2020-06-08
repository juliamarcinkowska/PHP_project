<?php
include "../basedados/basedados.h";

session_start();
if (!isset($_SESSION["user"]) || !isset($_SESSION["type"]) || $_SESSION["type"] == -1) {
    echo "Error, you are not logged in, redirecting to main page.";
    header('refresh:2; url=index.html');
    exit();
}
if (isset($_SESSION["user"]) && isset($_SESSION["type"]) && ($_SESSION["type"] == 2 || $_SESSION["type"] == 1)) {
    if ($_SESSION["type"] == 2) {
        echo "Error, redirecting to employee page.";
        header('refresh:2; url=employee_page.php');
        exit();
    } else {
        echo "Error, redirecting to client page.";
        header('refresh:2; url=client_page.php');
        exit();
    }
}
global $conn;

$ticket_id = $_GET["ticket_id"];
$sql_cc = "UPDATE tickets SET status='" . 1 . "' WHERE ID=" . $ticket_id;
$retval_cc = mysqli_query($conn, $sql_cc);
if (!$retval_cc) {
    die('Could not update data: ' . mysqli_error($conn));
}
if (mysqli_affected_rows($conn) == 1)
    echo "Payment for the reservation confirmed.";
else
    echo "Confirmation of payment for the reservation failed. Try again later.";
header('refresh:2; url=tickets_table.php');

?>