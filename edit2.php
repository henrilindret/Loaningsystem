<?php
require('main.php');

if (isset($_POST['ID']) && isset($_POST['text'])) {
    $ID = $_POST['ID'];
    $text = $_POST['text'];

    // Update the 'text' column of the 'motherboard_list' table for the given ID
    $servername = "localhost";
    $username = "root";
    $password = "test";
    $database = "andmebaas";
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $nameQuery = "SELECT Motherboardname FROM motherboard_list WHERE ID = $ID";
    $result = $conn->query($nameQuery);


    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $motherboardName = $row['Motherboardname'];

        // Update the 'text' column in 'motherboard_list' table
        $query = "UPDATE motherboard_list SET Brokentext = '$text' WHERE ID = $ID";
        $conn->query($query);

        // Insert the text and current datetime into 'changelog' table
        date_default_timezone_set('Europe/Tallinn');
        $datetime = date('Y-m-d H:i:s');
        $changelogQuery = "INSERT INTO changelog (ID, Brokentext, date_time, motherboard_name) VALUES ($ID, '$text', '$datetime', '$motherboardName')";
        $conn->query($changelogQuery);

        // Redirect to main.php or any other desired location
        update2($ID);
    } else {
        echo "Motherboard with ID $ID not found.";
    }
}



?>