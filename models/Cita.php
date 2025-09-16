<?php
class Cita {
    private $conn;
    private $table = "citas";

    public $id;
    public $cliente; // Cambiado de cliente_id a cliente
    public $fecha;
    public $hora;
    public $servicio;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Crear cita
    public function crear() {
        $query = "INSERT INTO citas (cliente, fecha, hora, servicio) VALUES (:cliente, :fecha, :hora, :servicio)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':cliente', $this->cliente);
        $stmt->bindParam(':fecha', $this->fecha);
        $stmt->bindParam(':hora', $this->hora);
        $stmt->bindParam(':servicio', $this->servicio);

        return $stmt->execute();
    }

    // Listar citas
    public function listar() {
        $sql = "SELECT id, cliente, fecha, hora, servicio
                FROM " . $this->table . "
                ORDER BY fecha, hora";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
}
