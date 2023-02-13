document.addEventListener('DOMContentLoaded', function () {
    var formContenido = document.querySelector('#formContenido');
    formContenido.onsubmit = function (e) {
        e.preventDefault();

        var idcontenido = document.querySelector('#idcontenido').value;
        var titulo = document.querySelector('#titulo').value;
        var descripcion = document.querySelector('#descripcion').value;
        var material = document.querySelector('#file').value;

        if (titulo == '' || descripcion == '') {
            swal("Atencion!", "Todos los Campos son Obligatorios", "error");
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/contenido/ajax-contenido.php';
        var form = new FormData(formContenido);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                swal({
                    title: "Crear o Actualizar Contenido",
                      type: "success",
                      confirmButtonText: "Aceptar",
                      closeOnConfirm: true
                }, function (confirm) {
                    if (confirm) {
                        if (data.status) {
                            $('#modal_contenido').modal('hide');
                            location.reload();
                            formContenido.reset();
                        }else{
                            swal('Atencion', data.msg, 'error');
                        }
                    }
                })
                
            }
        }
    }
});

function openModalContenido() {
    document.querySelector('#idcontenido').value = "";
    document.querySelector('#tituloModal').innerHTML = 'Nuevo Contenido';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formContenido').reset();
    $('#modal_contenido').modal('show');
}

function editarContenido(id) {
    var idcontenido = id;

    document.querySelector('#tituloModal').innerHTML = 'Actualizar Contenido';
    document.querySelector('#action').innerHTML = 'Actualizar';

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/contenido/editar-contenido.php?idcontenido='+idcontenido;
        //var form = new FormData(formUsuario);
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {

                    document.querySelector('#idcontenido').value = data.data.contenido_id ;
                    document.querySelector('#titulo').value = data.data.titulo;
                    document.querySelector('#descripcion').value = data.data.descripcion;
                    //document.querySelector('#file').value = data.data.material;


                    $('#modal_contenido').modal('show');

                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }

}

function eliminarContenido(id) {
    var idcontenido = id;

    swal({
        title: "Eliminar?",
      	text: "Desea Eliminar este Contenido!",
      	type: "warning",
      	showCancelButton: true,
      	confirmButtonText: "Si, eliminar!",
      	cancelButtonText: "No, cancelar!",
      	closeOnConfirm: false,
      	closeOnCancel: true
    },function (confirm) {
        if (confirm) {
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/contenido/delete-contenido.php';
        request.open('POST',url,true);
        var strData = "idcontenido="+idcontenido;
        request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        request.send(strData);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (data.status) {
                    //swal("Eliminar", data.msg, "success");
                    location.reload();
                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }
        }
    })
}