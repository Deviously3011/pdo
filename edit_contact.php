<?php
include 'db.php';

// Create a new instance of the Database class
$database = new Database();

// Check if the form is submitted for updating contact
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateContact'])) {
    $contactIdToUpdate = $_POST['contactId'];
    $updatedNaam = $_POST['updatedNaam'];
    $updatedAchternaam = $_POST['updatedAchternaam'];
    $updatedEmail = $_POST['updatedEmail'];

    // Call the editContact method to update the contact details
    $database->editContact($contactIdToUpdate, $updatedNaam, $updatedAchternaam, $updatedEmail);
}

// Check if the ID is provided in the URL
if (isset($_GET['id'])) {
    $contactId = $_GET['id'];

    // Fetch the contact details based on the ID
    $contactDetails = $database->selectData($contactId);

    if ($contactDetails) {
        $naam = $contactDetails[0]['naam'];
        $achternaam = $contactDetails[0]['achternaam'];
        $email = $contactDetails[0]['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Contact</title>
</head>
<body>

<!-- Form for editing a contact -->
<form method="post">
    <input type="hidden" name="contactId" value="<?php echo $contactId; ?>">
    <label for="updatedNaam">Naam:</label>
    <input type="text" name="updatedNaam" id="updatedNaam" value="<?php echo $naam; ?>" required><br>
    <label for="updatedAchternaam">Achternaam:</label>
    <input type="text" name="updatedAchternaam" id="updatedAchternaam" value="<?php echo $achternaam; ?>" required><br>
    <label for="updatedEmail">Email:</label>
    <input type="email" name="updatedEmail" id="updatedEmail" value="<?php echo $email; ?>" required><br>
    <button type="submit" name="updateContact">Update Contact</button>
</form>

</body>
</html>

<?php
    } else {
        echo "Contact not found.";
    }
} else {
    echo "Contact ID not provided.";
}
?>
