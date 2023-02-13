<?php

require_once '../../../includes/conexion.php';

if($_POST) {
    $id_profesor_materia = $_POST['id'];

    $sql = "UPDATE profesor_materia SET estadopm = 0 WHERE pm_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute(array($id_profesor_materia));

    if ($result) {
        $respuesta = array('status'=> true, 'msg'=> 'Proceso Eliminado Correctamente');
    }else {
        $respuesta = array('status'=> false, 'msg'=> 'Error al Eliminar este Proceso');
    }

    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}

?>