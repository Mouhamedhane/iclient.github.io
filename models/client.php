<?php
class Client {
    private $conn;
    private $table_name = "clients";

    public $id;
    public $name;
    public $address;
    public $phone;
    public $email;
    public $gender;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lire tous les clients
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Créer un client
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, address=:address, phone=:phone, email=:email, gender=:gender, status=:status";
        $stmt = $this->conn->prepare($query);

        // Assainir
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->status = htmlspecialchars(strip_tags($this->status));

        // Lier les valeurs
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":gender", $this->gender);
        $stmt->bindParam(":status", $this->status);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Lire un seul client
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->name = $row['name'];
            $this->address = $row['address'];
            $this->phone = $row['phone'];
            $this->email = $row['email'];
            $this->gender = $row['gender'];
            $this->status = $row['status'];
            return $row;  // Retourner le résultat pour l'utiliser dans le contrôleur
        }

        return null;  // Retourner null si aucun client n’est trouvé
    }

    // Mettre à jour un client
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET name = :name, address = :address, phone = :phone, email = :email, gender = :gender, status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Assainir
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Lier les valeurs
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Supprimer un client
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        // Assainir
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Lier les valeurs
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Filtrer les clients
    public function filter($column, $value) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE " . $column . " LIKE ?";
        $stmt = $this->conn->prepare($query);

        // Assainir
        $value = htmlspecialchars(strip_tags($value));
        $value = "%{$value}%";

        // Lier les valeurs
        $stmt->bindParam(1, $value);

        $stmt->execute();
        return $stmt;
    }

    // Trier les clients
    public function sort($column, $order) {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY " . $column . " " . $order;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>
