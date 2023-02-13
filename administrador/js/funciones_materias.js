$('#table_materias').DataTable();
var table_materias;

document.addEventListener('DOMContentLoaded',function () {
    table_materias = $('#table_materias').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": "./models/materias/tabla_materias.php",
            "dataSrc":"",
        },
        "columns":[
            {"data":"acciones"},
            {"data":"materia_id"},
            {"data":"nombre_materia"},
            {"data":"estado"}
        ],
        "responsive": true,
        "bDestroy":true,
        "iDisplayLength":10,
        "order": [[0,"asc"]]
    });

    var formMateria = document.querySelector('#formMateria'); 
    formMateria.onsubmit = function(e) {
        e.preventDefault();
        var idmateria = document.querySelector('#idmateria').value;
        var nombre = document.querySelector('#nombre').value;
        var estado = document.querySelector('#listEstado').value;

        if (nombre == "") {
            swal("Atencion!", "Todos los Campos son Obligatorios", "error");
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/materias/ajax-materias.php';
        var form = new FormData(formMateria);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {
                    $('#modal_materias').modal('hide');
                    formMateria.reset();
                    swal("Materia", data.msg, "success");
                    table_materias.ajax.reload();
                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }
        
    }
});

function openModalM() {
    document.querySelector('#idmateria').value = "";
    document.querySelector('#tituloModal').innerHTML = 'Nueva Materia';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formMateria').reset();
    $('#modal_materias').modal('show');
}

function editar_materia(id) {
    var idmateria = id;

    document.querySelector('#tituloModal').innerHTML = 'Actualizar Materia';
    document.querySelector('#action').innerHTML = 'Actualizar';

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/materias/editar-materias.php?idmateria='+idmateria;
        //var form = new FormData(formUsuario);
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {

                    document.querySelector('#idmateria').value = data.data.materia_id;
                    document.querySelector('#nombre').value = data.data.nombre_materia;
                    document.querySelector('#listEstado').value = data.data.estado;


                    $('#modal_materias').modal('show');

                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }

}

function eliminar_materia(id) {
    var idmateria = id;

    swal({
        title: "Eliminar?",
      	text: "Desea Eliminar esta Materia!",
      	type: "warning",
      	showCancelButton: true,
      	confirmButtonText: "Si, eliminar!",
      	cancelButtonText: "No, cancelar!",
      	closeOnConfirm: false,
      	closeOnCancel: true
    },function (confirm) {
        if (confirm) {
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/materias/delete-materias.php';
        request.open('POST',url,true);
        var strData = "idmateria="+idmateria;
        request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        request.send(strData);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {
                    swal("Eliminar", data.msg, "success");
                    table_materias.ajax.reload();
                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }
        }
    })
}