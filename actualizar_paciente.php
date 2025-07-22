<?php
include 'connect_dev.php';
$data = json_decode(file_get_contents("php://input"));

try {
    if (isset($data->eliminar_id)) {
        $stmt = $conn->prepare("DELETE FROM paciente WHERE id = ?");
        $stmt->execute([$data->eliminar_id]);
        echo json_encode(["success" => true, "accion" => "eliminado"]);
    } elseif (
        isset($data->id, $data->usuario, $data->nombre, $data->telefono, $data->correo, $data->fecha_nacimiento)
    ) {
        $stmt = $conn->prepare("UPDATE paciente SET usuario = ?, nombre = ?, telefono = ?, correo = ?, fecha_nacimiento = ? WHERE id = ?");
        $stmt->execute([
            $data->usuario,
            $data->nombre,
            $data->telefono,
            $data->correo,
            $data->fecha_nacimiento,
            $data->id
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
