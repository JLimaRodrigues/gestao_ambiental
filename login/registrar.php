<?php
header('Content-Type: application/json'); 
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $conn = connect_local_mysqli('gestao_ambiental');
    
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $admin = $_POST['admin'];

    if (empty($username) || empty($email) || empty($password) || empty($admin)) {
        echo json_encode(["status" => "error", "message" => "Por favor, preencha todos os campos."]);
        exit;
    }

    $query = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ? OR email = ?");
    $query->bind_param("ss", $username, $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "Nome de usuário ou email já cadastrado!"]);
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, usuario, senha, email, admin) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $username, $hashed_password, $email, $admin);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Usuário cadastrado com sucesso!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Erro ao cadastrar usuário: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>