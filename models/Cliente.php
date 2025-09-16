<?php
class Cliente {
    private $conn;
    private $table = "clientes";

    public $id;
    public $nombre;
    public $telefono;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Crear cliente
    public function crear() {
        $sql = "INSERT INTO " . $this->table . " (nombre, telefono) VALUES (:nombre, :telefono)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":telefono", $this->telefono);

        return $stmt->execute();
    }

    // Listar clientes
    public function listar() {
        $sql = "SELECT * FROM " . $this->table . " ORDER BY nombre";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
}
