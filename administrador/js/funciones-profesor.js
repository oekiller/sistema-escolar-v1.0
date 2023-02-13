$('#table_profesores').DataTable();
var table_profesores;

document.addEventListener('DOMContentLoaded',function () {
    table_profesores = $('#table_profesores').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": "./models/profesores/tabla_profesores.php",
            "dataSrc":"",
        },
        "columns":[
            {"data":"acciones"},
            {"data":"profesor_id"},
            {"data":"nombre"},
            {"data":"direccion"},
            {"data":"cedula"},
            {"data":"telefono"},
            {"data":"correo"},
            {"data":"nivel_est"},
            {"data":"estado"}
        ],
        "responsive": true,
        "bDestroy":true,
        "iDisplayLength":10,
        "order": [[0,"asc"]]
    });

    var formProfesor = document.querySelector('#formProfesor'); 
    formProfesor.onsubmit = function(e) {
        e.preventDefault();
        var idprofesor = document.querySelector('#idprofesor').value;
        var nombre = document.querySelector('#nombre').value;
        var direccion = document.querySelector('#direccion').value;
        var cedula = document.querySelector('#cedula').value;
        var clave = document.querySelector('#clave').value;
        var telefono = document.querySelector('#telefono').value;
        var correo = document.querySelector('#correo').value;
        var nivel = document.querySelector('#nivel').value;
        var estado = document.querySelector('#listEstado').value;

        if (nombre == "" || direccion == "" || cedula == "" || telefono == "" || correo == "" || nivel == "") {
            swal("Atencion!", "Todos los Campos son Obligatorios", "error");
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/profesores/ajax-profesores.php';
        var form = new FormData(formProfesor);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {
                    $('#modal_profesores').modal('hide');
                    formProfesor.reset();
                    swal("Profesor", data.msg, "success");
                    table_profesores.ajax.reload();
                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }
        
    }
});

function openModalP() {
    document.querySelector('#idprofesor').value = "";
    document.querySelector('#tituloModal').innerHTML = 'Nuevo Profesor';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formProfesor').reset();
    $('#modal_profesores').modal('show');
}

function editar_profesor(id) {
    var idprofesor = id;

    document.querySelector('#tituloModal').innerHTML = 'Actualizar Docente';
    document.querySelector('#action').innerHTML = 'Actualizar';

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/profesores/editar-profesores.php?idprofesor='+idprofesor;
        //var form = new FormData(formUsuario);
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {

                    document.querySelector('#idprofesor').value = data.data.profesor_id;
                    document.querySelector('#nombre').value = data.data.nombre;
                    document.querySelector('#direccion').value = data.data.direccion;
                    document.querySelector('#cedula').value = data.data.cedula;
                    document.querySelector('#telefono').value = data.data.telefono;
                    document.querySelector('#correo').value = data.data.correo;
                    document.querySelector('#nivel').value = data.data.nivel_est;
                    document.querySelector('#listEstado').value = data.data.estado;


                    $('#modal_profesores').modal('show');

                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }

}

function eliminar_profesor(id) {
    var idprofesor = id;

    swal({
        title: "Eliminar?",
      	text: "Desea Eliminar este Profesor!",
      	type: "warning",
      	showCancelButton: true,
      	confirmButtonText: "Si, eliminar!",
      	cancelButtonText: "No, cancelar!",
      	closeOnConfirm: false,
      	closeOnCancel: true
    },function (confirm) {
        if (confirm) {
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/profesores/delete-profesor.php';
        request.open('POST',url,true);
        var strData = "idprofesor="+idprofesor;
        request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        request.send(strData);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {
                    swal("Eliminar", data.msg, "success");
                    table_profesores.ajax.reload();
                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }
        }
    })
}