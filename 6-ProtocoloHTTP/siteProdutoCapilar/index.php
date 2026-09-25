<?php
// aplicação de página unica de variaveis superglobais ($_GET, $_POST, $_SERVER)]
declare(strict_types=1);

//Dados Simulados 

$produtos = [
['nome' => 'Shampoo Antiqueda', 'marca' => 'Vichy', 'categoria' => 'Shampoo', 'preco' => 89.90],

['nome' => 'Condicionador Hidratante', 'marca' => 'Dove', 'categoria' => 'Condicionador', 'preco' => 18.90],

['nome' => 'Máscara de Nutrição', 'marca' => 'Novex', 'categoria' => 'Máscara', 'preco' => 29.90],

['nome' => 'Creme para Pentear Cachos', 'marca' => 'Seda', 'categoria' => 'Finalizador', 'preco' => 16.50],

['nome' => 'Óleo de Argan', 'marca' => 'Inoar', 'categoria' => 'Óleo Capilar', 'preco' => 42.90],

['nome' => 'Shampoo Pós-Química', 'marca' => 'Forever Liss', 'categoria' => 'Shampoo', 'preco' => 34.90],

['nome' => 'Máscara de Hidratação Intensa', 'marca' => 'Lola Cosmetics', 'categoria' => 'Máscara', 'preco' => 54.90],

['nome' => 'Condicionador Reconstrutor', 'marca' => 'Truss', 'categoria' => 'Condicionador', 'preco' => 76.90],

['nome' => 'Spray Finalizador', 'marca' => 'Eudora', 'categoria' => 'Finalizador', 'preco' => 39.90],

['nome' => 'Shampoo Nutritivo', 'marca' => 'O Boticário', 'categoria' => 'Shampoo', 'preco' => 31.90],

['nome' => 'Máscara para Cabelos Cacheados', 'marca' => 'Widi Care', 'categoria' => 'Máscara', 'preco' => 49.90],

['nome' => 'Creme de Pentear Definição', 'marca' => 'Soul Power', 'categoria' => 'Finalizador', 'preco' => 36.90],

['nome' => 'Tônico Fortalecedor', 'marca' => 'Salon Line', 'categoria' => 'Tratamento', 'preco' => 28.90],

['nome' => 'Ampola de Reconstrução', 'marca' => 'Kanechom', 'categoria' => 'Tratamento', 'preco' => 12.90],

['nome' => 'Shampoo Micelar', 'marca' => 'Pantene', 'categoria' => 'Shampoo', 'preco' => 26.90],

['nome' => 'Condicionador Ultra Hidratação', 'marca' => 'TRESemmé', 'categoria' => 'Condicionador', 'preco' => 23.90],

['nome' => 'Óleo Reparador de Pontas', 'marca' => 'Elseve', 'categoria' => 'Óleo Capilar', 'preco' => 37.90],

['nome' => 'Máscara Abacaxi', 'marca' => 'Skala', 'categoria' => 'Máscara', 'preco' => 11.90],

['nome' => 'Protetor Térmico', 'marca' => 'Revlon', 'categoria' => 'Finalizador', 'preco' => 69.90],

['nome' => 'Shampoo Reconstrução', 'marca' => 'Joico', 'categoria' => 'Shampoo', 'preco' => 119.90],
];

//Declarar algumas Variáveis
$mensagemSucesso = "";
$erro = [];

$nome = "";
$email = "";

// Processamento usando o GET (busca na lista de produtos) = index.php?produto=mouse&preco_maximo=100

$buscaProduto = trim((string) ($_GET["produto"] ?? "")); //verificação/operador de nulidade de uma variável (coalescência nula)
$precoMaximoTexto = trim((string) ($_GET["preco_maximo"] ?? ""));

$produtosFiltrados = $produtos; //filtro para a lista de produtos

if ($buscaProduto !== "" || $precoMaximoTexto !== "") {
    $produtosFiltrados = array_filter(
        $produtos,
        function (array $produto) use ($buscaProduto, $precoMaximoTexto): bool {
            $nomeCorrespondente = true;
            $precoCorrespondente = true;
            if ($buscaProduto !== "") {
                $nomeCorrespondente = str_contains(
                    strtolower($produto["nome"]),
                    strtolower($buscaProduto)
                );
            }

            if ($precoMaximoTexto !== "") {
                $precoMaximo = filter_var(
                    $precoMaximoTexto,
                    FILTER_VALIDATE_FLOAT
                );
                $precoCorrespondente = $precoMaximo !== false && $produto["preco"] <= $precoMaximo;
            }
            return $nomeCorrespondente && $precoCorrespondente;
        }
    );
}

//Processamento do POST

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //Recuperar os Dados de um Formulário
    $nome = trim((string) ($_POST["nome"] ?? ""));
    $email = trim((string) ($_POST["email"] ?? ""));

    // Validação do Servidor

    if (strlen($nome) < 3) {
        $erro["nome"] = "Informe um nome com pelo menos 3 caracteres";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro["email"] = "Informe um email Válido";
    }

    //SE não existir erros, o cadastro será realizado
    if ($erro === []) {
        $mensagemSucesso = "Cadastro Realizado com Sucesso!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Capilares</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <h1>Produtos Capilares</h1>

        <section>
            <p>Procure o seu produto de preferência</p>


            <form action="index.php" method="GET">
                <label for="produto">Nome do produto</label>
                <input type="text" name="produto" id="produto" placeholder="Escreva o nome de um produto">

                <label for="preco_maximo">Preço Máximo</label>
                <input type="number" name="preco_maximo" id="preco_maximo" step="0.01" placeholder="100">

                <button type="submit">Pesquisar</button>
            </form>

            <h2>Lista de Produtos Filtrados</h2>
            <p>Observer que os dados da pesquisa aparecem na URL</p>

            <?php if ($produtosFiltrados === []): ?>
                <p class="vazio">Nenhum produto encontrado.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Categoria</th>
                            <th>Preço</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produtosFiltrados as $produto): ?>
                            <tr>
                                <td><?= $produto['nome'] ?></td>
                                <td><?= $produto['categoria'] ?></td>
                                <td>
                                    R$ <?= number_format($produto['preco'], 2, ',', '.') ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

        </section>

        <section>
            <h2>Cadastro de Clientes</h2>
            <p>Cadastre-se para receber nossas promoções</p>

            <?php if ($mensagemSucesso !== "") : ?>
                <div class="sucesso">
                    <?= $nome ?><br>
                    <?= $email ?>
                </div>
            <?php endif; ?>

            <form action="index.php" method="POST" novalidate>
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" placeholder="Digite seu Nome">
                <?php if (isset($erro["nome"])): ?>
                    <div class="erro">
                        <?= $erro["nome"] ?>
                    </div>
                <?php endif; ?>

                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Digite seu Email">
                <?php if (isset($erro["email"])): ?>
                    <div class="erro">
                        <?= $erro["email"] ?>
                    </div>
                <?php endif; ?>

                <button type="submit">Cadastro</button>



            </form>
        </section>
    </main>

</body>

</html>