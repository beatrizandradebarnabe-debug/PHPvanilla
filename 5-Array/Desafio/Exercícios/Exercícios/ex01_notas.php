<?php
declare(strict_types=1);
$notas = [7.5, 8.0, 6.5, 9.0, 5.5];

$soma = 0;


foreach ($notas as $nota) {
    $soma = $soma + $nota;
}

$totalNotas = count($notas);

$media = $soma / $totalNotas;

echo "A média final do aluno é: " . number_format($media, 1) . "<br>";

if ($media >= 7) {
    echo "Aprovado";
} else {
    echo "Reprovado";
}
