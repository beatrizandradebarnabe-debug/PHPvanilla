<?php
declare(strict_types=1);

$carrinho = [
    ["produto" => "Notebook", "preco" => 4000.00],
    ["produto" => "Mouse", "preco" => 150.00],
    ["produto" => "Teclado", "preco" => 300.00]
];

$carrinhoBlackFriday = array_map(
    fn($item) => [
        "produto" => $item["produto"],
        "preco" => $item["preco"] * 0.80
    ],
    $carrinho
);

echo "<h1>Black Friday</h1>";

foreach ($carrinhoBlackFriday as $item) {
    echo "<p>";
    echo $item["produto"] . " - R$ ";
    echo number_format($item["preco"], 2, ",", ".");
    echo "</p>";
}
?>