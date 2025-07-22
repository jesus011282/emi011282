<?php
include 'connect_dev.php';
// Conexiòn a la base de datos 
$data = json_decode(file_get_contents("php://input"));
// Este lee y lo convierte en el objeto en PHP

try {
    if (isset($data->eliminar_id)) {
        // Se puede realizar la eliminar cita
        $stmt = $conn->prepare("DELETE FROM cita WHERE id = ?");
        $stmt->execute([$data->eliminar_id]);
        echo json_encode(["success" => true, "accion" => "eliminado"]);
    } elseif (isset($data->id, $data->fecha, $data->hora)) {
        // Se realiza la actualizar cita
        $stmt = $conn->prepare("UPDATE cita SET fecha = ?, hora = ? WHERE id = ?");
        $stmt->execute([$data->fecha, $data->hora, $data->id]);
        echo json_encode(["success" => true, "accion" => "actualizado"]);
        // Si faltan los datos 
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Datos incompletos"]);
    }
    // Manejo de errores 
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
    // Cerrar las secciones 
} finally {
    // Cierra conexión PDO
    $conn = null;
}
?>