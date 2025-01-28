<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/index.css">
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
    
</body>
</html>