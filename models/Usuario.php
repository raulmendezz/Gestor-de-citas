<?php
class Usuario {
    private $conn;
    private $table = "usuarios";

    public $id;
    public $nombre;
    public $email;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Registrar nuevo usuario
    public function registrar() {
        $sql = "INSERT INTO " . $this->table . " (nombre, email, password) VALUES (:nombre, :email, :password)";
        $stmt = $this->conn->prepare($sql);

        // Encriptamos la contraseña
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);

        return $stmt->execute();
    }

    // Verificar login
    public function login() {
        $sql = "SELECT * FROM " . $this->table . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $this->email);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($this->password, $usuario['password'])) {
            return $usuario; // Devuelve los datos del usuario
        }
        return false;
    }
}
