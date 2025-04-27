<?php 
    session_start();
    require "config.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $password = $_POST["password"];

        if(!empty($email) && !empty($password)){
           $stmt = $conn->prepare("SELECT * FROM usuarios WHERE s_email_usuario = ?");
           $stmt->execute([$email]);
           $user = $stmt->fetch(PDO::FETCH_ASSOC);

           if($user && password_verify($password, $user["s_senha_usuario"])){
                $_SESSION["user_id"] = $user["id_usuario"];
                $_SESSION["user_email"] = $user["s_email_usuario"];
                header("Location: home.php");
                exit();
           }else {
            $erro = "E-mail ou senha incorretos.";
           }
          
        }else {
            $erro = "E-mail e senha são obrigatórios.";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistema de Pedidos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            width: 100%;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: linear-gradient(120deg, #d4fc79 0%, #96e6a1 100%);
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 2.5rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .login-container:hover {
            transform: translateY(-5px);
        }

        .form__titulo {
            color: #2e7d32;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 1.8rem;
            font-weight: 600;
        }

        .form__input {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 1.5rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form__input:focus {
            border-color: #4caf50;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.2);
        }

        .form__input::placeholder {
            color: #9e9e9e;
        }

        .form__button {
            width: 100%;
            padding: 12px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form__button:hover {
            background-color: #388e3c;
        }

        .form__footer {
            text-align: center;
            margin-top: 1.5rem;
            color: #616161;
        }

        .form__footer a {
            color: #2e7d32;
            font-weight: 500;
            text-decoration: none;
        }

        .form__footer a:hover {
            text-decoration: underline;
        }

        .logo {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .logo img {
            height: 50px;
        }
    </style>
</head>
<body>
    <form class="login-container" action="index.php" method="post">
        <div class="logo">
            <!-- You can add your logo here -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#4CAF50" width="50px" height="50px">
                <path d="M0 0h24v24H0z" fill="none"/>
                <path d="M12 2L4.5 20.29l.71.71L12 18l6.79 3 .71-.71z"/>
            </svg>
        </div>
        <h2 class="form__titulo">
            Acesse sua conta
        </h2>
        <?php if(isset($erro)): ?>
            <div style="color: #f44336; margin-bottom: 15px; text-align: center;"><?php echo $erro; ?></div>
        <?php endif; ?>
        <input type="email" name="email" id="email" class="form__input" placeholder="Digite seu e-mail" required>
        <input type="password" name="password" id="password" class="form__input" placeholder="Digite sua senha" required>
        <button type="submit" class="form__button">Entrar</button>
        <div class="form__footer">
            Não tem uma conta? <a href="register.html">Cadastre-se</a>
        </div>
    </form>
</body>
</html>