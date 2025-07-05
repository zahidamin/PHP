<?php

function pages() 
{
    if (!empty($_GET['page'])) {
        if (file_exists('pages/' . $_GET['page'] . '.php')) {
            // Include the requested page
            include 'pages/' . $_GET['page'] . '.php';
        } else {
            // Include a 404 page if the requested page does not exist
            include 'pages/404.php';
        }
    } else {
        // Default page if no specific page is requested
        include 'pages/home.php';
    }
}

// Function to connect to the database
function dbConnect() {
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'practice';

    // Create connection
    $db = new mysqli($host, $user, $password, $database);

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    return $db;
}

?>
