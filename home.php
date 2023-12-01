<?php
include 'db.php';
$pdo = connectToDatabase();
$database = new Database($pdo);
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
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="edit_contact.php">Edit Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="register.php">Register</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <h1 class="mt-4">Contact List</h1>

    <div class="row">
        <div class="col-md-6">
            <h2>Add Contact</h2>
            <form action="register.php" method="post">
                <!-- Form fields for adding contacts go here -->
                <button type="submit" class="btn btn-primary">Add Contact</button>
            </form>
        </div>

        <div class="col-md-6">
            <h2>Delete Contact</h2>
            <form method="post" action="edit_contact.php">
                <div class="form-group">
                    <label for="deleteContactId">Enter ID to delete:</label>
                    <input type="number" class="form-control" name="deleteContact" id="deleteContactId" required>
                </div>
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>

    <div class="table-container">
        <h2 class="mt-4">Contact List</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteContact'])) {
            $contactIdToDelete = $_POST['deleteContact'];
            $database->deleteContact($contactIdToDelete);
        }

        $database->selectData();
        ?>
    </div>
</div>

<script>
    function editContact(contactId) {
        window.location.href = 'edit_contact.php?id=' + contactId;
    }
</script>

</body>
</html>
