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
?>
<!doctype html>
<html lang="en">
<head>
    <title>Users</title>
    <link rel="stylesheet" href="bootstrap-4.5.0/css/bootstrap.min.css"/>

    <style>

        html,
        body {
            height: 100%;
        }

        th {
            width: 200px;
        }

        tr {
            height: 75px;
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
            <th>Name</th>
            <th>Email</th>
            <th>Login</th>
            <th>Usertype</th>
            <th>User status</th>
            <th></th>
        </tr>
        <?php

        global $conn;
        if ($_SESSION["type"] == 2){
            $sql = "SELECT * FROM users WHERE usertype  = 1 ORDER BY CASE WHEN status = 0 THEN 1 WHEN status = 1 THEN 2 WHEN status = -1 THEN 3 END ASC";
        }
        elseif ($_SESSION["type"] == 3){
            $sql = "SELECT * FROM users WHERE ID <> ". $_SESSION["user"];
        }

        $retval = mysqli_query($conn, $sql);
        if (!$retval) {
            die('Could not get data: ' . mysqli_error($conn));
        }
        while ($row = mysqli_fetch_array($retval)) {
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["login"] . "</td>";
            switch ($row["usertype"]) {
                case 1:
                    $type = "Client";
                    break;
                case 2:
                    $type = "Employee";
                    break;
                case 3:
                    $type = "Admin";
                    break;
            }
            echo "<td>" . $type . "</td>";
            switch ($row["status"]) {
                case 0:
                    $status = "Waiting for confirmation";
                    break;
                case 1:
                    $status = "Confirmed";
                    break;
                case -1:
                    $status = "Deleted";
                    break;
            }
            echo "<td>" . $status . "</td>";
            if ($_SESSION["type"] == 2 && $row["status"] == 0) {
                echo "<td><a href='confirm_client.php?user_id=" . $row['ID'] . "' class='btn btn-dark'>Confirm</a></td>";
            }
            elseif ($_SESSION["type"] == 3){
                echo "<td><a href='edit_data_view.php?user_id=" . $row['ID'] . "' class='btn btn-dark'>Edit user</a></td>";
                echo "<td><a href='#' class='btn btn-dark'>Delete user</a></td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
</div>
<div class="d-flex justify-content-center m-5">
    <?php
    if ($_SESSION["type"] == 3) {
        echo "<a href='add_user_view.php' class='btn btn-dark'>Add new user</a>";
    }
    ?>
</div>
</body>
</html>