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
        session_start();
        global $conn;
        $sql = "SELECT * FROM courses where ID=" . $_POST["route_select"];
        $retval = mysqli_query($conn, $sql);
        if (!$retval) {
            die('Could not get data: ' . mysqli_error($conn));
        }
        while ($row = mysqli_fetch_array($retval)) {
            $sql_r = "SELECT sum(pass_no) AS val_sum FROM tickets where course_id=" . $_POST["route_select"] . " AND date=" . $_POST["date_search"];
            $retval_r = mysqli_query($conn, $sql_r);
            if (!$retval_r) {
                die('Could not get data: ' . mysqli_error($conn));
            }
            $res = mysqli_fetch_array($retval_r);
            echo $res[0];
            $places_left = $row['capacity'] - $res[0];
            echo "<td>" . $_POST["date_search"] . "</td>";
            echo "<td>" . $row['city_from'] . "</td>";
            echo "<td>" . $row['city_to'] . "</td>";
            echo "<td>" . $row['hour_dep'] . "</td>";
            echo "<td>" . $row['hour_arr'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "<td>" . $places_left . "</td>";
            echo "<td><a href='#' class='btn btn-dark'>Buy</a></td></tr>";
        }
        ?>
    </table>
</div>
</body>
</html>