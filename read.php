<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'practice'; // Change this to your actual DB name

// Create connection
$db = new mysqli($host, $user, $password, $database);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// column variables
$fname = $db->real_escape_string($_POST["fname"]); 
$lname = $db->real_escape_string($_POST["lname"]); 
$email = $db->real_escape_string($_POST["email"]);
$cars = $_POST["cars"];

// MySQL query to insert data
$sql = "INSERT INTO contact (fname, lname, email, cars) VALUES ('$fname', '$lname', '$email', '$cars')"; //Note: Wrong way: using double quotes both inside and outside

if ($db->query($sql) === TRUE) {
    echo "New record inserted successfully";
    } else {
        echo "Error: " . $sql. "<br>". $db->error;
    }
    
    // Close connection
    $db->close();
?> 

<!-- mysql_table: INSERT INTO `contact` (`id`, `fname`, `lname`, `email`, `car`, `uid`, `added_at`, `updated_at`, `status`) VALUES (NULL, 'arham', 'amin', 'arham@gmail.com', 'Honda', NULL, current_timestamp(), current_timestamp(), '0'); -->