<?php
declare(strict_types=1);

$filmes = [
    ["titulo" => "Matrix", "genero" => "Ficção", "classificacao_idade" => 16],
    ["titulo" => "Shrek", "genero" => "Animação", "classificacao_idade" => "livre"],
    ["titulo" => "Deadpool", "genero" => "Ação", "classificacao_idade" => 18],
    ["titulo" => "Procurando Nemo", "genero" => "Animação", "classificacao_idade" => "livre"],
    ["titulo" => "Vingadores", "genero" => "Ação", "classificacao_idade" => 12]
];

$filmesInfantis = array_filter($filmes, fn($filme) => $filme["classificacao_idade"] === "livre");

echo "<h1>Filmes Infantis</h1>";

foreach ($filmesInfantis as $filme) {
    echo "<p>";
    echo $filme["titulo"] . " - ";
    echo $filme["genero"] . " - ";
    echo $filme["classificacao_idade"] . " anos";
    echo "</p>";
}
?>