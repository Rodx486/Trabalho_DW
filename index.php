<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>R&R Veículos</title>
    <link rel="stylesheet" href="html\estilos.css">

</head>

<body>
    <header>
        <div class="cabecalho" id="cabecalho">
            <div id="logo" class="logo">
                <img src="data\img\banner\cabecalho.png" alt="cabecalho">

            </div>
            <div class="banner" id="banner">

            </div>


        </div>

    </header>

    <nav class="menu">


        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>
                <a href="html\cadastro.php">Cadastro</a>
            </li>
            <li>
                <a href="html\perfil.php">Perfil</a>
            </li>
            <li class="dropdown">
                <a href="">Login</a>
                <div class="dropdown-menu">
                    <a href="html/login.php">Entrar</a>
                    <a href="html/logout.php">Sair</a>
                </div>
            </li>
            <li>
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








    <div id="main-produtos" class="conteudo-principal">



    </div>

    <div class="btn-produto">

        <a href="" id="btnAnterior" class="btn-anterior">ANTERIOR</a>
        <a href="" id="btnProximo" class="btn-proximo">PROXIMO</a>
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

    <script src="html/script.js"></script>
    <!-- <script src="html/carrega_produtos_fetch.js"></script> -->
    <script src="html/carrega_produtos_api.js"></script>
</body>

</html>