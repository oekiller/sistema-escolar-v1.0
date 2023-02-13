$('#table_actividades').DataTable();
var table_actividades;

document.addEventListener('DOMContentLoaded',function () {
    table_actividades = $('#table_actividades').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": "./models/actividades/tabla_actividades.php",
            "dataSrc":"",
        },
        "columns":[
            {"data":"acciones"},
            {"data":"actividad_id"},
            {"data":"nombre_actividad"},
            {"data":"estado"}
        ],
        "responsive": true,
        "bDestroy":true,
        "iDisplayLength":10,
        "order": [[0,"asc"]]
    });

    var formActividad = document.querySelector('#formActividad'); 
    formActividad.onsubmit = function(e) {
        e.preventDefault();
        var idactividad = document.querySelector('#idactividad').value;
        var nombre = document.querySelector('#nombre').value;
        var estado = document.querySelector('#listEstado').value;

        if (nombre == "") {
            swal("Atencion!", "Todos los Campos son Obligatorios", "error");
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/actividades/ajax-actividad.php';
        var form = new FormData(formActividad);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {
                    $('#modal_actividades').modal('hide');
                    formActividad.reset();
                    swal("Actividad", data.msg, "success");
                    table_actividades.ajax.reload();
                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }
        
    }
});

function openModalAC() {
    document.querySelector('#idactividad').value = "";
    document.querySelector('#tituloModal').innerHTML = 'Nueva Actividad';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formActividad').reset();
    $('#modal_actividades').modal('show');
}

function editar_actividad(id) {
    var idactividad = id;

    document.querySelector('#tituloModal').innerHTML = 'Actualizar Actividad';
    document.querySelector('#action').innerHTML = 'Actualizar';

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/actividades/editar-actividad.php?idactividad='+idactividad;
        //var form = new FormData(formUsuario);
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {

                    document.querySelector('#idactividad').value = data.data.actividad_id;
                    document.querySelector('#nombre').value = data.data.nombre_actividad;
                    document.querySelector('#listEstado').value = data.data.estado;


                    $('#modal_actividades').modal('show');

                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }

}

function eliminar_actividad(id) {
    var idactividad = id;

    swal({
        title: "Eliminar?",
      	text: "Desea Eliminar esta Actividad!",
      	type: "warning",
      	showCancelButton: true,
      	confirmButtonText: "Si, eliminar!",
      	cancelButtonText: "No, cancelar!",
      	closeOnConfirm: false,
      	closeOnCancel: true
    },function (confirm) {
        if (confirm) {
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/actividades/delete-actividad.php';
        request.open('POST',url,true);
        var strData = "idactividad="+idactividad;
        request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        request.send(strData);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {
                    swal("Eliminar", data.msg, "success");
                    table_actividades.ajax.reload();
                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }
        }
    })
}