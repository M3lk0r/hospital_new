<?php
require '../model/Usuario.php';
require '../routes/web.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $sexo = $_POST['sexo'];
    $telefone = $_POST['telefone'];
    $uf = $_POST['uf'];
    $cidade = $_POST['cidade'];

    $usuario = new Usuario($nome, $email, $senha, $sexo, $telefone, $uf, $cidade);

    try {
        $resultado = CadastrarUsuario($usuario);

        $data = json_decode($resultado, true);
        $response_code = $data['http_code'];

        if ($response_code == 201) {
            echo json_encode(array('message' => $data['message'], 'status' => 'success'));
        } else {
            echo json_encode(array('message' => $data['message'], 'status' => 'error'));
        }
    } catch (Exception $e) {
        echo json_encode(array('message' => $e->getMessage(), 'status' => 'error'));
    }
}
