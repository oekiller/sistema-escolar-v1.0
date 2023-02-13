$('#table_periodos').DataTable();
var table_periodos;

document.addEventListener('DOMContentLoaded',function () {
    table_periodos = $('#table_periodos').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": "./models/periodos/tabla_periodos.php",
            "dataSrc":"",
        },
        "columns":[
            {"data":"acciones"},
            {"data":"periodo_id"},
            {"data":"nombre_periodo"},
            {"data":"estado"}
        ],
        "responsive": true,
        "bDestroy":true,
        "iDisplayLength":10,
        "order": [[0,"asc"]]
    });

    var formPeriodo = document.querySelector('#formPeriodo'); 
    formPeriodo.onsubmit = function(e) {
        e.preventDefault();
        var idperiodo = document.querySelector('#idperiodo').value;
        var nombre = document.querySelector('#nombre').value;
        var estado = document.querySelector('#listEstado').value;

        if (nombre == "") {
            swal("Atencion!", "Todos los Campos son Obligatorios", "error");
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/periodos/ajax-periodo.php';
        var form = new FormData(formPeriodo);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {
                    $('#modal_periodos').modal('hide');
                    formPeriodo.reset();
                    swal("Periodo", data.msg, "success");
                    table_periodos.ajax.reload();
                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }
        
    }
});

function openModalPE() {
    document.querySelector('#idperiodo').value = "";
    document.querySelector('#tituloModal').innerHTML = 'Nuevo Periodo';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formPeriodo').reset();
    $('#modal_periodos').modal('show');
}

function editar_periodo(id) {
    var idperiodo = id;

    document.querySelector('#tituloModal').innerHTML = 'Actualizar Periodo';
    document.querySelector('#action').innerHTML = 'Actualizar';

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/periodos/editar_periodo.php?idperiodo='+idperiodo;
        //var form = new FormData(formUsuario);
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {

                    document.querySelector('#idperiodo').value = data.data.periodo_id;
                    document.querySelector('#nombre').value = data.data.nombre_periodo;
                    document.querySelector('#listEstado').value = data.data.estado;


                    $('#modal_periodos').modal('show');

                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }

}

function eliminar_perido(id) {
    var idperiodo = id;

    swal({
        title: "Eliminar?",
      	text: "Desea Eliminar este Periodo!",
      	type: "warning",
      	showCancelButton: true,
      	confirmButtonText: "Si, eliminar!",
      	cancelButtonText: "No, cancelar!",
      	closeOnConfirm: false,
      	closeOnCancel: true
    },function (confirm) {
        if (confirm) {
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/periodos/delete-periodo.php';
        request.open('POST',url,true);
        var strData = "idperiodo="+idperiodo;
        request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        request.send(strData);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {
                    swal("Eliminar", data.msg, "success");
                    table_periodos.ajax.reload();
                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }
        }
    })
}