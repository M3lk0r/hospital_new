<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <link rel="stylesheet" type="text/css" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../public/css/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="tela_cadastro.php" method="post" id="formucaduser">

                    <h1 class="text-center">Cadastro</h1>
                    <p class="text-center">Insira informações válidas</p>

                    <div class="form-group mb-2">
                        <input class="form-control" type="text" id="nome" name="nome" placeholder="Nome Completo" required>
                    </div>

                    <div class="form-group mb-2">
                        <input class="form-control" type="email" id="email" name="email" placeholder="Endereço de E-mail" required>
                    </div>

                    <div class="form-group mb-2">
                        <input class="form-control" type="password" id="senha" name="senha" placeholder="Senha" required>
                    </div>

                    <div class="form-group mb-2">
                        <select class="form-control" type="text" id="sexo" name="sexo" required>
                            <option value="" disabled selected hidden>Selecione um Gênero</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <input class="form-control" type="text" id="telefone" name="telefone" placeholder="Telefone" maxlength="15" pattern="\(\d{2}\)\s*\d{5}-\d{4}" required>
                    </div>

                    <div class="form-group mb-2">
                        <select class="form-control" id="uf" name="uf" required>
                            <option value="" disabled selected hidden>Selecione um Estado</option>
                            <option></option>
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <select class="form-control" id="cidade" name="cidade" required>
                            <option value="" disabled selected hidden>Selecione uma Cidade</option>
                            <option></option>
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <button class="form-control button" type="submit" id="registrador" name="criar">Cadastrar</button>
                    </div>

                    <div class="link login-link text-center">Já possui Cadastro? <a href="../index.php">Entrar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="../public/js/buscacidade.js"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const tel = document.getElementById('telefone');

            tel.addEventListener('input', (e) => mascaraTelefone(e.target.value));
        });

        const mascaraTelefone = (valor) => {
            valor = valor.replace(/\D/g, "");
            valor = valor.replace(/^(\d{2})(\d)/g, "($1) $2");
            valor = valor.replace(/(\d)(\d{4})$/, "$1-$2");
            document.getElementById('telefone').value = valor;
        };

        $(function() {
            $("#formucaduser").on("submit", function(event) {
                event.preventDefault();

                var valid = this.checkValidity();

                if (!valid) {
                    Swal.fire({
                        title: 'Erro',
                        text: 'Por favor, verifique os dados inseridos.',
                        icon: 'error'
                    });
                    return;
                }

                var nome = $('#nome').val();
                var email = $('#email').val();
                var senha = $('#senha').val();
                var sexo = $('#sexo').val();
                var telefone = $('#telefone').val();
                var uf = $('#uf').val();
                var cidade = $('#cidade').val();

                $.post("../app/controller/usuario_controller.php", {
                    nome,
                    email,
                    senha,
                    sexo,
                    telefone,
                    uf,
                    cidade
                }).done(function(data) {
                    rdata = JSON.parse(data);
                    if (rdata.status === 'success') {
                        Swal.fire({
                            title: 'Pronto',
                            text: rdata.message,
                            icon: 'success'
                        }).then(function() {
                            window.location = "../index.php";
                        });
                    } else {
                        Swal.fire({
                            title: 'Erro',
                            text: rdata.message,
                            icon: 'error'
                        });
                    }
                }).fail(function(jqXHR) {
                    Swal.fire({
                        title: 'Erro',
                        text: 'Falha na requisição',
                        icon: 'error'
                    });
                });
            });
        });
    </script>
</body>

</html>