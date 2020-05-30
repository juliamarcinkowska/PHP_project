<?php
include "../basedados/basedados.h";

session_start();
if (!isset($_SESSION["user"]) || !isset($_SESSION["type"])) {
    echo "Error, you are not logged in, redirecting to main page.";
    header('refresh:2; url=index.html');
    exit();
}
if (isset($_SESSION["user"]) && isset($_SESSION["type"]) && $_SESSION["type"] != 1 && $_SESSION["type"] != -1) {
    echo "Error, redirecting to employee page.";
    header('refresh:2; url=employee_page.php');
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

<body class="text-center">
<div class="d-flex justify-content-end m-2">
    <a href="logout.php" class="btn btn-lg btn-dark mr-1">Log out</a>
</div>
<div class="d-flex">
    <img src="resources/bus_icon.png" class="mx-auto mt-lg-5 mb-lg-4" style="width: 250px;"/>
</div>
<div class="d-flex justify-content-center">
    <div class="card">
        <div class="card-header">
            Your personal data
        </div>
        <div class="card-body">
            <p class="card-text">
                <?php
                $user_id = $_SESSION["user"];
                global $conn;
                $sql = "SELECT * FROM users WHERE ID=" . $user_id;
                $retval = mysqli_query($conn, $sql);
                if (!$retval) {
                    die('Could not get data: ' . mysqli_error($conn));
                }
                $row = mysqli_fetch_array($retval);
                echo "Your name: " . $row["name"] . "<br>";
                echo "Your email: " . $row["email"] . "<br>";
                echo "Your login: " . $row["login"] . "<br>";
                ?>
            </p>
            <a href="edit_data_view.php" class="btn btn-dark">Edit</a>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center mt-lg-4 mb-lg-4">
    <div class="card">
        <div class="card-header">
            Your reservations
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
                    <th>No of passengers</th>
                    <th>Status</th>
                </tr>
                <?php
                $sql = "SELECT * FROM tickets WHERE user_id=" . $user_id;
                $retval = mysqli_query($conn, $sql);
                if (!$retval) {
                    die('Could not get data: ' . mysqli_error($conn));
                }
                while ($row = mysqli_fetch_array($retval)) {
                    echo "<tr><td>" . $row["date"] . "</td>";
                    $sql_c = "SELECT * FROM courses WHERE ID =" . $row["course_id"];
                    $retval_c = mysqli_query($conn, $sql_c);
                    if (!$retval_c) {
                        die('Could not get data: ' . mysqli_error($conn));
                    }
                    $course = mysqli_fetch_array($retval_c);
                    echo "<td>" . $course['city_from'] . "</td>";
                    echo "<td>" . $course['city_to'] . "</td>";
                    echo "<td>" . $course['hour_dep'] . "</td>";
                    echo "<td>" . $course['hour_arr'] . "</td>";
                    echo "<td>" . $row["pass_no"] . "</td>";
                    switch ($row["status"]) {
                        case 0:
                            $status = "Reserved";
                            break;
                        case 1:
                            $status = "Payed for";
                            break;
                        case -1:
                            $status = "Cancelled";
                            break;
                    }
                    echo "<td>" . $status . "</td></tr>";
                }
                ?>
            </table>
            <br>
            </p>
            <a href="search_bus.php" class="btn btn-dark">Buy new ticket</a>
        </div>
    </div>
</div>
<div class="jumbotron">
    <h1 class="display-4">Contact information</h1>
    <p class="align-self-lg-start">Address:</p>
</div>
</body>
</html>