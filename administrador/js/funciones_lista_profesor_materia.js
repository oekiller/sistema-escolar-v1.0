$('#table_lista_profesor_materia').DataTable();
var table_lista_profesor_materia;

document.addEventListener('DOMContentLoaded',function () {
    table_lista_profesor_materia = $('#table_lista_profesor_materia').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": "./models/profesor_materia/tabla_profesor_materia.php",
            "dataSrc":"",
        },
        "columns":[
            {"data":"acciones"},
            {"data":"pm_id"},
            {"data":"nombre"},
            {"data":"nombre_grado"},
            {"data":"nombre_aula"},
            {"data":"nombre_materia"},
            {"data":"nombre_periodo"},
            {"data":"estadopm"}
        ],
        "responsive": true,
        "bDestroy":true,
        "iDisplayLength":10,
        "order": [[0,"asc"]]
    });

    var formProfesorMateria = document.querySelector('#formProfesorMateria'); 
    formProfesorMateria.onsubmit = function(e) {
        e.preventDefault();
        var id_profesor_materia = document.querySelector('#id_profesor_materia').value;
        var nombre = document.querySelector('#listProfesorM').value;
        var grado = document.querySelector('#listGrado').value;
        var aula = document.querySelector('#listAula').value;
        var materia = document.querySelector('#listMateria').value;
        var periodo = document.querySelector('#listPeriodo').value;
        var estado = document.querySelector('#listEstado').value;

        if (nombre == "" || grado == "" || aula == "" || materia == "" || periodo == "" || estado == "") {
            swal("Atencion!", "Todos los Campos son Obligatorios", "error");
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/profesor_materia/ajax-profesor_materia.php';
        var form = new FormData(formProfesorMateria);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {
                    $('#modal_profesor_materias').modal('hide');
                    formProfesorMateria.reset();
                    swal("Crear Proceso Profesor", data.msg, "success");
                    table_lista_profesor_materia.ajax.reload();
                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }
        
    }
});

function openModalProfesorMateria() {
    document.querySelector('#id_profesor_materia').value = "";
    document.querySelector('#tituloModal').innerHTML = 'Nuevo Proceso Profesor';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formProfesorMateria').reset();
    $('#modal_profesor_materias').modal('show');
}

window.addEventListener('load',function(){
    showProfesorM();
    showGrado();
    showAula();
    showMateria();
    showPeriodo();
},false);

function showProfesorM() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/optiones/optiones_profesores.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor) {
                data += '<option value="'+valor.profesor_id+'">'+valor.nombre+'</option>';
            });
            document.querySelector('#listProfesorM').innerHTML = data;
        }
    }
}

function showGrado() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/optiones/optiones_grados.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor) {
                data += '<option value="'+valor.grado_id+'">'+valor.nombre_grado+'</option>';
            });
            document.querySelector('#listGrado').innerHTML = data;
        }
    }
}

function showAula() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/optiones/optiones_aula.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor) {
                data += '<option value="'+valor.aula_id+'">'+valor.nombre_aula+'</option>';
            });
            document.querySelector('#listAula').innerHTML = data;
        }
    }
}

function showMateria() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './models/optiones/optiones_materia.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            data.forEach(function(valor) {
                data += '<option value="'+valor.materia_id+'">'+valor.nombre_materia+'</option>';
            });
            document.querySelector('#listMateria').innerHTML = data;
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

function editar_profesor_materia(id) {
    var id_profesor_materia = id;

    document.querySelector('#tituloModal').innerHTML = 'Actualizar Proceso Profesor';
    document.querySelector('#action').innerHTML = 'Actualizar';

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/profesor_materia/editar-profesores-materia.php?id='+id_profesor_materia;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {

                    document.querySelector('#id_profesor_materia').value = data.data.pm_id;
                    document.querySelector('#listProfesorM').value = data.data.profesor_id;
                    document.querySelector('#listGrado').value = data.data.grado_id;
                    document.querySelector('#listAula').value = data.data.aula_id;
                    document.querySelector('#listMateria').value = data.data.materia_id;
                    document.querySelector('#listPeriodo').value = data.data.periodo_id;
                    document.querySelector('#listEstado').value = data.data.estadopm;


                    $('#modal_profesor_materias').modal('show');

                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }

}

function eliminar_profesor_materia(id) {
    var id_profesor_materia = id;

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
        var url = './models/profesor_materia/delete-profesor-materia.php';
        request.open('POST',url,true);
        var strData = "id="+id_profesor_materia;
        request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        request.send(strData);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {
                    swal("Eliminar", data.msg, "success");
                    table_lista_profesor_materia.ajax.reload();
                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }
        }
    })
}