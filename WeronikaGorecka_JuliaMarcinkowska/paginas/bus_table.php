<?php
session_start();
if (!isset($_SESSION["user"]) || !isset($_SESSION["type"]) || $_SESSION["type"] == -1) {
    echo "Error, you are not logged in, redirecting to main page.";
    header('refresh:2; url=index.html');
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Search results</title>
    <link rel="stylesheet" href="bootstrap-4.5.0/css/bootstrap.min.css"/>

    <style>

        html,
        body {
            height: 100%;
        }

        th {
            width: 170px;
        }
    </style>
</head>

<body>
<div class="d-flex justify-content-end m-2">
    <a href="logout.php" class="btn btn-lg btn-dark mr-1">Log out</a>
</div>
<div class="d-flex">
    <img src="resources/bus_icon.png" class="mx-auto mt-lg-5 mb-lg-4" style="width: 250px;"/>
</div>
<div class="justify-content-center d-flex">
    <table style='text-align:center;'>
        <tr>
            <th>Date</th>
            <th>City from</th>
            <th>City to</th>
            <th>Departure time</th>
            <th>Arrival time</th>
            <th>Price</th>
            <th>No of places left</th>
            <th></th>
        </tr>
        <?php
        include "../basedados/basedados.h";

        global $conn;
        $course_id = $_POST["route_select"];
        $date_sel = $_POST["date_search"];
        $sql = "SELECT * FROM courses where ID=" . $course_id;
        $retval = mysqli_query($conn, $sql);
        if (!$retval) {
            die('Could not get data: ' . mysqli_error($conn));
        }
        while ($row = mysqli_fetch_array($retval)) {
            $sql_r = "SELECT sum(pass_no) FROM tickets where course_id=" . $course_id . " AND date='" . $date_sel .
                "'AND status <> '-1'";
            $retval_r = mysqli_query($conn, $sql_r);
            if (!$retval_r) {
                die('Could not get data: ' . mysqli_error($conn));
            }
            $res = mysqli_fetch_array($retval_r);
            $places_left = $row['capacity'] - $res[0];
            echo "<td>" . $date_sel . "</td>";
            echo "<td>" . $row['city_from'] . "</td>";
            echo "<td>" . $row['city_to'] . "</td>";
            echo "<td>" . $row['hour_dep'] . "</td>";
            echo "<td>" . $row['hour_arr'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "<td>" . $places_left . "</td>";
            echo "<td><a href='confirm_buy.php?date=" . $date_sel . "&course_id=" . $course_id . "' class='btn btn-dark'>Buy</a></td></tr>";
        }
        ?>
    </table>
</div>
</body>
</html>