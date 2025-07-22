<?php
session_start();
require_once "connect_dev.php";
$conn = getConnection();

if (isset($_POST['usuario']) && isset($_POST['password'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Consulta segura con PDO
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1");
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Comparación directa SIN hash
        if ($password === $user['pass']) {
            $_SESSION['usuario'] = $user['usuario'];
            echo "Acceso correcto";
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
} else {
    echo "Datos incompletos.";
}
?>