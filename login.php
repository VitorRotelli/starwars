<?php
include_once("backend/conexao.php");
include_once("backend/classes/classes_login.php");

$conexao = new Conexao();
$conn = $conexao->getConexao();

$imperio = new LoginImperio($conn);
$imperios = $imperio->ListarImperio();

$rebelde = new LoginRebelde($conn);
$rebeldes = $rebelde->ListarRebelde();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="src/css/style.css">
</head>

<body>
    <?php include("src/itens/faixa-superior.html"); ?>

    <section class="perfil-login">
        <div class="titulo-login">
            <h1>Who's watching?</h1>
        </div>
        <div class="pai-div-perfis-login" id="div-rebelde">
            <div class="div-perfis-login">
                <?php
                foreach ($rebeldes as $rebelde) {
                    echo "
                    <div class='perfil' onclick='window.location.href=\"index.php?login=" . htmlspecialchars($rebelde['id']) . "\";'>
                        <img class='img-perfil' src='src/img/elementos/perfil/" . htmlspecialchars($rebelde['foto']) . "' alt=''>
                        <p class='nome-perfil'>" . htmlspecialchars($rebelde['nome']) . "</p>
                    </div>";
                }
                ?>
            </div>
        </div>
        <div class="pai-div-perfis-login" id="div-imperio">
            <div class="div-perfis-login">
                <?php
                foreach ($imperios as $imperio) {
                    echo "
                    <div class='perfil' onclick='window.location.href=\"index.php?login=" . htmlspecialchars($imperio['id']) . "\";'>
                        <img class='img-perfil' src='src/img/elementos/perfil/" . htmlspecialchars($imperio['foto']) . "' alt=''>
                        <p class='nome-perfil'>" . htmlspecialchars($imperio['nome']) . "</p>
                    </div>";
                }
                ?>
            </div>
        </div>
        <div class="div-faccao-login">
            <div class="faccao-login-ativa" id="faccao-login-rebelde" onclick="EsconderImperio()">
                <img src="src/img/elementos/rebeldes.svg" alt="">
            </div>
            <div class="faccao-login" id="faccao-login-imperio" onclick="EsconderRebelde()">
                <img src="src/img/elementos/Imperio.svg" width="100" alt="">
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>

        // Função para esconder perfis da aliança rebelde e aparecer do imperio
        function EsconderRebelde() {
            $("#div-rebelde").fadeOut(function() {
                $("#div-imperio").fadeIn();
            });
            $("#faccao-login-rebelde").removeClass("faccao-login-ativa");
            $("#faccao-login-rebelde").addClass("faccao-login");
            $("#faccao-login-imperio").addClass("faccao-login-ativa");
            $("#faccao-login-imperio").removeClass("faccao-login");
        }

        // Essa faz o contrario
        function EsconderImperio() {
            $("#div-imperio").fadeOut(function() {
                $("#div-rebelde").fadeIn();
            });
            $("#faccao-login-rebelde").addClass("faccao-login-ativa");
            $("#faccao-login-rebelde").removeClass("faccao-login");
            $("#faccao-login-imperio").removeClass("faccao-login-ativa");
            $("#faccao-login-imperio").addClass("faccao-login");
        }
    </script>
</body>

</html>