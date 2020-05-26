<?php
session_start();
if (isset($_SESSION["user"]) && isset($_SESSION["type"]) && $_SESSION["type"] != 1) {
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
    </style>
</head>

<body class="text-center">
<div class="d-flex">
    <img src="resources/bus_icon.png" class="mx-auto mt-lg-5 mb-lg-4" style="width: 250px;"/>
</div>
<div class="d-flex justify-content-center">
    <div class="card">
        <div class="card-header">
            Your personal data
        </div>
        <div class="card-body">
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-dark">Edit</a>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center mt-lg-4 mb-lg-4">
    <div class="card">
        <div class="card-header">
            Your reservations
        </div>
        <div class="card-body">
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="search_bus.html" class="btn btn-dark">Buy new ticket</a>
        </div>
    </div>
</div>
<div class="jumbotron">
    <h1 class="display-4">Contact information</h1>
    <p class="align-self-lg-start">Address:</p>
</div>
</body>
</html>