<?php

function connectToDatabase() {
    $host = 'localhost:3307';
    $dbname = 'contactdb';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

class Database {
    private $pdo;

    public function __construct() {
        // Use the connectToDatabase function to get the PDO instance
        $this->pdo = connectToDatabase();
    }

    public function selectData($id = null) {
        try {
            if ($id !== null) {
                $stmt = $this->pdo->prepare("SELECT * FROM contacts WHERE id = :id");
                $stmt->bindParam(':id', $id);
            } else {
                $stmt = $this->pdo->query("SELECT * FROM contacts");
            }

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Display results in a table
            echo '<table border="1">';
            echo '<tr><th>ID</th><th>Naam</th><th>Achternaam</th><th>Email</th><th>Edit</th></tr>';
            foreach ($result as $row) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['naam'] . '</td>';
                echo '<td>' . $row['achternaam'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td><button onclick="editContact(' . $row['id'] . ')">Edit</button></td>';
                echo '</tr>';
            }
            echo '</table>';

            return $result;
        } catch(PDOException $e) {
            $this->handleError("Error selecting data", $e);
        }
    }

    public function addContact($naam, $achternaam, $email, $telefoonnummer) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO contacts (naam, achternaam, email, telefoonnummer) VALUES (:naam, :achternaam, :email, :telefoonnummer)");
            $stmt->bindParam(':naam', $naam);
            $stmt->bindParam(':achternaam', $achternaam);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefoonnummer', $telefoonnummer);

            $stmt->execute();
            echo "Contact added successfully";
        } catch(PDOException $e) {
            $this->handleError("Error adding contact", $e);
        }
    }

    public function deleteContact($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM contacts WHERE id = :id");
            $stmt->bindParam(':id', $id);

            $stmt->execute();
            echo "Contact deleted successfully";
        } catch(PDOException $e) {
            $this->handleError("Error deleting contact", $e);
        }
    }

    public function editContact($id, $naam, $achternaam, $email, $telefoonnummer) {
        try {
            $stmt = $this->pdo->prepare("UPDATE contacts SET naam = :naam, achternaam = :achternaam, email = :email, telefoonnummer = :telefoonnummer WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':naam', $naam);
            $stmt->bindParam(':achternaam', $achternaam);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefoonnummer', $telefoonnummer);

            $stmt->execute();
            echo "Contact updated successfully";
        } catch (PDOException $e) {
            $this->handleError("Error updating contact", $e);
        }
    }

    // Additional helper method for error handling
    private function handleError($message, $exception) {
        // Log the error for your reference
        error_log("$message: " . $exception->getMessage());
        echo "An error occurred. Please try again later.";
    }
}

?>
