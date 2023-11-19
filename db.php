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

    public function addData($naam, $achternaam, $email) {
        try {
            $sql = "contacts your_table_name (naam, achternaam, email) VALUES (:naam, :achternaam, :email)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':naam', $naam);
            $stmt->bindParam(':achternaam', $achternaam);
            $stmt->bindParam(':email', $email);

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error adding data: " . $e->getMessage();
        }
    }
}

?>
