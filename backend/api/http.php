<?php
class HttpClient
{
    private $baseUrl;
    private $conn;

    public function __construct(string $baseUrl, $conn)
    {
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->conn = $conn;
    }

    public function get(string $endpoint): array
    {
        $url = $this->baseUrl . '/' . ltrim($endpoint, '/');
        $response = file_get_contents($url);

        if ($response === false) {
            throw new Exception("Erro ao fazer a requisição para: $url");
        }

        $this->logRequest($endpoint);

        return json_decode($response, true);
    }

    private function logRequest(string $endpoint): void
    {
        $stmt = $this->conn->prepare("INSERT INTO sw_log_api (requisicao, data_requisicao) VALUES (?, NOW())");
        if ($stmt) {
            $stmt->bind_param("s", $endpoint);
            $stmt->execute();
            $stmt->close();
        } else {
            throw new Exception("Erro ao preparar o log da requisição: " . $this->conn->error);
        }
    }
}
