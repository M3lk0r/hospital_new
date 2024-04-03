<?php
session_start();
try {
    if (isset($_SESSION["Autenticado"]) and $_SESSION["Autenticado"] == true) {
        #header("Location:./public/home_lista_clientes.php");
        #exit();
    } else {
        session_destroy();
    }
} catch (Exception $e) {
    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <link rel="stylesheet" type="text/css" href="./public/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./public/css/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área de acesso</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                <form action="index.php" method="post" id="loginctrl">
                    <h1 class="text-center">Login</h1>
                    <p class="text-center">Bem Vindo a Arda!</P>
                    <div class="form-group mb-2">
                        <input class="form-control" type="email" name="email" id="email" placeholder="Endereço de E-mail" required>
                    </div>
                    <div class="form-group mb-2">
                        <input class="form-control" type="password" name="senha" id="senha" placeholder="Senha" required>
                    </div>
                    <div class="link forget-pass text-left"><a href="./public/recuperar_senha.php">Esqueci minha senha</a></div>
                    <div class="form-group mb-2">
                        <input class="form-control button" type="submit" name="botao" value="Login">
                    </div>
                    <div class="link login-link text-center">Não possui Cadastro? <a href="./public/tela_cadastro.php">Cadastre-se</a></div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="./public/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#loginctrl").on("submit", function(event) {
                event.preventDefault();

                var email = $('#email').val();
                var senha = $('#senha').val();

                $.post("./app/controller/login_controller.php", {
                    email,
                    senha
                }).done(function(retorno) {
                    console.log(retorno);
                    rdata = JSON.parse(retorno);
                    if (rdata.status === 'success') {
                        localStorage.setItem('token', rdata.token);
                        window.location = "./public/home_lista_clientes.php"
                    } else {
                        Swal.fire({
                            title: 'Erro',
                            text: rdata.message,
                            icon: 'error'
                        });
                    }
                }).fail(function(retorno) {
                    console.log(retorno);
                    rdata = JSON.parse(retorno);
                    Swal.fire({
                        title: 'Erro',
                        text: rdata.message,
                        icon: 'error'
                    })

                })
            })
        });
    </script>
</body>

</html>