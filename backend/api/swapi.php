<?php

require_once 'http.php';

class SwapiClient
{
    private $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function ListarFilmes(): array
    {
        $data = $this->httpClient->get('films');
        return $data['results'] ?? [];
    }

    public function ListarPersonagens(): array
    {
        $data = $this->httpClient->get('people');
        return $data['results'] ?? [];
    }

    public function CalcularIdadeFilme(string $releaseDate): array
    {
        $releaseDateObj = new DateTime($releaseDate);
        $currentDate = new DateTime();
        $interval = $releaseDateObj->diff($currentDate);

        return [
            'years' => $interval->y,
            'months' => $interval->m,
            'days' => $interval->d,
        ];
    }
}
