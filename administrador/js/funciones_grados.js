$('#table_grados').DataTable();
var table_grados;

document.addEventListener('DOMContentLoaded',function () {
    table_grados = $('#table_grados').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": "./models/grados/tabla_grados.php",
            "dataSrc":"",
        },
        "columns":[
            {"data":"acciones"},
            {"data":"grado_id"},
            {"data":"nombre_grado"},
            {"data":"estado"}
        ],
        "responsive": true,
        "bDestroy":true,
        "iDisplayLength":10,
        "order": [[0,"asc"]]
    });

    var formGrado = document.querySelector('#formGrado'); 
    formGrado.onsubmit = function(e) {
        e.preventDefault();
        var idgrado = document.querySelector('#idgrado').value;
        var nombre = document.querySelector('#nombre').value;
        var estado = document.querySelector('#listEstado').value;

        if (nombre == "") {
            swal("Atencion!", "Todos los Campos son Obligatorios", "error");
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/grados/ajax-grados.php';
        var form = new FormData(formGrado);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {
                    $('#modal_grados').modal('hide');
                    formGrado.reset();
                    swal("Grado", data.msg, "success");
                    table_grados.ajax.reload();
                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }
        
    }
});

function openModalG() {
    document.querySelector('#idgrado').value = "";
    document.querySelector('#tituloModal').innerHTML = 'Nuevo Grado';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formGrado').reset();
    $('#modal_grados').modal('show');
}

function editar_grado(id) {
    var idgrado = id;

    document.querySelector('#tituloModal').innerHTML = 'Actualizar Grado';
    document.querySelector('#action').innerHTML = 'Actualizar';

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/grados/editar-grados.php?idgrado='+idgrado;
        //var form = new FormData(formUsuario);
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {

                    document.querySelector('#idgrado').value = data.data.grado_id;
                    document.querySelector('#nombre').value = data.data.nombre_grado;
                    document.querySelector('#listEstado').value = data.data.estado;


                    $('#modal_grados').modal('show');

                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }

}

function eliminar_grado(id) {
    var idgrado = id;

    swal({
        title: "Eliminar?",
      	text: "Desea Eliminar este Grado!",
      	type: "warning",
      	showCancelButton: true,
      	confirmButtonText: "Si, eliminar!",
      	cancelButtonText: "No, cancelar!",
      	closeOnConfirm: false,
      	closeOnCancel: true
    },function (confirm) {
        if (confirm) {
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/grados/delete-grados.php';
        request.open('POST',url,true);
        var strData = "idgrado="+idgrado;
        request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        request.send(strData);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {
                    swal("Eliminar", data.msg, "success");
                    table_grados.ajax.reload();
                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }
        }
    })
}