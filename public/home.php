<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

// Get user information
$user_id = $_SESSION["user_id"];
$user_email = $_SESSION["user_email"];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Sistema de Pedidos</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .logout-btn:hover {
            background-color: #2e7d32;
        }
        .card-link {
            display: block;
            text-decoration: none;
            color: inherit;
        }
        .card-link:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body class="bg-gray-100">
    <header class="bg-green-600 text-white py-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center px-4">
            <div class="text-xl font-bold">Sistema de Pedidos</div>
            <div class="flex items-center">
                <span class="mr-4"><?php echo htmlspecialchars($user_email); ?></span>
                <a href="logout.php" class="logout-btn bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800 transition-colors">Sair</a>
            </div>
        </div>
    </header>

    <div class="container mx-auto mt-10 px-4">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Bem-vindo ao Sistema de Pedidos</h1>
            <p class="text-gray-600 mb-6">Selecione uma das opções abaixo para começar:</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1 - Novo Pedido -->
                <a href="cadastra_pedidos.php" class="card-link bg-white p-6 rounded-lg shadow-md transform hover:translate-y-[-5px] transition-all duration-300 cursor-pointer">
                    <div class="text-green-600 text-4xl mb-4">📋</div>
                    <div class="text-xl font-semibold mb-2">Novo Pedido</div>
                    <div class="text-gray-600">Registrar um novo pedido no sistema</div>
                </a>

                <!-- Card 2 - Consultar Pedidos -->
                <a href="consulta_pedidos.php" class="card-link bg-white p-6 rounded-lg shadow-md transform hover:translate-y-[-5px] transition-all duration-300 cursor-pointer">
                    <div class="text-green-600 text-4xl mb-4">🔍</div>
                    <div class="text-xl font-semibold mb-2">Consultar Pedidos</div>
                    <div class="text-gray-600">Visualizar e gerenciar pedidos existentes</div>
                </a>

                <!-- Card 3 - Clientes -->
                <a href="clientes.php" class="card-link bg-white p-6 rounded-lg shadow-md transform hover:translate-y-[-5px] transition-all duration-300 cursor-pointer">
                    <div class="text-green-600 text-4xl mb-4">👤</div>
                    <div class="text-xl font-semibold mb-2">Clientes</div>
                    <div class="text-gray-600">Gerenciar cadastro de clientes</div>
                </a>

                <!-- Card 4 - Relatórios -->
                <a href="relatorios.php" class="card-link bg-white p-6 rounded-lg shadow-md transform hover:translate-y-[-5px] transition-all duration-300 cursor-pointer">
                    <div class="text-green-600 text-4xl mb-4">📊</div>
                    <div class="text-xl font-semibold mb-2">Relatórios</div>
                    <div class="text-gray-600">Gerar relatórios de vendas e pedidos</div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>