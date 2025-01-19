<?php
if (isset($_GET['login']) && !empty($_GET['login'])) {
} else {
    header('Location: login.php');
    exit();
}


include_once("backend/conexao.php");
include_once("backend/classes/classes_index.php");
include_once("backend/api/http.php");
include_once("backend/api/swapi.php");

$login = $_GET['login'];

$conexao = new Conexao();
$conn = $conexao->getConexao();

$filme = new FilmePrincipal($conn);
$filmes = $filme->EscolherFilme();

$httpClient = new HttpClient('https://swapi.py4e.com/api', $conn);
$swapiClient = new SwapiClient($httpClient);

$listas = $swapiClient->ListarFilmes();

$cod_filme = new ListaFilme($conn);

$cod_filmes = $cod_filme->CapturarTodosFilmes();

$cod_filmes_indexados = [];
foreach ($cod_filmes as $filme) {
    $cod_filmes_indexados[$filme['id']] = $filme;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="src/css/style.css">
</head>

<body>
    <?php include("src/itens/navbar.php"); ?>

    <section class="principal-index">
        <div class="fundo-principal">
            <?php
            foreach ($filmes as $filme) {
                echo "<img id='imagem-filme-principal' src='src/img/filmes/fundos/" . htmlspecialchars($filme['fundo']) . "' alt='filme'>
                <img id='imagem-filme-principal-mobile' src='src/img/filmes/fundos-mobile/" . htmlspecialchars($filme['fundo']) . "' alt='filme'>
                <video id='video-filme' src='src/img/filmes/videos/" . htmlspecialchars($filme['video']) . "' muted playsinline></video>
                <div class='barra-fundo-principal'></div>";
            }
            ?>
        </div>
        <div class="elementos-principal">
            <?php
            foreach ($filmes as $filme) {
                echo "<img class='logo-filme' src='src/img/filmes/logos/" . htmlspecialchars($filme['logo']) . "' alt='logo-filme'>
            <p>" . htmlspecialchars($filme['sinopse']) . "</p>";
            }
            ?>
            <button class='botao-assistir-principal'>
                <img src='src/img/elementos/play.png' width='15px' alt='play'>Watching
            </button>
        </div>
        <div class="ativar-som" id="ativar-som-botao" onclick="DesmutarVideo()">
            <img src="src/img/elementos/Som.png" width="30px" alt="som">
            <h3 id="texto-mutar">Ativar som</h3>
        </div>
    </section>

    <section class="lista-filmes-pai">
        <h1 class="titulo-lista">All movies</h1>
        <div class="lista-filmes">
            <?php
            foreach ($listas as $lista) {
                $episode_id = $lista['episode_id'];

                $cod_filme = isset($cod_filmes_indexados[$episode_id]) ? $cod_filmes_indexados[$episode_id] : null;

                $poster_url = $cod_filme ? 'src/img/filmes/poster/' . $cod_filme['foto'] : '';
                $poster_url_mobile = $cod_filme ? 'src/img/filmes/poster-mobile/' . $cod_filme['foto'] : '';

                $url_filme = urlencode($lista['url']);

            ?>
                <div class="poster-div">
                    <img src="<?php echo htmlspecialchars($poster_url); ?>" onclick="window.location.href = 'filme.php?login=<?php echo $login; ?>&id_filme=<?php echo $episode_id; ?>&url=<?php echo $url_filme ?>';" alt="Poster do filme <?php echo htmlspecialchars($lista['title']); ?>" class="poster-filme">
                    <img src="<?php echo htmlspecialchars($poster_url_mobile); ?>" onclick="window.location.href = 'filme.php?login=<?php echo $login; ?>&id_filme=<?php echo $episode_id; ?>&url=<?php echo $url_filme ?>';" alt="Poster do filme <?php echo htmlspecialchars($lista['title']); ?>" class="poster-filme-mobile" style="display: none;">
                </div>
            <?php } ?>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        // Função para aparecer parte de filme na div principal
        $(document).ready(function() {
            const $imagem = $("#imagem-filme-principal");
            const $video = $("#video-filme");
            const $botaoSom = $("#ativar-som-botao");

            $video.hide();
            $botaoSom.hide();

            setTimeout(function() {
                $imagem.fadeOut(1000, function() {
                    $video.fadeIn(1000);
                    $botaoSom.fadeIn(1000);
                    $video[0].play();
                });
            }, 3000);

            $video.on("ended", function() {
                $video.fadeOut(1000, function() {
                    $imagem.fadeIn(1000);
                    $botaoSom.fadeOut(1000);
                });
            });
        });


        // Função para ativar som do filme
        function DesmutarVideo() {
            var video = document.getElementById('video-filme');
            if (video.muted) {
                video.muted = false;
            }
            $("#texto-mutar").text("Desativar som")
            $("#ativar-som-botao").attr("onclick", "MutarVideo()")
        }

        // Essa faz o contrario
        function MutarVideo() {
            var video = document.getElementById('video-filme');
            if (!video.muted) {
                video.muted = true;
            }
            $("#texto-mutar").text("Ativar som")
            $("#ativar-som-botao").attr("onclick", "DesmutarVideo()")
        }
    </script>
</body>

</html>