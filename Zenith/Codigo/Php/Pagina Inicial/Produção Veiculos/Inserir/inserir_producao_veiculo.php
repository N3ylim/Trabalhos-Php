<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir Produção de Veículo</title>
    <link rel="stylesheet" href="/Codigo/Php/Pagina Inicial/Produção Veiculos/Css/Inserir.css">
</head>

<body>

    <div class="container">
        <h2>Inserir Produção de Veículo</h2>

        <form action="/Codigo/Php/Pagina Inicial/Produção Veiculos/Inserir/processar_inserir_producao_veiculo.php" method="post">
            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" required>

            <label for="quantidade">Quantidade Produzida:</label>
            <input type="number" id="quantidade" name="quantidade" required>

            <label for="linha_producao">Linha de Produção:</label>
            <input type="text" id="linha_producao" name="linha_producao" required>

            <button type="submit" class="submit-btn">Inserir</button>
        </form>
    </div>

</body>

</html>
