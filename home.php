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
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background-color: #4caf50;
            color: white;
            padding: 15px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-email {
            margin-right: 15px;
        }

        .logout-btn {
            background-color: #388e3c;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .logout-btn:hover {
            background-color: #2e7d32;
        }

        .dashboard {
            margin-top: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 20px;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-icon {
            font-size: 2rem;
            margin-bottom: 15px;
            color: #4caf50;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .card-description {
            color: #666;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <header>
        <div class="container header-content">
            <div class="logo">Sistema de Pedidos</div>
            <div class="user-info">
                <span class="user-email"><?php echo htmlspecialchars($user_email); ?></span>
                <a href="logout.php" class="logout-btn">Sair</a>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="dashboard">
            <h1>Bem-vindo ao Sistema de Pedidos</h1>
            <p>Selecione uma das opções abaixo para começar:</p>

            <div class="dashboard-cards">
                <div class="card">
                    <div class="card-icon">📋</div>
                    <div class="card-title">Novo Pedido</div>
                    <div class="card-description">Registrar um novo pedido no sistema</div>
                </div>
                
                <div class="card">
                    <div class="card-icon">🔍</div>
                    <div class="card-title">Consultar Pedidos</div>
                    <div class="card-description">Visualizar e gerenciar pedidos existentes</div>
                </div>
                
                <div class="card">
                    <div class="card-icon">👤</div>
                    <div class="card-title">Clientes</div>
                    <div class="card-description">Gerenciar cadastro de clientes</div>
                </div>
                
                <div class="card">
                    <div class="card-icon">📊</div>
                    <div class="card-title">Relatórios</div>
                    <div class="card-description">Gerar relatórios de vendas e pedidos</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>