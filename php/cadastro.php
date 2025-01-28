<?php
    session_start();
    include 'conexao.php';
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Cadastro de usuário
        if (isset($_POST['nome_cadastro']) && isset($_POST['email_cadastro']) && isset($_POST['senha_cadastro'])) {
    
            $nome_cadastro_digitado = $_POST['nome_cadastro'];
            $email_cadastro_digitado = $_POST['email_cadastro'];
            $senha_cadastro_digitado = md5($_POST['senha_cadastro']); // NÃO use md5 em produção! Considere usar bcrypt ou outra função mais segura.
    
            $sql1 = "INSERT INTO usuários(nome,email,senha) VALUES(?,?,?)";
            $stmt1 = $conexao->prepare($sql1);
            $stmt1->bind_param('sss', $nome_cadastro_digitado, $email_cadastro_digitado, $senha_cadastro_digitado);
            $stmt1->execute();
    
            // Definindo uma variável de sucesso
            $cadastro_sucesso = true;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/cadastro.css">
    <script src="../js/cadastro.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <main>
        <div id="container">
            
            <!-- Formulário de Cadastro -->
            <form action="" method="POST" id="cadastrar">
                <button id="voltar">Voltar</button>
                <h2>Cadastro de Usuário</h2>
    
                <label for="nome">Nome</label>
                <input type="text" name="nome_cadastro" id="nome" required>
    
                <label for="email_cadastro">Email</label>
                <input type="email" name="email_cadastro" id="email_cadastro" required placeholder="@email.com">
    
                <label for="senha_cadastro">Criar Senha <p id="senha_mensagem"></p> </label>
                <input type="password" name="senha_cadastro" id="senha_cadastro" required placeholder="******">
    
                <button type="submit">Criar Conta</button>
            </form>
        </div>
    </main>
    <script>
        // Verificar se o PHP setou a variável 'cadastro_sucesso'
        <?php if (isset($cadastro_sucesso) && $cadastro_sucesso): ?>
            Swal.fire({
                icon: 'success',
                title: 'Usuário cadastrado com sucesso!',
                text: 'Você será redirecionado para a página de login.',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "index.php"; // Redireciona após o OK no alerta
                }
            });
        <?php endif; ?>
    </script>
</body>
</html>