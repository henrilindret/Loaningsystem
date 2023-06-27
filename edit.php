<?php
require('main.php');

if (isset($_POST['ID'])) {
    $ID = $_POST['ID'];
    update($ID);
}


?>