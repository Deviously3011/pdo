<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
    header('Location: login.php');
    exit();
}

include 'db.php';
$database = new Database();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact List</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }

        .container {
            margin-top: 20px;
        }

        .table-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Contact Management</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="home.php">Home</a>
            </li>
         
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <h1 class="mt-4">Contact List</h1>

    <div class="table-container">
        <h2 class="mt-4">Contact List</h2>
        <?php
        $database->selectData();
        ?>
    </div>
</div>

<script>
    function editContact(contactId) {
        window.location.href = 'edit_contact.php?id=' + contactId;
    }

    function deleteContact(contactId) {
        if (confirm('Are you sure you want to delete this contact?')) {
            window.location.href = 'delete_contact.php?id=' + contactId;
        }
    }
</script>

</body>
</html>
