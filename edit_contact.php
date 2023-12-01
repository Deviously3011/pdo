<?php
// Include the Database class and connect to the database
include 'db.php';
$database = new Database();

// Check if the contact ID is provided in the URL
if (isset($_GET['id'])) {
    $contactId = $_GET['id'];

    // Check if the form is submitted for editing
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_contact'])) {
        // Get form data for editing
        $naam = $_POST['naam'];
        $achternaam = $_POST['achternaam'];
        $email = $_POST['email'];
        $telefoonnummer = $_POST['telefoonnummer'];

        // Edit contact in the database
        $database->editContact($contactId, $naam, $achternaam, $email, $telefoonnummer);

        // Redirect to the home page or any other desired page after editing
        header("Location: home.php");
        exit();
    }

    // Check if the form is submitted for deleting
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_contact'])) {
        // Delete contact from the database
        $database->deleteContact($contactId);

        // Redirect to the home page or any other desired page after deletion
        header("Location: home.php");
        exit();
    }

    // Fetch the contact data based on the ID
    $contactData = $database->selectData($contactId);

    // Check if the contact exists
    if ($contactData) {
        // Pre-fill the form fields with the existing data
        $naam = $contactData[0]['naam'];
        $achternaam = $contactData[0]['achternaam'];
        $email = $contactData[0]['email'];
        $telefoonnummer = $contactData[0]['telefoonnummer'];
    } else {
        // Handle the case where the contact ID is not valid
        echo 'Invalid contact ID';
        exit();
    }
} else {
    // Handle the case where the contact ID is not provided
    echo 'Contact ID not provided.';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Contact</title>
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
                <a class="nav-link" href="edit_contact.php">Edit Contact</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <h1 class="mt-4">Edit Contact</h1>
    <form action="edit_contact.php?id=<?php echo $contactId; ?>" method="post">
        <!-- Add a hidden input field to store the contact ID -->
        <input type="hidden" name="contact_id" value="<?php echo $contactId; ?>">

        <div class="form-group">
            <label for="naam">Naam:</label>
            <input type="text" name="naam" class="form-control" value="<?php echo $naam; ?>" required>
        </div>

        <div class="form-group">
            <label for="achternaam">Achternaam:</label>
            <input type="text" name="achternaam" class="form-control" value="<?php echo $achternaam; ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email"\ class="form-control" value="<?php echo $email; ?>" required>
        </div>

        <div class="form-group">
            <label for="telefoonnummer">Phone Number:</label>
            <input type="text" name="telefoonnummer" class="form-control" value="<?php echo $telefoonnummer; ?>" required>
        </div>

        <!-- Use different names for the submit buttons -->
        <button type="submit" name="edit_contact" class="btn btn-primary">Save Changes</button>

        <!-- Add a Delete button -->
        <button type="submit" name="delete_contact" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this contact?')">Delete</button>
    </form>
</div>

</body>
</html>
