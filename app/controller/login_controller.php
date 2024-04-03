<?php
require '../routes/web.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    try {
        $resultado = json_decode(autenticar($email, $senha), true);
        if ($resultado['http_code'] == 200) {
            $token = $resultado['token'];
            $exp = $resultado['exp'];

            session_start();
            $_SESSION['Autenticado'] = true;

            echo json_encode(['message' => $resultado['message'], 'status' => 'success', 'token' => $token]);
        } else if ($resultado['message'] == null) {
            echo json_encode(['message' => 'Deu ruim', 'status' => 'error']);
        } else {
            echo json_encode(['message' => $resultado['message'], 'status' => 'error']);
        }
    } catch (\Exception $e) {
        echo json_encode(['message' => $e->getMessage(), 'status' => 'error']);
    }
}
