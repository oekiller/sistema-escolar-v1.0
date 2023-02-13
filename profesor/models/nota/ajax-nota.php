<?php

require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (trim($_POST['nota']) == '') {
        $respuesta = array('status' => false, 'msg' => 'Todos los campos son obligatorios');
    }else{
        $identregada = $_POST['identregada'];
        $nota = $_POST['nota'];

        $sql_Insert = 'INSERT INTO notas(ev_entregada_id,valor_nota) VALUES (?,?)';
        $query_Insert = $pdo->prepare($sql_Insert);
        $request = $query_Insert->execute(array($identregada,$nota));

        if ($request > 0) {
            $respuesta = array('status' => true, 'msg' => 'Evaluacion Creada Exitosamente');
        }
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}

?>