<?php 

require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['nombre']) || empty($_POST['direccion']) || empty($_POST['cedula']) || empty($_POST['telefono']) || empty($_POST['correo']) || empty($_POST['nivel'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los Campos son Obligatorios');
    }else {
        $idprofesor = $_POST['idprofesor'];
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $cedula = $_POST['cedula'];
        //$clave = $_POST['clave'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $nivel = $_POST['nivel'];
        $estado = $_POST['listEstado'];

        $sql = "SELECT * FROM profesor WHERE cedula = ? AND profesor_id != ? AND estado != 0";
        $query = $pdo->prepare($sql);
        $query->execute(array($cedula,$idprofesor));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result > 0) {
            $respuesta = array('status' => false, 'msg' => 'El Docente ya esta Registrado');
        }else {

            if ($idprofesor == 0) {
                $clave = password_hash($_POST['clave'], PASSWORD_DEFAULT);
                $sql_Insert = "INSERT INTO profesor(nombre,direccion,cedula,clave,telefono,correo,nivel_est,estado) VALUES (?,?,?,?,?,?,?,?)";
                $query_Insert = $pdo->prepare($sql_Insert);
                $request= $query_Insert->execute(array($nombre,$direccion,$cedula,$clave,$telefono,$correo,$nivel,$estado));
                $accion = 1;
            }else {
                if (empty($_POST['clave'])) {
                    $sql_Update = "UPDATE profesor SET nombre = ?,direccion = ?,cedula = ?,telefono = ?,correo = ?,nivel_est = ?,estado = ? WHERE profesor_id = ?";
                    $query_Update = $pdo->prepare($sql_Update);
                    $request= $query_Update->execute(array($nombre,$direccion,$cedula,$telefono,$correo,$nivel,$estado,$idprofesor));
                    $accion = 2;
                }else {
                    $claveUpdate = password_hash($_POST['clave'],PASSWORD_DEFAULT);
                    $sql_Update = "UPDATE profesor SET nombre = ?,direccion = ?,cedula = ?,clave = ?,telefono = ?,correo = ?,nivel_est = ?,estado = ? WHERE profesor_id = ?";
                    $query_Update = $pdo->prepare($sql_Update);
                    $request= $query_Update->execute(array($nombre,$direccion,$cedula,$claveUpdate,$telefono,$correo,$nivel,$estado,$idprofesor));
                    $accion = 3;
                }
            }

            if ($request > 0) {
                if ($accion == 1) {
                    $respuesta = array('status' => true, 'msg' => 'El Profesor se creo Correctamente');
                }else {
                    $respuesta = array('status' => true, 'msg' => 'El Profesor se Actualizo Correctamente');
                }
            }
        }
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}


?>