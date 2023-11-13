<?php
class database{
    public $pdo;
    public function __construct($db = "test", $user="root", $pass="", $host="localhost:3307"){
           try{ $this->pdo = new PDO("mysql:host=$host;dbname =$db", $user,$pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo"connected to database $db";
    }catch(PDOException $e) {
        echo "connection failed:"  . $e->getMessage();
                
    }  

                   }
}
?>