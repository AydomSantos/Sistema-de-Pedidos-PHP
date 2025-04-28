<?php
session_start();
require "config.php";

// Add error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Use htmlspecialchars instead of deprecated FILTER_SANITIZE_STRING
    $nome = htmlspecialchars($_POST['nome'], ENT_QUOTES, 'UTF-8');
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'];
    $confirmarSenha = $_POST['confirmar-senha'];

    // Debug
    // echo "<pre>POST: "; print_r($_POST); echo "</pre>";

    // validações 
    if (empty($nome) || empty($email) || empty($senha) || empty($confirmarSenha)) {
        $erro = 'Por favor, preencha todos os campos.'; 
    } elseif ($senha !== $confirmarSenha) {
        $erro = 'As senhas não coincidem.';
    } elseif(strlen($senha) < 6) {
        $erro = 'A senha deve ter pelo menos 6 caracteres.';
    } else {
        try {
            // Fix column name in the SELECT query
            $stmt = $conn->prepare("SELECT * FROM usuarios WHERE s_email_usuario = ?");
            $stmt->execute([$email]);

            if($stmt->rowCount() > 0) {
                $erro = 'Este e-mail já está cadastrado.'; 
            } else {
                $hash = password_hash($senha, PASSWORD_DEFAULT);

                try {
                    // Fix column names in the INSERT query
                    $stmt = $conn->prepare("INSERT INTO usuarios (s_nome_usuario, s_email_usuario, s_senha_usuario) VALUES (?, ?, ?)");
                    $stmt->execute([$nome, $email, $hash]);
                    
                    // Redirect after successful registration
                    header('Location: index.php');
                    exit();
                } catch(PDOException $e) {
                    $erro = 'Erro ao cadastrar usuário: ' . $e->getMessage();
                }
            }
        } catch(PDOException $e) {
            $erro = 'Erro ao verificar email: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários | Sistema de Pedidos</title>
    <style>
        :root {
            --primary-green: #2e7d32;
            --secondary-green: #4caf50;
            --light-green: #8bc34a;
            --white: #ffffff;
            --light-gray: #f5f5f5;
            --dark-gray: #333333;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        
        body {
            background-color: var(--light-gray);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: radial-gradient(circle, #d4fc79 0%, #96e6a1 100%);
            padding: 20px;
        }
        
        .register-container {
            width: 100%;
            max-width: 500px;
            background-color: var(--white);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            transition: transform 0.3s ease;
        }
        
        .register-container:hover {
            transform: translateY(-5px);
        }
        
        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .form-title {
            color: var(--primary-green);
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }
        
        .form-subtitle {
            color: var(--dark-gray);
            font-weight: normal;
            font-size: 1rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--dark-gray);
            font-weight: 500;
        }
        
        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
        }
        
        .form-input:focus {
            border-color: var(--secondary-green);
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.2);
            outline: none;
        }
        
        .form-button {
            width: 100%;
            padding: 14px;
            background-color: var(--secondary-green);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 1rem;
        }
        
        .form-button:hover {
            background-color: var(--primary-green);
        }
        
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--dark-gray);
        }
        
        .login-link a {
            color: var(--primary-green);
            font-weight: 500;
            text-decoration: none;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
        
        .input-icon {
            position: absolute;
            right: 15px;
            top: 40px;
            color: var(--primary-green);
        }
        
        @media (max-width: 600px) {
            .register-container {
                padding: 1.5rem;
            }
            
            .form-title {
                font-size: 1.5rem;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <form class="register-container" action="register.php" method="post">
        <div class="form-header">
            <h1 class="form-title">Criar Conta</h1>
            <p class="form-subtitle">Preencha os dados para se cadastrar</p>
        </div>
        
        <?php if(!empty($erro)): ?>
        <div style="color: #f44336; margin-bottom: 15px; text-align: center; padding: 10px; background-color: rgba(244, 67, 54, 0.1); border-radius: 4px;">
            <?php echo $erro; ?>
        </div>
        <?php endif; ?>
        
        <div class="form-group">
            <label for="nome" class="form-label">Nome Completo</label>
            <input type="text" id="nome" name="nome" class="form-input" placeholder="Digite seu nome completo" required>
            <i class="fas fa-user input-icon"></i>
        </div>
        
        <div class="form-group">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" id="email" name="email" class="form-input" placeholder="Digite seu e-mail" required>
            <i class="fas fa-envelope input-icon"></i>
        </div>
        
        <div class="form-group">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" id="senha" name="senha" class="form-input" placeholder="Crie uma senha" minlength="6" required>
            <i class="fas fa-lock input-icon"></i>
        </div>
        
        <div class="form-group">
            <label for="confirmar-senha" class="form-label">Confirmar Senha</label>
            <input type="password" id="confirmar-senha" name="confirmar-senha" class="form-input" placeholder="Confirme sua senha" minlength="6" required>
            <i class="fas fa-lock input-icon"></i>
        </div>
        
        <button type="submit" class="form-button">Cadastrar</button>
        
        <div class="login-link">
            Já tem uma conta? <a href="index.php">Faça login</a>
        </div>
    </form>

    <script>
        // Basic password match validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const senha = document.getElementById('senha').value;
            const confirmarSenha = document.getElementById('confirmar-senha').value;
            
            if (senha !== confirmarSenha) {
                e.preventDefault();
                alert('As senhas não coincidem!');
                document.getElementById('senha').focus();
            }
        });
    </script>
</body>
</html>