<?php
// Controller para consumir dados da 4ª rodada do Brasileirão via TheSportsDB
class BrasileiraoController {
    private $baseUrl = 'https://www.thesportsdb.com/api/v1/json/1/';
    private $leagueId = '4328'; // Brasileirão Série A

    // Busca todos os jogos da 4ª rodada
    public function getRodadaJogos($rodada = 4, $season = '2025') {
        $url = $this->baseUrl . "eventsround.php?id={$this->leagueId}&r={$rodada}&s={$season}";
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        return $data['events'] ?? [];
    }

    // Busca classificação atual
    public function getClassificacao($season = '2025') {
        $url = $this->baseUrl . "lookuptable.php?l={$this->leagueId}&s={$season}";
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        return $data['table'] ?? [];
    }

    // Odds não disponíveis na TheSportsDB, simula odds
    public function getOdds($jogos) {
        $odds = [];
        foreach ($jogos as $jogo) {
            $odds[$jogo['idEvent']] = [
                'home' => rand(1, 3) + (rand(0, 99)/100),
                'draw' => rand(2, 4) + (rand(0, 99)/100),
                'away' => rand(1, 3) + (rand(0, 99)/100)
            ];
        }
        return $odds;
    }
}
