<?php
include_once('conexao.php');
session_start();

if(!isset($_SESSION['nome_sessao'])){
    header('Location: index.php');
    exit();
}

$sql_usuarios = 'SELECT * FROM usuários';
$resultado_usuarios = $conexao->query($sql_usuarios);

$sql_filmes = 'SELECT * FROM filmes';
$resultado_filmes = $conexao->query($sql_filmes);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dashbord.css">
    <title>Revisão</title>
</head>
<body>
    <header>
        <nav>
            <?php if (isset($_SESSION['nome_sessao'])): ?>
                <a id="logout" href="index.php">Sair</a>
                <?php else: ?>
                    <a id="logout" href="index.php">Entrar</a>
                <?php endif; ?>
        </nav>
    </header>
    <main>
        <div id="tabelas">
            <div class="container">
                <h1 class="title-gerenc">Usúarios</h1>
                <div class="tabela-div">
                    <table id="tabela_usuario">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($resultado_usuarios->num_rows > 0) {
                                while ($linha_usuarios = $resultado_usuarios->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $linha_usuarios['nome'] . "</td>";
                                    echo "<td>" . $linha_usuarios['email'] . "</td>";
                                    echo "</tr>";
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="container">
                <h1 class="title-gerenc">Filmes</h1>
                <div class="tabela-div">
                    <table id="tabela_filme">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Gênero</th>
                                <th>Ano</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($resultado_filmes->num_rows > 0) {
                                while ($linha_filmes = $resultado_filmes->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td class='td'>" . $linha_filmes['titulo'] . "</td>";
                                    echo "<td class='td'>" . $linha_filmes['genero'] . "</td>";
                                    echo "<td class='td'>" . $linha_filmes['ano_lançamento'] . "</td>";
                                    echo "</tr>";
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>