<?php
session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {

    header('Location: login.php');

    exit;
}


$comprasDoUsuario = [];

$caminhoVendas = '../data/vendas.json';

if (file_exists($caminhoVendas)) {

    $todasVendas = json_decode(file_get_contents($caminhoVendas), true);
    $idDoUsuario = $_SESSION['id'];


    $comprasDoUsuario = array_filter($todasVendas, function ($venda) use ($idDoUsuario) {
        return isset($venda['usuario_id']) && $venda['usuario_id'] == $idDoUsuario;
    });
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>R&R Veículos</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <header>
        <div class="cabecalho" id="cabecalho">
            <div id="logo" class="logo">
                <img src="..\data\img\banner\cabecalho.png" alt="cabecalho">

            </div>
            <div class="banner" id="banner">

            </div>


        </div>

    </header>

    <nav class="menu">


        <ul>
            <li>
                <a href="../index.php">Home</a>
            </li>
            <li>
                <a href="cadastro.php">Cadastro</a>
            </li>
            <li>
                <a href="perfil.php">Perfil</a>
            </li>
            <li class="dropdown">
                <a href="">Login</a>
                <div class="dropdown-menu">
                    <a href="login.php">Entrar</a>
                    <a href="logout.php">Sair</a>
                </div>
            </li>

        </ul>

    </nav>



    <div class='container-foto-logado'>

        <?php

        if (isset($_SESSION['logado']) && $_SESSION['logado'] === true):

            $primeiroNome = explode(' ', $_SESSION['nome'])[0];


            $foto = $_SESSION['foto'] ?? '';
            $fotoPadrao = 'data/img/img_perfil/perfil_exemplo.png';
            $fotoCaminho = !empty($foto) ? $foto : $fotoPadrao;


            if (strpos($_SERVER['SCRIPT_FILENAME'], '/html/') !== false) {

                $fotoCaminho = '../' . ltrim($fotoCaminho, '/');
            } else {

                $fotoCaminho = ltrim($fotoCaminho, './');
            }


            if (strpos($_SERVER['SCRIPT_FILENAME'], '/html/') !== false) {
                $perfilLink = 'perfil.php';
            } else {
                $perfilLink = 'html/perfil.php';
            }

        ?>

            <a href="<?php echo $perfilLink; ?>" class="link-usuario-logado">
                <img src="<?php echo $fotoCaminho; ?>" alt="Foto" class="foto-menu-logado">
                <span>Olá, <?php echo htmlspecialchars($primeiroNome); ?>!</span>
            </a>

        <?php endif; ?>



    </div>


    <div class="perfil-dados">

        <div class="info-usuario">
            <h3>Seus Dados</h3>
            <div>
                <label>Nome:</label>
                <p><?php echo htmlspecialchars($_SESSION['nome']); ?></p>
            </div>
            <div>
                <label>CPF:</label>
                <p><?php echo htmlspecialchars($_SESSION['cpf']); ?></p>
            </div>
            <div>
                <label>RG:</label>
                <p><?php echo htmlspecialchars($_SESSION['rg']); ?></p>
            </div>
            <div>
                <label>Data de Nasc:</label>
                <p><?php echo htmlspecialchars($_SESSION['data']); ?></p>
            </div>
            <div>
                <label>Endereço:</label>
                <p><?php echo htmlspecialchars($_SESSION['endereco']); ?></p>
            </div>
            <div>
                <label>Número:</label>
                <p><?php echo htmlspecialchars($_SESSION['numero']); ?></p>
            </div>
            <div>
                <label>Cep:</label>
                <p><?php echo htmlspecialchars($_SESSION['cep']); ?></p>
            </div>
            <div>
                <label>Cidade:</label>
                <p><?php echo htmlspecialchars($_SESSION['cidade']); ?></p>
            </div>
            <div>
                <label>Estado:</label>
                <p><?php echo htmlspecialchars($_SESSION['estado']); ?></p>
            </div>
            <div>
                <label>Telefone:</label>
                <p><?php echo htmlspecialchars($_SESSION['telefone']); ?></p>
            </div>
            <div>
                <label>Celular:</label>
                <p><?php echo htmlspecialchars($_SESSION['celular']); ?></p>
            </div>
            <div>
                <label>Email:</label>
                <p><?php echo htmlspecialchars($_SESSION['email']); ?></p>
            </div>
        </div>

        <div class="ultimas-compras">
            <h3>ÚLTIMAS COMPRAS</h3>

            <?php if (empty($comprasDoUsuario)): ?>
                <p class="nenhuma-compra">Você ainda não fez nenhuma compra.</p>
            <?php else: ?>
                <?php foreach (array_reverse($comprasDoUsuario) as $compra): // array_reverse para mostrar as mais novas primeiro 
                ?>
                    <div class="compra-item">
                        <p><strong>Data:</strong> <?php echo date("d/m/Y", strtotime($compra['data'])); ?></p>
                        <p><strong>Produto:</strong> <?php echo htmlspecialchars($compra['produto']); ?></p>
                        <p><strong>Valor:</strong> R$ <?php echo number_format($compra['preco'], 2, ',', '.'); ?></p>
                        <p><strong>Pagamento:</strong> <?php echo htmlspecialchars($compra['metodo_pagamento']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>


    <footer class="rodape">
        <div class="container">
            <div class="info-empresa">
                <h3>R&R Veículos</h3>
                <p>Endereço: Rua Exemplo, 123</p>
                <p>Telefone: (11) 9999-9999</p>
                <p>Email: contato@empresa.com</p>
            </div>

            <div class="links-uteis">
                <h4>Links Rápidos</h4>
                <ul>
                    <li><a href="/sobre">Sobre Nós</a></li>
                    <li><a href="/contato">Contato</a></li>
                    <li><a href="/privacidade">Política de Privacidade</a></li>
                    <li><a href="/termos">Termos de Uso</a></li>
                </ul>
            </div>
            <div class="redes-sociais">
                <h4>Siga-nos</h4>
                <a href="#"><i>Facebook</i></a>
                <a href="#"><i>Instagram</i></a>
                <a href="#"><i>LinkedIn</i></a>
            </div>
            <div class="copyright">
                <p>&copy; 2025 R&R Veículos. Todos os direitos reservados.</p>
            </div>

        </div>







    </footer>
    <script src="script.js"></script>
</body>

</html>