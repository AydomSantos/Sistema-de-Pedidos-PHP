# Sistema de Pedidos 

## Sobre o Projeto

Este é um sistema de gerenciamento de pedidos por telefone desenvolvido em PHP. O sistema permite que estabelecimentos recebam e gerenciem pedidos feitos por telefone, com uma interface amigável e funcionalidades completas para cadastro de usuários, produtos e controle de pedidos.

## Funcionalidades

- Sistema de login e autenticação de usuários
- Cadastro de novos usuários
- Gerenciamento de produtos
- Registro e acompanhamento de pedidos
- Histórico de pedidos por cliente
- Interface responsiva e amigável

## Requisitos

- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Servidor web (Apache, Nginx, etc.)
- XAMPP, WAMP, LAMP ou similar (para ambiente de desenvolvimento)

## Instalação

1. Clone ou baixe este repositório para a pasta do seu servidor web (ex: htdocs no XAMPP)
2. Crie um banco de dados MySQL para o sistema
3. Importe o arquivo SQL fornecido abaixo para criar as tabelas necessárias
4. Configure o arquivo `config.php` com as credenciais do seu banco de dados
5. Acesse o sistema pelo navegador (ex: http://localhost/Sistema-de-Pedidos-Por-Telefone-em-PHP/)

## Configuração do Banco de Dados

Crie um arquivo `config.php` na raiz do projeto com o seguinte conteúdo:

```php
<?php
$host = "localhost"; // ou o endereço do seu servidor MySQL
$dbname = "sistema_pedidos";
$username = "root"; // ou seu usuário MySQL
$password = ""; // sua senha MySQL

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
    exit();
}
?>
```

## Estrutura do Banco de Dados (SQL)

Copie e execute o seguinte código SQL para criar as tabelas necessárias:

```sql
-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS sistema_pedidos CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE sistema_pedidos;

-- Tabela de usuários
CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    s_nome_usuario VARCHAR(100) NOT NULL,
    s_email_usuario VARCHAR(100) NOT NULL UNIQUE,
    s_senha_usuario VARCHAR(255) NOT NULL,
    dt_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP,
    b_ativo BOOLEAN DEFAULT TRUE
);

-- Tabela de clientes
CREATE TABLE IF NOT EXISTS clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    s_nome_cliente VARCHAR(100) NOT NULL,
    s_telefone VARCHAR(20) NOT NULL,
    s_endereco TEXT,
    dt_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de categorias de produtos
CREATE TABLE IF NOT EXISTS categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    s_nome_categoria VARCHAR(50) NOT NULL,
    s_descricao TEXT
);

-- Tabela de produtos
CREATE TABLE IF NOT EXISTS produtos (
    id_produto INT AUTO_INCREMENT PRIMARY KEY,
    id_categoria INT,
    s_nome_produto VARCHAR(100) NOT NULL,
    s_descricao TEXT,
    f_preco DECIMAL(10,2) NOT NULL,
    b_disponivel BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria)
);

-- Tabela de pedidos
CREATE TABLE IF NOT EXISTS pedidos (
    id_pedido INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT,
    id_usuario INT,
    dt_pedido DATETIME DEFAULT CURRENT_TIMESTAMP,
    f_valor_total DECIMAL(10,2) NOT NULL,
    s_status VARCHAR(20) DEFAULT 'pendente',
    s_observacoes TEXT,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

-- Tabela de itens do pedido
CREATE TABLE IF NOT EXISTS itens_pedido (
    id_item INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT,
    id_produto INT,
    i_quantidade INT NOT NULL,
    f_preco_unitario DECIMAL(10,2) NOT NULL,
    f_subtotal DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id_pedido),
    FOREIGN KEY (id_produto) REFERENCES produtos(id_produto)
);
```

## Como Usar

### Cadastro de Usuário

1. Acesse a página inicial do sistema
2. Clique em "Cadastre-se" para criar uma nova conta
3. Preencha o formulário com seus dados pessoais
4. Clique em "Cadastrar" para finalizar

### Login no Sistema

1. Acesse a página inicial do sistema
2. Digite seu e-mail e senha
3. Clique em "Entrar"

### Registrando um Pedido

1. Após fazer login, acesse a seção de "Novo Pedido"
2. Selecione o cliente ou cadastre um novo
3. Adicione os produtos desejados ao pedido
4. Informe a quantidade de cada produto
5. Adicione observações se necessário
6. Finalize o pedido

### Acompanhamento de Pedidos

1. Acesse a seção "Pedidos" no menu principal
2. Visualize todos os pedidos em andamento
3. Clique em um pedido para ver detalhes
4. Atualize o status do pedido conforme necessário

## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou enviar pull requests com melhorias para o sistema.

## Licença

Este projeto está licenciado sob a licença MIT - veja o arquivo LICENSE para mais detalhes.