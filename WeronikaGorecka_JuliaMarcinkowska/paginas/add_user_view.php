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
    <title>Add new user</title>
    <link rel="stylesheet" href="bootstrap-4.5.0/css/bootstrap.min.css"/>

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px;
            font-size: 16px;
        }

        .form-signin .form-control:focus {
            z-index: 2;
        }

    </style>
</head>
<body class="text-center">

<div class="align-content-md-center ml-auto">
    <img src="resources/bus_icon.png">
</div>
<form class="form-signin" action="add_user.php" method="post">
    <h1 class="h3 mb-3 font-weight-normal">Add new user</h1>


    <?php
    include "../basedados/basedados.h";

    global $conn;
    $sql = "SELECT * FROM usertypes";
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
        die('Could not get data: ' . mysqli_error($conn));
    }
    if ($_SESSION["type"] == 3) {
        echo "<select class='custom-select mt-lg-1' name='usertype_select' required autofocus>";
        echo "<option value='' disabled selected>Choose usertype</option>";
        while ($row = mysqli_fetch_array($retval)) {
            echo "<option value='" . $row["ID"] . "'> " . $row["name"] . " </option>";
        }
        echo "</select>";
    }
    if ($_SESSION["type"] == 2) {
        echo "<select class='custom-select mt-lg-1' name='usertype_select'>";
        echo "<option value='1' selected>Client</option>";
        echo "</select>";
    }
    ?>

    <input type="text" name="name" class="form-control mt-lg-1" placeholder="Name" required>
    <input type="email" name="email" class="form-control mt-lg-1" placeholder="Email" required>
    <input type="text" name="login" class="form-control mt-lg-1" placeholder="Login" required>
    <input type="password" name="password" class="form-control mt-lg-1" placeholder="Password" required>
    <button class="btn btn-lg btn-primary btn-block mt-lg-1" type="submit">Add</button>
</form>
</body>
</html>
