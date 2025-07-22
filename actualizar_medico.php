<?php
include 'connect_dev.php';
$data = json_decode(file_get_contents("php://input"));

try {
    if (isset($data->eliminar_id)) {
        $stmt = $conn->prepare("DELETE FROM medico WHERE id = ?");
        $stmt->execute([$data->eliminar_id]);
        echo json_encode(["success" => true, "accion" => "eliminado"]);
    } elseif (isset($data->id)) {
        $stmt = $conn->prepare("UPDATE medico SET nombre = ?, especialidad = ?, telefono = ?, correo = ?, usuario = ? WHERE id = ?");
        $stmt->execute([
            $data->nombre, $data->especialidad, $data->telefono,
            $data->correo, $data->usuario, $data->id
        ]);
        echo json_encode(["success" => true, "accion" => "actualizado"]);
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Datos incompletos"]);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
} finally {
    $conn = null;
}
?>
