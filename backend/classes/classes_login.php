<?php
class LoginImperio
{
    private $conn;

    public function __construct($conexao)
    {
        $this->conn = $conexao;
    }

    public function ListarImperio()
    {
        $query_imperio = "SELECT * FROM sw_login WHERE faccao = 1";
        $result_imperio = $this->conn->query($query_imperio);

        if ($result_imperio->num_rows > 0) {
            $imperio = [];
            while ($row_imperio = $result_imperio->fetch_assoc()) {
                $imperio[] = [
                    'id' => $row_imperio['id'],
                    'nome' => $row_imperio['nome'],
                    'foto' => $row_imperio['foto'],
                    'faccao' => $row_imperio['faccao']
                ];
            }
            return $imperio;
        }
        return [];
    }
}

class LoginRebelde
{
    private $conn;

    public function __construct($conexao)
    {
        $this->conn = $conexao;
    }

    public function ListarRebelde()
    {
        $query_rebelde = "SELECT * FROM sw_login WHERE faccao = 2";
        $result_rebelde = $this->conn->query($query_rebelde);

        if ($result_rebelde->num_rows > 0) {
            $rebelde = [];
            while ($row_rebelde = $result_rebelde->fetch_assoc()) {
                $rebelde[] = [
                    'id' => $row_rebelde['id'],
                    'nome' => $row_rebelde['nome'],
                    'foto' => $row_rebelde['foto'],
                    'faccao' => $row_rebelde['faccao']
                ];
            }
            return $rebelde;
        }
        return [];
    }
}
