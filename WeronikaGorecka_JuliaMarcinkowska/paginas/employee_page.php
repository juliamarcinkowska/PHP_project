<?php
include "../basedados/basedados.h";

session_start();
if (isset($_SESSION["user"]) && isset($_SESSION["type"]) && $_SESSION["type"] == 1) {
    echo "Error, redirecting to client page.";
    header('refresh:2; url=client_page.php');
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Employee page</title>
    <link href="bootstrap-4.5.0/css/bootstrap.min.css" rel="stylesheet"/>

    <style>
        html,
        body {
            height: 100%;
        }
    </style>
</head>
<body class="text-center">
<div class="d-flex">
    <img class="mx-auto mt-lg-5 mb-lg-4" src="resources/bus_icon.png" style="width: 250px;"/>
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
            <a class="btn btn-dark" href="edit_data_view.php">Edit</a>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center mt-lg-4 mb-lg-4">
    <div class="card">
        <div class="card-header">
            Manage reservations
        </div>
        <div class="card-body">
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a class="btn btn-dark" href="tickets_table.php">Go to reservations</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Manage clients
        </div>
        <div class="card-body">
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a class="btn btn-dark" href="#">Go to clients</a>
        </div>
    </div>
</div>
<div class="jumbotron">
    <h1 class="display-4">Contact information</h1>
    <p class="align-self-lg-start">Address:</p>
</div>
</body>
</html>