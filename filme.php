<?php
if (isset($_GET['login']) && !empty($_GET['login'])) {
} else {
    header('Location: login.php');
    exit();
}

include_once("backend/conexao.php");
include_once("backend/classes/classes_filmes.php");
include_once("backend/api/http.php");
include_once("backend/api/swapi.php");

$id_filme = $_GET['id_filme'];

$conexao = new Conexao();
$conn = $conexao->getConexao();

$filme = new Filme($conn);
$filmes = $filme->CapturarFilme($id_filme);

$httpClient = new HttpClient('https://swapi.py4e.com/api', $conn);
$swapiClient = new SwapiClient($httpClient);

$filmUrl = $_GET['url'] ?? null;

if (!$filmUrl) {
    throw new Exception("ID do filme não fornecido.");
}

$filmId = str_replace('https://swapi.py4e.com/api/', '', $filmUrl);
$film = $httpClient->get($filmId);

// Calcular a idade do filme
$idadeFilme = $swapiClient->CalcularIdadeFilme($film['release_date']);

$characters = [];
foreach ($film['characters'] as $characterUrl) {
    $characterId = str_replace('https://swapi.py4e.com/api/', '', $characterUrl);
    $characters[] = $httpClient->get($characterId);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/11640fa694.js" crossorigin="anonymous"></script> <!-- Para importar o icone de voltar -->
    <link rel="stylesheet" href="src/css/style.css">
</head>

<body>
    <?php include("src/itens/navbar.php"); ?>

    <section class="principal-filme">
        <?php if ($filmes): ?>
            <img src="src/img/filmes/frames/<?php echo htmlspecialchars($filmes['foto']); ?>" alt="foto">
        <?php endif; ?>
        <div class='barra-fundo-principal'></div>
        <div class="dados-filmes" onclick="Voltar()">
            <div class="voltar">
                <i class="fa-solid fa-chevron-left" style="color:rgb(5, 5, 5);"></i>
            </div>
            <h1><?php echo htmlspecialchars($film['title']); ?></h1>
            <p>Episode <?php echo htmlspecialchars($film['episode_id']); ?></p>
            <p><?php echo nl2br(htmlspecialchars($film['opening_crawl'])); ?></p>
            <p>Release date: <?php echo htmlspecialchars($film['release_date']); ?></p>
            <p>Age: <?php echo "{$idadeFilme['years']} years, {$idadeFilme['months']} months e {$idadeFilme['days']} days"; ?></p>
            <p>Director: <?php echo htmlspecialchars($film['director']); ?></p>
            <p>Producers: <?php echo htmlspecialchars($film['producer']); ?></p>

            <h2>Characters</h2>
            <?php foreach ($characters as $character): ?>
                <p><strong><?php echo htmlspecialchars($character['name']); ?></strong></p><br>
            <?php endforeach; ?>
        </div>

    </section>

    <script>
        // Voltar uma página
        function Voltar() {
            window.history.back()
        }
    </script>
</body>

</html>