<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Display Page</title>
</head>
<body>

<?php
include 'db.php';

// Create a new instance of the Database class
$database = new Database();

// Call the selectData function without specifying an ID
$database->selectData();
?>

</body>
</html>
