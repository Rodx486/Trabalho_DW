<?php
session_start();

if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    header('Location: ../index.php');
    exit;
}

$message = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';


    if (empty($email) || empty($senha)) {
        echo "<script>alert('Por favor, preencha todos os campos.');</script>";
    } else {

        $file = '../data/usuarios.json';

        if (!file_exists($file)) {
            echo "<script>alert('Arquivo de usuários não encontrado.');</script>";
        } else {
            $usuarios = json_decode(file_get_contents($file), true);

            $usuarioAchado = null;


            foreach ($usuarios as $usuario) {


                if ($usuario['email'] === $email) {
                    $usuarioAchado = $usuario;
                    break;
                }
            }

            if ($usuarioAchado && $usuarioAchado['senha'] === $senha) {
                $_SESSION['logado'] = true;
                $_SESSION['id'] = $usuarioAchado['id'];
                $_SESSION['foto'] = $usuarioAchado['foto'];
                $_SESSION['nome'] = $usuarioAchado['nome'];
                $_SESSION['cpf'] = $usuarioAchado['cpf'];
                $_SESSION['rg'] = $usuarioAchado['rg'];
                $_SESSION['data'] = $usuarioAchado['data'];
                $_SESSION['endereco'] = $usuarioAchado['endereco'];
                $_SESSION['numero'] = $usuarioAchado['numero'];
                $_SESSION['cep'] = $usuarioAchado['cep'];
                $_SESSION['cidade'] = $usuarioAchado['cidade'];
                $_SESSION['estado'] = $usuarioAchado['estado'];
                $_SESSION['telefone'] = $usuarioAchado['telefone'];
                $_SESSION['celular'] = $usuarioAchado['celular'];
                $_SESSION['email'] = $usuarioAchado['email'];

                header('Location: ../index.php');
                exit;
            } else {
                echo "<script>alert('E-mail ou senha inválidos.');</script>";
            }
        }
    }
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


    <div class="form-container">
        <form action="login.php" class="formulario-login" method="POST">

            <div class="form-group">
                <label for="email">EMAIL</label>
                <input type="email" id="email" name="email" placeholder="email@exemplo.com" required>
            </div>

            <div class="form-group">
                <label for="senha">SENHA</label>
                <input type="password" id="senha" name="senha" placeholder="Senha" required>
            </div>
            <div class="btn-login">
                <button type="submit" id="cadastrar">ENTRAR</button>
            </div>

        </form>



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