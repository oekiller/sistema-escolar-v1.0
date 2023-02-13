$('#table_alumno_profesor').DataTable();
var table_alumno_profesor;

document.addEventListener('DOMContentLoaded',function () {
    table_alumno_profesor = $('#table_alumno_profesor').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": "./models/alumno_profesor/tabla_alumno_profesor.php",
            "dataSrc":"",
        },
        "columns":[
            {"data":"acciones"},
            {"data":"pm_id"},
            {"data":"nombre_alumno"},
            {"data":"nombre"},
            {"data":"nombre_grado"},
            {"data":"nombre_materia"},
            {"data":"nombre_periodo"},
            {"data":"estadop"}
        ],
        "responsive": true,
        "bDestroy":true,
        "iDisplayLength":10,
        "order": [[0,"asc"]]
    });

    var formAlumnoProfesor = document.querySelector('#formAlumnoProfesor'); 
    formAlumnoProfesor.onsubmit = function(e) {
        e.preventDefault();
        var id_alumno_profesor = document.querySelector('#id_alumno_profesor').value;
        var alumno = document.querySelector('#listAlumno').value;
        var profesor = document.querySelector('#listProfesorA').value;
        var periodo = document.querySelector('#listPeriodo').value;
        var estado = document.querySelector('#listEstado').value;

        if (alumno == "" || profesor == "" || periodo == "" || estado == "") {
            swal("Atencion!", "Todos los Campos son Obligatorios", "error");
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/alumno_profesor/ajax-alumno_profesor.php';
        var form = new FormData(formAlumnoProfesor);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {
                    $('#modal_alumno_profesor').modal('hide');
                    formAlumnoProfesor.reset();
                    swal("Crear Proceso Alumno", data.msg, "success");
                    table_alumno_profesor.ajax.reload();
                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }
        
    }
});

function openModalAlumnoProfesor() {
    document.querySelector('#id_alumno_profesor').value = "";
    document.querySelector('#tituloModal').innerHTML = 'Nuevo Proceso Alumno';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formAlumnoProfesor').reset();
    $('#modal_alumno_profesor').modal('show');
}

window.addEventListener('load',function(){
    showProfesorA();
    showAlumno();
    showPeriodo();
},false);

function showProfesorA() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/optiones/optiones_aprofesores.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor) {
                data += '<option value="'+valor.pm_id+'">Profesor: '+valor.nombre+', Grado:  '+valor.nombre_grado+', Aula: '+valor.nombre_aula+', Materia: '+valor.nombre_materia+'</option>';
            });
            document.querySelector('#listProfesorA').innerHTML = data;
        }
    }
}

function showAlumno() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/optiones/optiones_alumno.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor) {
                data += '<option value="'+valor.alumno_id+'">'+valor.nombre_alumno+'</option>';
            });
            document.querySelector('#listAlumno').innerHTML = data;
        }
    }
}

function showPeriodo() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/optiones/optiones_periodo.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor) {
                data += '<option value="'+valor.periodo_id+'">'+valor.nombre_periodo+'</option>';
            });
            document.querySelector('#listPeriodo').innerHTML = data;
        }
    }
}

function editar_alumno_profesor(id) {
    var id_alumno_profesor = id;

    document.querySelector('#tituloModal').innerHTML = 'Actualizar Proceso Alumno';
    document.querySelector('#action').innerHTML = 'Actualizar';

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/alumno_profesor/editar-alumno-profesor.php?id='+id_alumno_profesor;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {

                    document.querySelector('#id_alumno_profesor').value = data.data.ap_id;
                    document.querySelector('#listAlumno').value = data.data.alumno_id;
                    document.querySelector('#listProfesorA').value = data.data.pm_id;
                    document.querySelector('#listPeriodo').value = data.data.periodo_id;
                    document.querySelector('#listEstado').value = data.data.estadop;


                    $('#modal_alumno_profesor').modal('show');

                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }

}

function eliminar_alumno_profesor(id) {
    var id_alumno_profesor = id;

    swal({
        title: "Eliminar Proceso?",
      	text: "Desea Eliminar este Proceso!",
      	type: "warning",
      	showCancelButton: true,
      	confirmButtonText: "Si, eliminar!",
      	cancelButtonText: "No, cancelar!",
      	closeOnConfirm: false,
      	closeOnCancel: true
    },function (confirm) {
        if (confirm) {
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/alumno_profesor/delete-alumno-profesor.php';
        request.open('POST',url,true);
        var strData = "id="+id_alumno_profesor;
        request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        request.send(strData);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {
                    swal("Eliminar", data.msg, "success");
                    table_alumno_profesor.ajax.reload();
                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }
        }
    })
}