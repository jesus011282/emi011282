<?php
function getConnection() {
    $host = "sql201.infinityfree.com:3306";
    $dbname = "if0_37690264_medicos";
    $user = "if0_37690264";
    $password = "y3uc4h0uio";
   
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "El America es campeón"; // Mensaje si la conexión fue correcta
        return $pdo;
    } catch (PDOException $e) {
        echo "error..";
        die("Error de conexión: " . $e->getMessage()); // Mensaje si ocurre un error
    }
}

$conn = getConnection();
?>