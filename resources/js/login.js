$(document).ready(function () {


    $('#entrar').click(function() {

        if ($('#email').val() === '' || $('#senha').val() === '') {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'Preencha todos os campos!',
            });
            return;

        }

        var letras = $('#senha').val().length;
        console.log(letras);
        if (letras < 8) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'A senha deve ter pelo menos 8 caracteres!',
            });
            return;
        }

        $.ajax({
            url: '../api/login',
            method: 'POST',
            data: {
                email: $('#email').val(),
                senha: $('#senha').val()
            },
            success: function (response) {
                if (response.erro == 'n') {
                    alert(response.token);
                    $.cookie('token', response.token), { expires: 7 };
                    $.cookie('usuario_id', response.usuario_id, { expires: 7 });
                    setTimeout(function() {
                        window.location.href = '../home';
                    }, 3000);
                    
                }else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: response.message
                    });
                }
            },
            error: function (xhr, status, error) {
                
            }
        });


    });



});