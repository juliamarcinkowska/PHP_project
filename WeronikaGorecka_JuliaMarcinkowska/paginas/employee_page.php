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
<div class="jumbotron d-flex justify-content-center">
    <div class="container">
        <h1 class="display-4">Contact information</h1>
        <p class="lead">
        <h3><b>CBBus</b> <br></h3>
        <div class="d-flex justify-content-center">
            <table>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="pr-lg-5"><b>Adress:</b></td>
                    <td class="pl-lg-5">Av. 1 de Maio 235,<br>6000-086 Castelo Branco</td>
                </tr>
                <tr>
                    <td class="pr-lg-5"><b>Contact:</b></td>
                    <td class="pl-lg-5">info@cbbus.pt<br>+351 695 246 213</td>
                </tr>
                <tr>
                    <td class="pr-lg-5"><b>Operating hours:</b></td>
                    <td class="pl-lg-5">Monday to friday: 9.00 am to 19.00 pm <br>
                        Saturday: 10.00 am to 14.00 <br>
                        Sunday: Closed
                    </td>
                </tr>
            </table>
        </div>
        </p>
    </div>
</div>
</body>
</html>