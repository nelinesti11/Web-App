<?php
$name = $_POST['name'];
$dob = $_POST['dob'];
$dod = $_POST['dod'];
$content = $_POST['content'];
$author = $_POST['author'];

$servername = "localhost";
$username = "FIDEL CHIMWANI";
$password = "your_password";
$dbname = "obituary_platform";

$conn = new mysqli("localhost", "root", "", "obituary_platform");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO obituaries (name, dob, dod, content, author) VALUES ('$name', '$dob', '$dod', '$content', '$author')";

if ($conn->query($sql) === TRUE) {
    echo "New record added successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>