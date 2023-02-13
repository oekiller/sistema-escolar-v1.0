$(document).ready(function() {
    $('#login_admin').on('click',function () {
        loginAdmin(); 
    });

    $('#login_docen').on('click',function () {
        loginDocen(); 
    });

    $('#login_alumno').on('click',function () {
        loginAlumno(); 
    });
});

function loginAdmin() {
    var login = $('#usuario_admin').val();
    var pass = $('#pass_admin').val();

    $.ajax({
        url: './includes/loginAdmin.php',
        method: 'POST',
        data: {
            login:login,
            pass:pass
        },
        success: function (data) {
            $('#mensaje_admin').html(data);

            if(data.indexOf('Redirecting') >= 0){
                setTimeout( function() { window.location.href = "administrador/"; }, 3000 );

            }
        }
    });
};

function loginDocen() {
    var login = $('#usuario_docen').val();
    var pass = $('#pass_docen').val();

    $.ajax({
        url: './includes/loginDocen.php',
        method: 'POST',
        data: {
            login:login,
            pass:pass
        },
        success: function (data) {
            $('#mensaje_docen').html(data);

            if(data.indexOf('Redirecting') >= 0){
                setTimeout( function() { window.location.href = "profesor/"; }, 3000 );

            }
        }
    });
};

function loginAlumno() {
    var login = $('#usuario_alumno').val();
    var pass = $('#pass_alumno').val();

    $.ajax({
        url: './includes/loginAlumno.php',
        method: 'POST',
        data: {
            login:login,
            pass:pass
        },
        success: function (data) {
            $('#mensaje_alumno').html(data);

            if(data.indexOf('Redirecting') >= 0){
                setTimeout( function() { window.location.href = "alumno/"; }, 3000 );

            }
        }
    });
};

