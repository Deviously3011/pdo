<?php

class Database {
    public $pdo;

    public function __construct($db = "contactdb", $user="root", $pass="", $host="localhost:3307") {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected to database $db";
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
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
            echo "Error selecting data: " . $e->getMessage();
        }
    }

    public function addContact($naam, $achternaam, $email) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO contacts (naam, achternaam, email) VALUES (:naam, :achternaam, :email)");
            $stmt->bindParam(':naam', $naam);
            $stmt->bindParam(':achternaam', $achternaam);
            $stmt->bindParam(':email', $email);

            $stmt->execute();
            echo "Contact added successfully";
        } catch(PDOException $e) {
            echo "Error adding contact: " . $e->getMessage();
        }
    }

    public function deleteContact($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM contacts WHERE id = :id");
            $stmt->bindParam(':id', $id);

            $stmt->execute();
            echo "Contact deleted successfully";
        } catch(PDOException $e) {
            echo "Error deleting contact: " . $e->getMessage();
        }
    }
    public function editContact($id, $naam, $achternaam, $email) {
        try {
            $stmt = $this->pdo->prepare("UPDATE contacts SET naam = :naam, achternaam = :achternaam, email = :email WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':naam', $naam);
            $stmt->bindParam(':achternaam', $achternaam);
            $stmt->bindParam(':email', $email);
    
            $stmt->execute();
            echo "Contact updated successfully";
        } catch (PDOException $e) {
            echo "Error updating contact: " . $e->getMessage();
        }
    }
    
}

?>
