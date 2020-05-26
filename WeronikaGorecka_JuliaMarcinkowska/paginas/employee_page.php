<?php
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
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a class="btn btn-dark" href="#">Edit</a>
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
            <a class="btn btn-dark" href="#">Go to reservations</a>
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