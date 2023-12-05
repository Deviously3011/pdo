<?php
// Include the Database class and connect to the database
include 'db.php';
$database = new Database();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $naam = $_POST['naam'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];
    $telefoonnummer = $_POST['telefoonnummer'];
    
    // Check if the email already exists in the database
    $existingEmail = $database->getPasswordByEmail($email);

    if ($existingEmail) {
        // Email already in use, handle accordingly (e.g., display an error message)
        echo '<p style="color: red;">Email is already in use. Choose another email.</p>';
    } else {
        // Get the password and hash it before storing it in the database
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Add contact to the database
        $database->addContact($naam, $achternaam, $email, $telefoonnummer, $password);
        echo '<p style="color: green;">Registration successful!</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Contact Management</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <h1 class="mt-4">User Registration</h1>
    <form action="register.php" method="post">
        <!-- Form fields for user registration go here -->
        <div class="form-group">
            <label for="naam">Naam:</label>
            <input type="text" name="naam" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="achternaam">Achternaam:</label>
            <input type="text" name="achternaam" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="telefoonnummer">Phone Number:</label>
            <input type="text" name="telefoonnummer" class="form-control" required>
        </div>

        <!-- New password field -->
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>

</body>
</html>
