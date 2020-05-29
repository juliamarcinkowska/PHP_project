<!doctype html>
<html lang="en">
<head>
    <title>Search</title>
    <link rel="stylesheet" href="bootstrap-4.5.0/css/bootstrap.min.css"/>

    <style>

        html,
        body {
            height: 100%;
        }
    </style>
</head>

<body>
<div class="d-flex">
    <img src="resources/bus_icon.png" class="mx-auto mt-lg-5 mb-lg-4" style="width: 250px;"/>
</div>
<?php
include "../basedados/basedados.h";
session_start();
global $conn;
$sql = "SELECT * FROM courses";
$retval = mysqli_query($conn, $sql);
if (!$retval) {
    die('Could not get data: ' . mysqli_error($conn));
}
echo "<form class='justify-content-center d-flex' action='bus_table.php' method='post'>";
echo "<select class='custom-select w-25 mx-lg-3' name='route_select' required>";
echo "<option value='' disabled selected>Choose route</option>";
    while ($row = mysqli_fetch_array($retval)) {
        echo "<option value=" . $row["ID"] . ">" . $row["city_from"] . " - " . $row["city_to"] . "</option>";
    }
echo "</select>";
echo "<input type='date' min='" . date("Y-m-d") . "' name='date_search' class='form-control w-25 mx-lg-3' placeholder='Date' required>";
echo "<button class='btn btn-dark' type='submit'>Search</button>";
?>
</form>
</body>
</html>