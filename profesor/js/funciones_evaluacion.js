document.addEventListener('DOMContentLoaded', function () {
    var formEvaluacion = document.querySelector('#formEvaluacion');
    formEvaluacion.onsubmit = function (e) {
        e.preventDefault();

        var idevaluacion = document.querySelector('#idevaluacion').value;
        var idcontenido = document.querySelector('#idcontenido').value;
        var titulo = document.querySelector('#titulo').value;
        var descripcion = document.querySelector('#descripcion').value;
        var fecha = document.querySelector('#fecha').value;
        var valor = document.querySelector('#valor').value;

        if (titulo == '' || descripcion == '' || fecha == '' || valor == '') {
            swal("Atencion!", "Todos los Campos son Obligatorios", "error");
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/evaluacion/ajax-evaluacion.php';
        var form = new FormData(formEvaluacion);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                swal({
                    title: "Crear o Actualizar Evaluacion",
                      type: "success",
                      confirmButtonText: "Aceptar",
                      closeOnConfirm: true
                }, function (confirm) {
                    if (confirm) {
                        if (data.status) {
                            $('#modal_evaluacion').modal('hide');
                            location.reload();
                            formEvaluacion.reset();
                        }else{
                            swal('Atencion', data.msg, 'error');
                        }
                    }
                })
                
            }
        }
    }
});

function openModalEvaluacion() {
    document.querySelector('#idevaluacion').value = "";
    document.querySelector('#tituloModal').innerHTML = 'Nueva Evaluacion';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formEvaluacion').reset();
    $('#modal_evaluacion').modal('show');
}

function editarEvaluacion(id) {
    var idevaluacion = id;

    document.querySelector('#tituloModal').innerHTML = 'Actualizar Evaluacion';
    document.querySelector('#action').innerHTML = 'Actualizar';

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/evaluacion/editar-evaluacion.php?idevaluacion='+idevaluacion;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (request.status) {

                    document.querySelector('#idevaluacion').value = data.data.evaluacion_id;
                    document.querySelector('#titulo').value = data.data.titulo;
                    document.querySelector('#descripcion').value = data.data.descripcion;
                    document.querySelector('#fecha').value = data.data.fecha;
                    document.querySelector('#valor').value = data.data.porcentaje;
                    //document.querySelector('#file').value = data.data.material;


                    $('#modal_evaluacion').modal('show');

                }else{
                    swal("Atencion", data.msg, "error");
                }
                
            }
        }

}

function eliminarEvaluacion(id) {
    var idevaluacion = id;

    swal({
        title: "Eliminar?",
      	text: "Desea Eliminar esta Evaluacion!",
      	type: "warning",
      	showCancelButton: true,
      	confirmButtonText: "Si, eliminar!",
      	cancelButtonText: "No, cancelar!",
      	closeOnConfirm: false,
      	closeOnCancel: true
    },function (confirm) {
        if (confirm) {
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/evaluacion/delete-evaluacion.php';
        request.open('POST',url,true);
        var strData = "idevaluacion="+idevaluacion;
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