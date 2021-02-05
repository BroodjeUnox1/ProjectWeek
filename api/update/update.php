<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// DB info
$servername = 'localhost';
$username = 'id15304214_projectweek';
$password = '%/[fWDDH4W25$i\Q';
$dbname = 'id15304214_users';
// Connecting DB
$conn = new mysqli($servername, $username, $password, $dbname);
// check conn
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$title = $_POST['title'];
$thread = $_POST['thread'];
$id = $_POST['id'];

$sql = "UPDATE threads SET title= '$title', thread='$thread' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
  echo "Success";
  // header("Location: https://webdevelopmentlj1.000webhostapp.com/thread.php");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

