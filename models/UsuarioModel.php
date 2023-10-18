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

    public function create($nombre, $ci_ruc, $direccion, $telefono, $email) {
        $query = "INSERT INTO " . $this->table_name . " (nombre, ci_ruc, direccion, telefono, email) VALUES (:nombre, :ci_ruc, :direccion, :telefono, :email)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':ci_ruc', $ci_ruc);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            $ultimoId = $this->conn->lastInsertId();
            $query ="CALL CrearClienteDesdeUsuario(:usuarioId)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':usuarioId', $ultimoId);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
            return true;
        } else {
            return false;
        }
    }


    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update($id,$nombre, $ci_ruc, $direccion, $telefono, $email) {
        $query = "UPDATE " . $this->table_name . " SET nombre = :nombre, ci_ruc = :ci_ruc, direccion = :direccion, telefono = :telefono, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':ci_ruc', $ci_ruc);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function verifyAuth($username, $password) {
        $query = "SELECT * FROM usuarios WHERE nombre = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            if ($password == $usuario['ci_ruc']) {
              
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
