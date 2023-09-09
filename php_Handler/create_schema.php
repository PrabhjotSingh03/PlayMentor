<?php

require_once '/php_Handler/database_connection.php';
// Create the database
//$sql = "CREATE DATABASE IF NOT EXISTS $database";
//if ($con->query($sql) === true) {
//    echo 'Database successfully <br/>';
//} else {
//    echo 'Database Error: ' . $con->error;
//}
// Now Select the database
//$con->select_db($database);
$sql = "
    CREATE TABLE IF NOT EXISTS CategoryTable (
        category_id INT(11) AUTO_INCREMENT PRIMARY KEY,
        Category_type VARCHAR(50) NOT NULL
    );
    CREATE TABLE IF NOT EXISTS GameTable (
        Id INT(11) AUTO_INCREMENT PRIMARY KEY,
        Title VARCHAR(100) NOT NULL,
        Description TEXT,
        Platform VARCHAR(50),
        Company VARCHAR(50),
        Release_date DATE,
        Rating DECIMAL(3,1),
        Image VARCHAR(255),
        Price DECIMAL(10,2),
        category_id INT(11),
        FOREIGN KEY (category_id) REFERENCES CategoryTable(category_id)
    );
";

if ($con->multi_query($sql) === true) {
    echo 'Tables successfully <br/>';
} else {
    echo 'Error tables: ' . $con->error;
}
// Close the connection
$con->close();

// Redirect to another page
header('Location: ../pages/admin.php');
exit();
?>
