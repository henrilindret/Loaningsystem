<?php

function load_motherboards()
{
    $servername = "localhost";
    $username = "root";
    $password = "test";
    $database = "andmebaas";
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $query = "SELECT Motherboardname, Working, ID from motherboard_list where Working = 1";
    $data = $conn->query($query);
    $rows = $data->fetch_all(MYSQLI_ASSOC);
    foreach ($rows as $row) {
        printf("%s \n", $row["Motherboardname"]);
        echo "<input type='submit' onclick='edit($row[ID]);' style='margin-right:5px;' class='' value='Loan' />";
        echo "<input type='submit' onclick='edit2($row[ID]);' style='margin-right:5px;' class='' value='Repair' />";
        echo "<br>";


    }
}


function load_motherboards2()
{
    $servername = "localhost";
    $username = "root";
    $password = "test";
    $database = "andmebaas";
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $query = "SELECT Motherboardname, Working, ID from motherboard_list where Loaned = 1";
    $data = $conn->query($query);
    $rows = $data->fetch_all(MYSQLI_ASSOC);
    foreach ($rows as $row) {
        printf("%s \n", $row["Motherboardname"]);
        echo "<input type='submit' onclick='edit($row[ID]);' style='margin-right:5px;' class='' value='Loan' />";
        echo "<br>";


    }

}

function load_motherboards3()
{
    $servername = "localhost";
    $username = "root";
    $password = "test";
    $database = "andmebaas";
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $query = "SELECT Motherboardname, Broken, ID, Brokentext from motherboard_list where Broken = 1";
    $data = $conn->query($query);
    $rows = $data->fetch_all(MYSQLI_ASSOC);
    foreach ($rows as $row) {
        printf("%s \n", $row["Motherboardname"]);
        printf("%s \n", $row["Brokentext"]);
        echo "<input type='submit' onclick='edit($row[ID]);' style='margin-right:5px;' class='' value='Repaired' />";
        echo "<br>";


    }

}

function getChangelog()
{
    $servername = "localhost";
    $username = "root";
    $password = "test";
    $database = "andmebaas";
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT Brokentext, date_time, ID, motherboard_name FROM changelog ORDER BY date_time DESC";
    $data = $conn->query($query);
    $rows = $data->fetch_all(MYSQLI_ASSOC);
    foreach ($rows as $row) {
        printf("%s \n", $row["date_time"]);
        printf("%s \n", $row["motherboard_name"]);
        printf("%s \n", $row["Brokentext"]);
        echo "<br>";
    }

}





function update($ID)
{
    $servername = "localhost";
    $username = "root";
    $password = "test";
    $database = "andmebaas";
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT Working, Loaned, Broken, ID, Brokentext FROM motherboard_list WHERE ID = $ID";
    $data = $conn->query($query);
    if ($data->num_rows > 0) {
        $row = $data->fetch_assoc();
        if ($row['Working'] == 1) {
            $query2 = "UPDATE motherboard_list SET Working = 0, Loaned = 1 WHERE ID = $ID";
            $conn->query($query2);
            header('Location: main.php');
            exit();
        } elseif ($row['Loaned'] == 1) {
            $query2 = "UPDATE motherboard_list SET Working = 1, Loaned = 0 WHERE ID = $ID";
            $conn->query($query2);
            header('Location: main.php');
            exit();
        } elseif ($row['Broken'] == 1) {
            $query2 = "UPDATE motherboard_list SET Working = 1, Brokentext = ' ', Broken = 0 WHERE ID = $ID";
            $conn->query($query2);
            header('Location: main.php');
            exit();
        }
    }

}


function update2($ID)
{
    $servername = "localhost";
    $username = "root";
    $password = "test";
    $database = "andmebaas";
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT Working, Loaned, Broken, ID, Brokentext FROM motherboard_list WHERE ID = $ID";
    $data = $conn->query($query);
    if ($data->num_rows > 0) {
        $row = $data->fetch_assoc();
        if ($row['Working'] == 1) {
            $query2 = "UPDATE motherboard_list SET Working = 0, Broken = 1 WHERE ID = $ID";
            $conn->query($query2);
            header('Location: main.php');
            exit();
        }
    }

}




?>


<!DOCTYPE html>
<html lang="en">





<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <h1>Available</h1>
        <div class="row">
            <div class="col">
                <p>
                    <?php load_motherboards(); ?>
                </p>
            </div>
        </div>
    </div>

    <div class="container">
        <h1>Loaned list</h1>
        <div class="row">
            <div class="col">
                <p>
                    <?php load_motherboards2(); ?>
                </p>
            </div>
        </div>
    </div>

    <div class="container">
        <h1>Broken list</h1>
        <div class="row">
            <div class="col">
                <p>
                    <?php load_motherboards3(); ?>
                </p>
            </div>
        </div>
    </div>

    <div class="container">
        <h1>Changelog</h1>
        <div class="row">
            <div class="col">
                <p>
                    <?php getChangelog(); ?>
                </p>
            </div>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="button.js"></script>


</body>

</html>