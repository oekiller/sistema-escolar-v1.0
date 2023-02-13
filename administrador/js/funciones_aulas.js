$('#table_aulas').DataTable();
var table_aulas;

document.addEventListener('DOMContentLoaded', function () {
    table_aulas = $('#table_aulas').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": "./models/aulas/tabla_aulas.php",
            "dataSrc":"",
        },
        "columns":[
            {"data":"acciones"},
            {"data":"aula_id"},
            {"data":"nombre_aula"},
            {"data":"estado"}
        ],
        "responsive": true,
        "bDestroy":true,
        "iDisplayLength":10,
        "order": [[0,"asc"]]
    });

    var formAula = document.querySelector('#formAula'); 
    formAula.onsubmit= function(e) {
        e.preventDefault();
        var idaula = document.querySelector('#idaula').value;
        var nombre = document.querySelector('#nombre').value;
        var estado = document.querySelector('#listEstado').value;

        if (nombre == "") {
            swal("Atencion!", "Todos los Campos son Obligatorios", "error");
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/aulas/ajax-aulas.php';
        var form = new FormData(formAula);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {
                    $('#modal_aulas').modal('hide');
                    formAula.reset();
                    swal("Aula", data.msg, "success");
                    table_aulas.ajax.reload();
                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }
        
    }
});

function openModalAU() {
    document.querySelector('#idaula').value = "";
    document.querySelector('#tituloModal').innerHTML = 'Nueva Aula';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formAula').reset();
    $('#modal_aulas').modal('show');
}

function editar_aula(id) {
    var idaula = id;

    document.querySelector('#tituloModal').innerHTML = 'Actualizar Aula';
    document.querySelector('#action').innerHTML = 'Actualizar';

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/aulas/editar-aulas.php?idaula='+idaula;
        //var form = new FormData(formUsuario);
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {

                    document.querySelector('#idaula').value = data.data.aula_id;
                    document.querySelector('#nombre').value = data.data.nombre_aula;
                    document.querySelector('#listEstado').value = data.data.estado;


                    $('#modal_aulas').modal('show');

                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }

}

function eliminar_aula(id) {
    var idaula = id;

    swal({
        title: "Eliminar?",
      	text: "Desea Eliminar esta Aula!",
      	type: "warning",
      	showCancelButton: true,
      	confirmButtonText: "Si, eliminar!",
      	cancelButtonText: "No, cancelar!",
      	closeOnConfirm: false,
      	closeOnCancel: true
    },function (confirm) {
        if (confirm) {
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/aulas/delete-aulas.php';
        request.open('POST',url,true);
        var strData = "idaula="+idaula;
        request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        request.send(strData);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {
                    swal("Eliminar", data.msg, "success");
                    table_aulas.ajax.reload();
                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }
        }
    })
}