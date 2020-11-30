<?php
include_once "config.php";

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if(!$connection) {
    throw new Exception("Not Connected To Database");
} else {
    echo "Connected To Database";
    //insert a record
    //mysqli_query($connection,"INSERT INTO tasks(task, date) VALUES('Do Something', '2020-11-08')");
    //show data records;
    //$records = mysqli_query($connection, "SELECT * FROM tasks");
    //while($data = mysqli_fetch_assoc($records)) {
    //    echo '<pre>';
    //    print_r($data);
    //    echo '</pre>';
    //mysqli_close($connection);
}