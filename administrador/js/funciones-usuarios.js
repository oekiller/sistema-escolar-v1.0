$('#table_usuarios').DataTable();
var table_usuarios;

document.addEventListener('DOMContentLoaded',function () {
    table_usuarios = $('#table_usuarios').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": "./models/usuarios/tabla_usuarios.php",
            "dataSrc":"",
        },
        "columns":[
            {"data":"acciones"},
            {"data":"usuario_id"},
            {"data":"nombre"},
            {"data":"usuario"},
            {"data":"nombre_rol"},
            {"data":"estado"}
        ],
        "responsive": true,
        "bDestroy":true,
        "iDisplayLength":10,
        "order": [[0,"asc"]]
    });

    var formUsuario = document.querySelector('#formUsuario'); 
    formUsuario.onsubmit= function(e){
        e.preventDefault();
        var idusuario = document.querySelector('#idusuario').value;
        var nombre = document.querySelector('#nombre').value;
        var usuario = document.querySelector('#usuario').value;
        var clave = document.querySelector('#clave').value;
        var rol = document.querySelector('#listRol').value;
        var estado = document.querySelector('#listEstado').value;

        if (nombre == "" || usuario == "") {
            swal("Atencion!", "Todos los Campos son Obligatorios", "error");
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/usuarios/ajax-usuario.php';
        var form = new FormData(formUsuario);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {
                    $('#modal_usuarios').modal('hide');
                    formUsuario.reset();
                    swal("Usuario", data.msg, "success");
                    table_usuarios.ajax.reload();
                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }
        
    }
});

function openModalU() {
    document.querySelector('#idusuario').value = "";
    document.querySelector('#tituloModal').innerHTML = 'Nuevo Usuario';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formUsuario').reset();
    $('#modal_usuarios').modal('show');
}

function editar_usuario(id) {
    var idusuario = id;

    document.querySelector('#tituloModal').innerHTML = 'Actualizar Usuario';
    document.querySelector('#action').innerHTML = 'Actualizar';

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/usuarios/editar-usuario.php?idusuario='+idusuario;
        //var form = new FormData(formUsuario);
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {
                    document.querySelector('#idusuario').value = data.data.usuario_id;  
                    document.querySelector('#nombre').value = data.data.nombre; 
                    document.querySelector('#usuario').value = data.data.usuario;
                    document.querySelector('#listRol').value = data.data.rol;
                    document.querySelector('#listEstado').value = data.data.estado;

                    $('#modal_usuarios').modal('show');

                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }

}

function eliminar_usuario(id) {
    var idusuario = id;

    swal({
        title: "Eliminar?",
      	text: "Desea Eliminar este Usuario!",
      	type: "warning",
      	showCancelButton: true,
      	confirmButtonText: "Si, eliminar!",
      	cancelButtonText: "No, cancelar!",
      	closeOnConfirm: false,
      	closeOnCancel: true
    },function (confirm) {
        if (confirm) {
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/usuarios/delete-usuario.php';
        request.open('POST',url,true);
        var strData = "idusuario="+idusuario;
        request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        request.send(strData);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {
                    swal("Eliminar", data.msg, "success");
                    table_usuarios.ajax.reload();
                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }
        }
    })
}