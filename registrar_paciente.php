<?php
require_once "connect_dev.php";
$pdo = getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario          = trim($_POST['usuario'] ?? '');
    $nombre           = trim($_POST['nombre'] ?? '');
    $telefono         = trim($_POST['telefono'] ?? '');
    $correo           = trim($_POST['correo'] ?? '');
    $fecha_nacimiento = $_POST['fecha_nacimiento'];

    if (empty($usuario) || empty($nombre) || empty($telefono) || empty($correo) || empty($fecha_nacimiento)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    $fechaObj = DateTime::createFromFormat('Y-m-d H:i:s', $fecha_nacimiento);
    $fechaErrors = DateTime::getLastErrors();
    if ($fechaObj === false || $fechaErrors['warning_count'] > 0 || $fechaErrors['error_count'] > 0) {
        echo "La fecha de nacimiento debe tener el formato YYYY-MM-DD 00:00:00.";
        exit;
    }

    try {
        $sql = "INSERT INTO paciente (usuario, nombre, telefono, correo, fecha_nacimiento) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$usuario, $nombre, $telefono, $correo, $fecha_nacimiento]);

        echo "Paciente registrado correctamente.";
    } catch (PDOException $e) {
        echo "Error al registrar: " . $e->getMessage();
    }
}
?>
