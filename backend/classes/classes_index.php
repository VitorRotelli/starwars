<?php
// Obejeto para selecionar um filme aleatorio para o index
class FilmePrincipal
{
    private $conn;

    public function __construct($conexao)
    {
        $this->conn = $conexao;
    }

    public function EscolherFilme()
    {
        $query_filme = "SELECT * FROM sw_filmes_index ORDER BY RAND() LIMIT 1;";
        $result_filme = $this->conn->query($query_filme);

        if ($result_filme->num_rows > 0) {
            $filme = [];
            while ($row_filme = $result_filme->fetch_assoc()) {
                $filme[] = [
                    'id' => $row_filme['id'],
                    'logo' => $row_filme['logo'],
                    'fundo' => $row_filme['fundo'],
                    'sinopse' => $row_filme['sinopse'],
                    'video' => $row_filme['video']
                ];
            }
            return $filme;
        }
        return [];
    }
}

class ListaFilme
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function CapturarFilme($id_filme)
    {
        $stmt = $this->conn->prepare("SELECT * FROM sw_lista_filmes WHERE id = ?");
        $stmt->bind_param("i", $id_filme);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function CapturarTodosFilmes()
    {
        $stmt = $this->conn->prepare("SELECT * FROM sw_lista_filmes");
        $stmt->execute();
        $result = $stmt->get_result();

        $filmes = [];
        while ($row = $result->fetch_assoc()) {
            $filmes[] = $row;
        }
        return $filmes;
    }
}

