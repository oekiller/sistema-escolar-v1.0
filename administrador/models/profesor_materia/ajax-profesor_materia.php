<?php 

require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['listProfesorM']) || empty($_POST['listGrado']) || empty($_POST['listAula']) || empty($_POST['listMateria']) || empty($_POST['listPeriodo'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los Campos son Obligatorios');
    }else {
        $id_profesor_materia = $_POST['id_profesor_materia'];
        $profesor = $_POST['listProfesorM'];
        $grado = $_POST['listGrado'];
        $aula = $_POST['listAula'];
        $materia = $_POST['listMateria'];
        $periodo = $_POST['listPeriodo'];
        $estado = $_POST['listEstado'];

        //CONSULTA PARA INSERTAR
        $sql = 'SELECT * FROM profesor_materia WHERE profesor_id = ? AND grado_id = ? AND aula_id = ? AND materia_id = ? AND periodo_id = ? 
        AND estadopm != 0';
        $query = $pdo->prepare($sql);
        $query->execute(array($profesor,$grado,$aula,$materia,$periodo));
        $result_Insert = $query->fetch(PDO::FETCH_ASSOC);

        //CONSULTA PARA ACTUALZIAR
        $sql2 = 'SELECT * FROM profesor_materia WHERE profesor_id = ? AND grado_id = ? AND aula_id = ? AND materia_id = ? AND periodo_id = ? 
        AND estadopm != 0 AND pm_id != ?';
        $query2 = $pdo->prepare($sql2);
        $query2->execute(array($profesor,$grado,$aula,$materia,$periodo,$id_profesor_materia));
        $result_Update = $query2->fetch(PDO::FETCH_ASSOC);

        if ($result_Insert > 0) {
            $arrResponse = array('status' => false, 'msg' => 'El grado, aula, materia y el profesor ya Existen, Selecciona otro');
        }else {
            if ($id_profesor_materia == 0) {
                $sql_Insert = 'INSERT INTO profesor_materia (profesor_id,grado_id,aula_id,materia_id,periodo_id,estadopm) VALUES (?,?,?,?,?,?)';
                $query_Insert = $pdo->prepare($sql_Insert);
                $request = $query_Insert->execute(array($profesor,$grado,$aula,$materia,$periodo,$estado));
                
                if ($request) {
                $arrResponse = array('status' => true, 'msg' => 'Proceso Creado Correctamente');
            }
        }
    }

    if ($result_Update > 0) {
        $arrResponse = array('status' => false, 'msg' => 'El grado, aula, materia y el profesor ya Existen, Selecciona otro');
    }else {
        if ($id_profesor_materia > 0) {
            $sql_Update = 'UPDATE profesor_materia SET profesor_id = ?,grado_id = ?,aula_id = ?,materia_id = ?,periodo_id = ?,estadopm = ?
            WHERE pm_id = ?';
            $query_Update = $pdo->prepare($sql_Update);
            $request2 = $query_Update->execute(array($profesor,$grado,$aula,$materia,$periodo,$estado,$id_profesor_materia));

            if ($request2) {
                $arrResponse = array('status' => true, 'msg' => 'Proceso Actualizado Correctamente');
            }
        }
    }
}
echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
}

