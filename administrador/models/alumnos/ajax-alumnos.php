<?php 

require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['nombre']) || empty($_POST['edad']) || empty($_POST['direccion']) || empty($_POST['cedula']) || empty($_POST['telefono']) || empty($_POST['correo']) || empty($_POST['fecha_nacimiento']) || empty($_POST['fecha_registro'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los Campos son Obligatorios');
    }else {
        $idalumno = $_POST['idalumno'];
        $nombre = $_POST['nombre'];
        $edad = $_POST['edad'];
        $direccion = $_POST['direccion'];
        $cedula = $_POST['cedula'];
        //$clave = $_POST['clave'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $fecha_registro = $_POST['fecha_registro'];
        $estado = $_POST['listEstado'];

        //$clave = password_hash($clave, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM alumnos WHERE cedula = ? AND alumno_id != ? AND estado != 0";
        $query = $pdo->prepare($sql);
        $query->execute(array($cedula,$idalumno));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result > 0) {
            $respuesta = array('status' => false, 'msg' => 'El Alumno ya esta Registrado');
        }else {

            if ($idalumno == 0) {
                $clave = password_hash($_POST['clave'],PASSWORD_DEFAULT);
                $sql_Insert = "INSERT INTO alumnos(nombre_alumno,edad,direccion,cedula,clave,telefono,correo,fecha_nac,fecha_registro,estado) VALUES (?,?,?,?,?,?,?,?,?,?)";
                $query_Insert = $pdo->prepare($sql_Insert);
                $request= $query_Insert->execute(array($nombre,$edad,$direccion,$cedula,$clave,$telefono,$correo,$fecha_nacimiento,$fecha_registro,$estado));
                $accion = 1;
            }else {
                if (empty($_POST['clave'])) {
                    $sql_Update = "UPDATE alumnos SET nombre_alumno = ?,edad = ?,direccion = ?,cedula = ?,telefono = ?,correo = ?,fecha_nac = ?,fecha_registro = ?,estado = ? WHERE alumno_id = ?";
                    $query_Update = $pdo->prepare($sql_Update);
                    $request= $query_Update->execute(array($nombre,$edad,$direccion,$cedula,$telefono,$correo,$fecha_nacimiento,$fecha_registro,$estado,$idalumno));
                    $accion = 2;
                }else {
                    $claveUpdate = password_hash($_POST['clave'],PASSWORD_DEFAULT);
                    $sql_Update = "UPDATE alumnos SET nombre_alumno = ?,edad = ?,direccion = ?,cedula = ?,clave = ?,telefono = ?,correo = ?,fecha_nac = ?,fecha_registro = ?,estado = ? WHERE alumno_id = ?";
                    $query_Update = $pdo->prepare($sql_Update);
                    $request= $query_Update->execute(array($nombre,$edad,$direccion,$cedula,$claveUpdate,$telefono,$correo,$fecha_nacimiento,$fecha_registro,$estado,$idalumno));
                    $accion = 3;
                }
            }

            if ($request > 0) {
                if ($accion == 1) {
                    $respuesta = array('status' => true, 'msg' => 'El Alumno se creo Correctamente');
                }else {
                    $respuesta = array('status' => true, 'msg' => 'El Alumno se Actualizo Correctamente');
                }
            }
        }
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
