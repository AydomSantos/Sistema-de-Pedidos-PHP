<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

require "../config/config.php";
$msgErro = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nomePedido = $_POST['nome'];
    $obsPedido = $_POST['observacao'];
    $qtdPedido = $_POST['qtd_produto'];
    $valorPedido = $_POST['valor_produto'];

    if(empty($nomePedido) || empty($obsPedido) || empty($qtdPedido) || empty($valorPedido)){
        $msgErro = "Por favor, preencha todos os campos.";
    } else {
        try{
            $sql = "INSERT INTO item_pedido (s_nome_pedido, s_descricao_pedido, i_qtd_pedido, i_valor_pedido)
            VALUES(?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nomePedido, $obsPedido, $qtdPedido, $valorPedido]);
        }catch(PDOException $e){
            $msgErro = 'Erro ao Cadastrar Pedido' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pedidos</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Cadastro de Pedidos</h1>
        <form action="cadastra_pedidos.php" method="post">
            <div class="mb-4">
                <label for="nome" class="block text-gray-700 font-semibold mb-2">Nome do Produto:</label>
                <input type="text" name="nome" id="nome" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600" required>
            </div>
            <div class="mb-4">
                <label for="observacao" class="block text-gray-700 font-semibold mb-2">Observação:</label>
                <textarea name="observacao" id="observacao" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600" rows="4" required></textarea>
            </div>
            <div class="mb-4">
                <label for="qtd_produto" class="block text-gray-700 font-semibold mb-2">Quantidade:</label>
                <input type="number" name="qtd_produto" id="qtd_produto" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600" required>
            </div>
            <div class="mb-4">
                <label for="valor_produto" class="block text-gray-700 font-semibold mb-2">Valor Total:</label>
                <input type="number" name="valor_produto" id="valor_produto" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600" required>
            </div>
            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition-colors duration-300">Cadastrar</button>
        </form>
    </div>
</body>
</html>
