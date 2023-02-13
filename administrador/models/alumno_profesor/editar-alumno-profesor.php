<?php

require_once '../../../includes/conexion.php';

if (!empty($_GET)) {
    $id_alumno_profesor = $_GET['id'];

    $sql = "SELECT * FROM `alumno_profesor` WHERE ap_id = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($id_alumno_profesor));
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if (empty($result)) {
        $respuesta = array('status' => false, 'msg' => 'Datos no encontrados');
    }else {
        $respuesta = array('status' => true, 'data' => $result);
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}

?>