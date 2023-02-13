<?php

require_once '../../../includes/conexion.php';

if($_POST) {
    $idactividad = $_POST['idactividad'];

    $sql = "UPDATE actividad  SET estado = 0 WHERE actividad_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($idactividad));

    if ($result) {
        $respuesta = array('status'=> true, 'msg'=> 'Actividad Eliminada Correctamente');
    }else {
        $respuesta = array('status'=> false, 'msg'=> 'Error al Eliminar la Actividad');
    }

    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}

?>