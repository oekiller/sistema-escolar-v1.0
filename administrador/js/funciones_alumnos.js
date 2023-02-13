$('#table_alumnos').DataTable();
var table_alumnos;

document.addEventListener('DOMContentLoaded',function () {
    table_alumnos = $('#table_alumnos').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": "./models/alumnos/tabla_alumnos.php",
            "dataSrc":"",
        },
        "columns":[
            {"data":"acciones"},
            {"data":"alumno_id"},
            {"data":"nombre_alumno"},
            {"data":"edad"},
            {"data":"direccion"},
            {"data":"cedula"},
            {"data":"telefono"},
            {"data":"correo"},
            {"data":"fecha_nac"},
            {"data":"fecha_registro"},
            {"data":"estado"}
        ],
        "responsive": true,
        "bDestroy":true,
        "iDisplayLength":10,
        "order": [[0,"asc"]]
    });

    var formAlumno = document.querySelector('#formAlumno'); 
    formAlumno.onsubmit = function(e) {
        e.preventDefault();
        var idalumno = document.querySelector('#idalumno').value;
        var nombre = document.querySelector('#nombre').value;
        var edad = document.querySelector('#edad').value;
        var direccion = document.querySelector('#direccion').value;
        var cedula = document.querySelector('#cedula').value;
        var clave = document.querySelector('#clave').value;
        var telefono = document.querySelector('#telefono').value;
        var correo = document.querySelector('#correo').value;
        var fecha_nacimiento = document.querySelector('#fecha_nacimiento').value;
        var fecha_registro = document.querySelector('#fecha_registro').value;
        var estado = document.querySelector('#listEstado').value;

        if (nombre == "" || edad == "" || direccion == "" || cedula == "" || telefono == "" || correo == "" || fecha_nacimiento == "" || fecha_registro == "") {
            swal("Atencion!", "Todos los Campos son Obligatorios", "error");
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/alumnos/ajax-alumnos.php';
        var form = new FormData(formAlumno);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {
                    $('#modal_alumnos').modal('hide');
                    formAlumno.reset();
                    swal("Alumno", data.msg, "success");
                    table_alumnos.ajax.reload();
                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }
        
    }
});

function openModalA() {
    document.querySelector('#idalumno').value = '';
    document.querySelector('#tituloModal').innerHTML = 'Nuevo Alumno';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formAlumno').reset();
    $('#modal_alumnos').modal('show');
};

function editar_alumno(id) {
    var idalumno = id;

    document.querySelector('#tituloModal').innerHTML = 'Actualizar Alumno';
    document.querySelector('#action').innerHTML = 'Actualizar';

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/alumnos/editar-alumnos.php?idalumno='+idalumno;
        //var form = new FormData(formUsuario);
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {

                    document.querySelector('#idalumno').value = data.data.alumno_id;
                    document.querySelector('#nombre').value = data.data.nombre_alumno;
                    document.querySelector('#edad').value = data.data.edad;
                    document.querySelector('#direccion').value = data.data.direccion;
                    document.querySelector('#cedula').value = data.data.cedula;
                    document.querySelector('#telefono').value = data.data.telefono;
                    document.querySelector('#correo').value = data.data.correo;
                    document.querySelector('#fecha_nacimiento').value = data.data.fecha_nac;
                    document.querySelector('#fecha_registro').value = data.data.fecha_registro;
                    document.querySelector('#listEstado').value = data.data.estado;


                    $('#modal_alumnos').modal('show');

                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }

};

function eliminar_alumno(id) {
    var idalumno = id;

    swal({
        title: "Eliminar?",
      	text: "Desea Eliminar este Alumno!",
      	type: "warning",
      	showCancelButton: true,
      	confirmButtonText: "Si, eliminar!",
      	cancelButtonText: "No, cancelar!",
      	closeOnConfirm: false,
      	closeOnCancel: true
    },function (confirm) {
        if (confirm) {
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/alumnos/delete-alumnos.php';
        request.open('POST',url,true);
        var strData = "idalumno="+idalumno;
        request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        request.send(strData);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {
                    swal("Eliminar", data.msg, "success");
                    table_alumnos.ajax.reload();
                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }
        }
    })
};