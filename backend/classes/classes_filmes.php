<?php
class Filme
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
}
