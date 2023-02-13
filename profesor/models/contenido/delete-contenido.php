<?php

require_once '../../../includes/conexion.php';

if($_POST) {
    $idcontenido = $_POST['idcontenido'];

    $sql = "SELECT * FROM contenidos  WHERE contenido_id = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($idcontenido));
    $data = $query->fetch(PDO::FETCH_ASSOC);

    $sqle = "SELECT * FROM evaluaciones  WHERE contenido_id = ?";
    $querye = $pdo->prepare($sqle);
    $querye->execute(array($idcontenido));
    $data2 = $querye->fetch(PDO::FETCH_ASSOC);

    if (empty($data2)) {
        $sql_Update = "DELETE FROM contenidos WHERE contenido_id = ?";
        $query_Update = $pdo->prepare($sql_Update);
        $result = $query_Update->execute(array($idcontenido));
        if ($result) {
            if ($data['material'] != '') {
                unlink($data['material']);
            }
            $arrResponse = array('status' => true, 'msg' => 'Contenido Eliminado Correctamente');
        }else {
            $arrResponse = array('status' => false, 'msg' => 'Error al Eliminar el Contenido');
        }
    }else {
        $arrResponse = array('status'=> false, 'msg'=> 'No se puede Eliminar el Contenido, Tiene una Evaluacion Asignada');
    }

    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
}

?>