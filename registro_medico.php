<?php
require_once "connect_dev.php";
$pdo = getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir y limpiar las entradas
    $usuario    = trim($_POST['usuario'] ?? '');
    $nombre     = trim($_POST['nombre'] ?? '');
    $especialidad = trim($_POST['especialidad'] ?? '');
    $telefono   = trim($_POST['telefono'] ?? '');
    $correo     = trim($_POST['correo'] ?? '');

    // Validación: asegurar que ningún campo esté vacío
    if (empty($usuario) || empty($nombre) || empty($especialidad) || empty($telefono) || empty($correo)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    // Validación: la fecha debe tener el formato "YYYY-MM-DD 00:00:00"
    // No es necesario validar la fecha en este caso, ya que no se está utilizando una
    // pero si tienes algún campo de fecha, puedes agregar la validación similar a tu ejemplo.

    try {
        // Insertar datos en la tabla 'medico'
        $sql = "INSERT INTO medico (usuario, nombre, especialidad, telefono, correo) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$usuario, $nombre, $especialidad, $telefono, $correo]);

        echo "Médico registrado correctamente.";
    } catch (PDOException $e) {
        echo "Error al registrar: " . $e->getMessage();
    }
}
?>
