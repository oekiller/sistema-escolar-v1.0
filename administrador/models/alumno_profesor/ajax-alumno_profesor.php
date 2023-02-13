<?php 

require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['listAlumno']) ||empty($_POST['listProfesorA']) || empty($_POST['listPeriodo'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los Campos son Obligatorios');
    }else {
        $id_alumno_profesor = $_POST['id_alumno_profesor'];
        $alumno = $_POST['listAlumno'];
        $profesor = $_POST['listProfesorA'];
        $periodo = $_POST['listPeriodo'];
        $estado = $_POST['listEstado'];

        //CONSULTA PARA INSERTAR
        $sql = 'SELECT * FROM `alumno_profesor` WHERE alumno_id = ? AND pm_id = ? AND periodo_id = ? AND estadop != 0';
        $query = $pdo->prepare($sql);
        $query->execute(array($alumno,$profesor,$periodo));
        $result_Insert = $query->fetch(PDO::FETCH_ASSOC);

        //CONSULTA PARA ACTUALZIAR
        $sql2 = 'SELECT * FROM alumno_profesor WHERE alumno_id = ? AND pm_id = ? AND periodo_id = ? AND estadop != 0 AND ap_id != ?';
        $query2 = $pdo->prepare($sql2);
        $query2->execute(array($alumno,$profesor,$periodo,$id_alumno_profesor));
        $result_Update = $query2->fetch(PDO::FETCH_ASSOC);

        if ($result_Insert > 0) {
            $arrResponse = array('status' => false, 'msg' => 'El Alumno ya tiene el Grado y el Profesor Asignado, Selecciona otro');
        }else {
            if ($id_alumno_profesor == 0) {
                $sql_Insert = 'INSERT INTO alumno_profesor (alumno_id,pm_id,periodo_id,estadop) VALUES (?,?,?,?)';
                $query_Insert = $pdo->prepare($sql_Insert);
                $request = $query_Insert->execute(array($alumno,$profesor,$periodo,$estado));
                
                if ($request) {
                $arrResponse = array('status' => true, 'msg' => 'Proceso Creado Correctamente');
            }
        }
    }

    if ($result_Update > 0) {
        $arrResponse = array('status' => false, 'msg' => 'El Alumno ya tiene el Grado y el Profesor Asignado, Selecciona otro');
    }else {
        if ($id_alumno_profesor > 0) {
            $sql_Update = 'UPDATE alumno_profesor SET alumno_id = ?,pm_id = ?,periodo_id = ?,estadop = ? WHERE ap_id = ?';
            $query_Update = $pdo->prepare($sql_Update);
            $request2 = $query_Update->execute(array($alumno,$profesor,$periodo,$estado,$id_alumno_profesor));

            if ($request2) {
                $arrResponse = array('status' => true, 'msg' => 'Proceso Actualizado Correctamente');
            }
        }
    }
}
echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
}

