<?php
class UsuarioModel {
    private $conn;
    private $table_name = "usuarios";

    public $id;
    public $nombre;
    public $ci_ruc;
    public $direccion;
    public $telefono;
    public $email;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Crea un nuevo usuario en la base de datos
    public function create($nombre, $ci_ruc, $direccion, $telefono, $email) {
        $query = "INSERT INTO " . $this->table_name . " (nombre, ci_ruc, direccion, telefono, email) VALUES (:nombre, :ci_ruc, :direccion, :telefono, :email)";
        $stmt = $this->conn->prepare($query);

        // Bind de los parámetros
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':ci_ruc', $ci_ruc);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':email', $email);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Obtiene todos los usuarios de la base de datos
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Obtiene un usuario por su ID
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->nombre = $row['nombre'];
        $this->ci_ruc = $row['ci_ruc'];
        $this->direccion = $row['direccion'];
        $this->telefono = $row['telefono'];
        $this->email = $row['email'];
    }

    // Actualiza un usuario en la base de datos
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nombre = :nombre, ci_ruc = :ci_ruc, direccion = :direccion, telefono = :telefono, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->ci_ruc = htmlspecialchars(strip_tags($this->ci_ruc));
        $this->direccion = htmlspecialchars(strip_tags($this->direccion));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':ci_ruc', $this->ci_ruc);
        $stmt->bindParam(':direccion', $this->direccion);
        $stmt->bindParam(':telefono', $this->telefono);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Elimina un usuario de la base de datos por su ID
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
