<?php

require_once 'database.php';

class HerbModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllHerbs() {
        $query = "SELECT * FROM herbs";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertHerb($name, $description) {
        $query = "INSERT INTO herbs (name,description) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $name, $description);
        
        return $stmt->execute();
    }

    public function deleteHerb($id) {
         $query = "DELETE FROM herbs WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

 

    public function getHouseholdInterests() {
             $query = "SELECT * FROM households";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertHouseholdInterest($household, $herbIds) {
          $query = "INSERT INTO households (household_name, herb1_id, herb2_id, herb3_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("siii", $household, $herbIds[0], $herbIds[1], $herbIds[2]);
        return $stmt->execute();
    }

    public function deleteHouseholdInterest($id) {
         $query = "DELETE FROM households WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    

    public function getSummaryOfInterests() {
       $query = "SELECT COUNT(DISTINCT household_name) AS
        total_households, herb1_id, COUNT(*) AS interest_count FROM households GROUP BY herb1_id";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>