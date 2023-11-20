<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact List</title>
</head>
<body>

<?php
include 'db.php';

// Create a new instance of the Database class
$database = new Database();

// Handle Delete operation if the request is from a form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteContact'])) {
    $contactIdToDelete = $_POST['deleteContact'];
    $database->deleteContact($contactIdToDelete);
}

// Uncomment the line below and run the script once to add a contact
// $database->addContact("John", "Doe", "john.doe@example.com");

// Call the selectData function to display the contacts
$database->selectData();
?>

<form method="post">
    <label for="deleteContactId">Enter ID to delete:</label>
    <input type="number" name="deleteContact" id="deleteContactId" required>
    <button type="submit">Delete</button>
</form>
<script>
    function editContact(contactId) {
        // Redirect to the edit_contact.php page with the contact ID
        window.location.href = 'edit_contact.php?id=' + contactId;
    }
</script>

</body>
</html>
