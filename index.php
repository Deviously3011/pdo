<?php
session_start();

if(isset($_SESSION['user']) && $_SESSION['user'] === 'admin') {
    header('Location: home.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Management System</title>
   
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h1>Welcome to the Contact Management System</h1>
    <p class="lead">Manage your contacts easily with our user-friendly interface.</p>
    <p>Please <a href="login.php">log in</a> to access the system.</p>
</div>

</body>
</html>
