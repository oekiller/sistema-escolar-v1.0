<?php 

require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['nombre'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los Campos son Obligatorios');
    }else {
        $idperiodo = $_POST['idperiodo'];
        $nombre = $_POST['nombre'];
        $estado = $_POST['listEstado'];

        //$clave = password_hash($clave, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM periodos WHERE nombre_periodo = ? AND periodo_id != ? AND estado != 0";
        $query = $pdo->prepare($sql);
        $query->execute(array($nombre,$idperiodo));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result > 0) {
            $respuesta = array('status' => false, 'msg' => 'El Periodo ya esta Registrado');
        }else {

            if ($idperiodo == 0) {
                $sql_Insert = "INSERT INTO periodos(nombre_periodo,estado) VALUES (?,?)";
                $query_Insert = $pdo->prepare($sql_Insert);
                $request= $query_Insert->execute(array($nombre,$estado));
                $accion = 1;
            }else {
                    $sql_Update = "UPDATE periodos SET nombre_periodo = ?,estado = ? WHERE periodo_id  = ?";
                    $query_Update = $pdo->prepare($sql_Update);
                    $request= $query_Update->execute(array($nombre,$estado,$idperiodo));
                    $accion = 2;
            }

            if ($request > 0) {
                if ($accion == 1) {
                    $respuesta = array('status' => true, 'msg' => 'El Periodo se creo Correctamente');
                }else {
                    $respuesta = array('status' => true, 'msg' => 'El Periodo se Actualizo Correctamente');
                }
            }
        }
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}


?>