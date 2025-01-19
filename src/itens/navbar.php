<?php
include_once("backend/conexao.php");
include_once("backend/classes/classes_navbar.php");

$id_usuario = $_GET['login'];

$conexao = new Conexao();
$conn = $conexao->getConexao();

$usuario = new Usuario($conn);
$usuarios = $usuario->CapturarUsuario($id_usuario);
?>

<nav>
    <div class="esquerda-navbar">
        <a href="index.php?login=<?php echo $id_usuario ?>"><img src="src/img/logo/Logo-tracada.png" alt="logo"></a>
    </div>
    <div class="direita-navbar">
        <img src="src/img/elementos/navbar/procurar.png" alt="procurar">
        <img src="src/img/elementos/navbar/sino.png" alt="sino">
        <?php
            if ($usuarios) {
                echo "<img class='img-usuario-navbar' src='src/img/elementos/perfil/" . htmlspecialchars($usuarios['foto']) . "' alt='perfil'>";
            }
        ?>
    </div>
</nav>
