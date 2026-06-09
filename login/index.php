<?php

session_start();

include("conexao.php");

$erro = "";

if (isset($_POST['email']) && isset($_POST['senha'])) {

    if (strlen($_POST['email']) == 0) {

        $erro = "Preencha seu e-mail";

    } elseif (strlen($_POST['senha']) == 0) {

        $erro = "Preencha sua senha";

    } else {

        $email = trim($_POST['email']);
        $senha = trim($_POST['senha']);

        $sql = "SELECT * FROM usuarios
                WHERE email = :email
                AND senha = :senha";

        $stmt = $conn->prepare($sql);

        $stmt->execute([
            ':email' => $email,
            ':senha' => $senha
        ]);

        $usuario = $stmt->fetch();

        if ($usuario) {

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['email'] = $usuario['email'];

            header("Location: ../painel/index.php");
            exit();

        } else {

            $erro = "E-mail ou senha incorretos!";

        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CineGibi</title>

    <link rel="stylesheet" href="login.css">
</head>

<body>

<div class="login-card">

    <div class="login-logo">

        <span class="icone">🎬</span>

        <h1>CineGibi</h1>

        <p>Sistema de Gestão</p>

    </div>

    <div class="login-body">

        <?php if ($erro != "") : ?>

            <div class="msg-erro">
                <?= $erro ?>
            </div>

        <?php endif; ?>

        <form method="POST">

            <p>

                <label>E-mail</label>

                <input
                    type="email"
                    name="email"
                    placeholder="funcionario@cinegibi.com"
                    required>

            </p>

            <p>

                <label>Senha</label>

                <input
                    type="password"
                    name="senha"
                    placeholder="••••••••"
                    required>

            </p>

            <p>

                <button type="submit">
                    Entrar
                </button>

            </p>

        </form>

    </div>

</div>

</body>

</html>