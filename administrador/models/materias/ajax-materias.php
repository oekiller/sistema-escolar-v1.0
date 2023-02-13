<?php 

require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['nombre'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los Campos son Obligatorios');
    }else {
        $idmateria = $_POST['idmateria'];
        $nombre = $_POST['nombre'];
        $estado = $_POST['listEstado'];

        //$clave = password_hash($clave, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM materias WHERE nombre_materia = ? AND materia_id != ? AND estado != 0";
        $query = $pdo->prepare($sql);
        $query->execute(array($nombre,$idmateria));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result > 0) {
            $respuesta = array('status' => false, 'msg' => 'La Materia ya esta Registrada');
        }else {

            if ($idmateria == 0) {
                $sql_Insert = "INSERT INTO materias(nombre_materia,estado) VALUES (?,?)";
                $query_Insert = $pdo->prepare($sql_Insert);
                $request= $query_Insert->execute(array($nombre,$estado));
                $accion = 1;
            }else {
                    $sql_Update = "UPDATE materias SET nombre_materia = ?,estado = ? WHERE materia_id  = ?";
                    $query_Update = $pdo->prepare($sql_Update);
                    $request= $query_Update->execute(array($nombre,$estado,$idmateria));
                    $accion = 2;
            }

            if ($request > 0) {
                if ($accion == 1) {
                    $respuesta = array('status' => true, 'msg' => 'La Materia se creo Correctamente');
                }else {
                    $respuesta = array('status' => true, 'msg' => 'La Materia se Actualizo Correctamente');
                }
            }
        }
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}


?>