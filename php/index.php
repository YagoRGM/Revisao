<?php
session_start();
include 'conexao.php';

// Variável para armazenar o alerta
$alerta = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Login
    if (isset($_POST['email-login']) && isset($_POST['senha-login'])) {
        $email_digitado = $_POST['email-login'];
        $senha_digitado = $_POST['senha-login'];

        $sql2 = "SELECT * FROM usuários WHERE email = ?";
        $stmt2 = $conexao->prepare($sql2);
        $stmt2->bind_param("s", $email_digitado);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        if ($result2->num_rows == 1) {
            $usuario_logado = $result2->fetch_assoc();

            if (password_verify($senha_digitado, $usuario_logado['senha'])) {
                $_SESSION['nome_sessao'] = $usuario_logado['nome_usuario'];
                $_SESSION['tipo_sessao'] = $usuario_logado['tipo_usuario'];
                $_SESSION['id_sessao'] = $usuario_logado['id_usuario'];
                var_dump($_SESSION);  // Verifique se os dados da sessão estão sendo definidos corretamente
                header('location: dashbord.php');
                exit();
            }
            else {
                // Senha incorreta
                $alerta = "Swal.fire({
                    icon: 'error',
                    title: 'Senha incorreta',
                    text: 'Verifique sua senha e tente novamente.'
                });";
            }
        } else {
            // Email não encontrado
            $alerta = "Swal.fire({
                icon: 'error',
                title: 'Email não encontrado',
                text: 'Verifique o email e tente novamente.'
            });";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
    <link rel="stylesheet" href="../css/index.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<main>
    <div id="container">
        <!-- Formulário de Login -->
        <form action="" method="POST" id="login">
            <img src="../img/../img/LOGO PARA LOGIN.png" alt="">
            <h2>Entrar</h2>
            <label for="email">Email</label>
            <input type="email" name="email-login" id="email" required placeholder="@email.com">

            <label for="senha">Senha</label>
            <input type="password" name="senha-login" id="senha" required placeholder="******">

            <a id="esqueci-senha" href="esqueciSenha.php">Esqueci a Senha</a>

            <button type="submit">Entrar</button>
            
            <div class="criar-conta">
                <p>Não tem uma conta? <a id="criar-conta" href="cadastro.php">Criar uma conta</a></p>
            </div>
        </form>
    </div>
</main>

<!-- Script para exibir o alerta -->
<script>
    <?php
    if (!empty($alerta)) {
        echo $alerta;
    }
    ?>
</script>
</body>
</html>
