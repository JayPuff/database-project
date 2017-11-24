<?php
$servername = "xvc353_2.encs.concordia.ca";
$username = "xvc353_2";
$password = "concord9";
$dbname = "xvc353_2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

$sql = "INSERT INTO Team (fname, lname)
VALUES ('Michel', 'Perlsteyn')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>