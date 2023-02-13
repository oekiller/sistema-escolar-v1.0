<?php

require_once '../../../includes/conexion.php';

if ($_POST) {
    $idevaluacion = $_POST['idevaluacion'];

    $sql_Update = "DELETE FROM `evaluaciones` WHERE evaluacion_id = ?";
    $query_Update = $pdo->prepare($sql_Update);
    $result = $query_Update->execute(array($idevaluacion));

    if ($result) {
        $arrRespuesta = array('status' => true, 'msg' => 'Eliminado Correctamente');
    }else {
        $arrRespuesta = array('status' => false, 'msg' => 'Error al Eliminar');
    }
    echo json_encode($arrRespuesta, JSON_UNESCAPED_UNICODE);
}

?>