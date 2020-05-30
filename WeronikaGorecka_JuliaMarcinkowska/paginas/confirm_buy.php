<?php
session_start();
if (!isset($_SESSION["user"]) || !isset($_SESSION["type"])) {
    echo "Error, you are not logged in, redirecting to main page.";
    header('refresh:2; url=index.html');
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Client page</title>
    <link rel="stylesheet" href="bootstrap-4.5.0/css/bootstrap.min.css"/>

    <style>
        html,
        body {
            height: 100%;
        }

        th {
            width: 200px;
        }
    </style>
</head>
<body>
<div class="d-flex justify-content-center mt-lg-4 mb-lg-4">
    <div class="card">
        <div class="card-header">
            Your reservation
        </div>
        <div class="card-body">
            <p class="card-text">
            <table style='text-align:center;'>
                <tr>
                    <th>Date</th>
                    <th>City from</th>
                    <th>City to</th>
                    <th>Departure time</th>
                    <th>Arrival time</th>
                    <th width='300px'>No of passengers</th>
                </tr>
                <?php

                include "../basedados/basedados.h";

                session_start();
                global $conn;
                if (isset($_SESSION["user"])) {
                    $user_id = $_SESSION["user"];
                    $date = $_GET["date"];
                    $course_id = $_GET["course_id"];
                    echo "<tr><td>" . $date . "</td>";
                    $sql_c = "SELECT * FROM courses WHERE ID =" . $course_id;
                    $retval_c = mysqli_query($conn, $sql_c);
                    if (!$retval_c) {
                        die('Could not get data: ' . mysqli_error($conn));
                    }
                    $course = mysqli_fetch_array($retval_c);
                    $sql_r = "SELECT sum(pass_no) FROM tickets where course_id=" . $course_id . " AND date='" . $date .
                        "'AND status <> -1";
                    $retval_r = mysqli_query($conn, $sql_r);
                    if (!$retval_r) {
                        die('Could not get data: ' . mysqli_error($conn));
                    }
                    $res = mysqli_fetch_array($retval_r);
                    $places_left = $course['capacity'] - $res[0];
                    echo "<td>" . $course['city_from'] . "</td>";
                    echo "<td>" . $course['city_to'] . "</td>";
                    echo "<td>" . $course['hour_dep'] . "</td>";
                    echo "<td>" . $course['hour_arr'] . "</td>";
                    echo "<td><form method='get' action='buy_ticket.php'>";
                    echo "<input type='number' name='pass_no' min='1' max='$places_left' autofocus required/>";
                    echo "<input type='hidden' name='course_id' value='$course_id'/>";
                    echo "<input type='hidden' name='date' value='$date'/>";
                    echo "<input type='submit' class='btn btn-dark mt-lg-1' value='Confirm purchase'/></td>";
                    echo "</form></td></tr>";
                }
                ?>
            </table>
            </p>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center">
    <a href="client_page.php" class="btn btn-dark">Cancel</a>
</div>
</body>