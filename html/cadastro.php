<?php
session_start();
$message = '';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user_nome = $_POST['nome'];
    $user_foto = $_POST['foto'];
    $user_cpf = $_POST['cpf'];
    $user_rg = $_POST['rg'];
    $user_data_nasc = $_POST['data'];
    $user_endereco = $_POST['endereco'];
    $user_numero = $_POST['numero'];
    $user_cep = $_POST['cep'];
    $user_cidade = $_POST['cidade'];
    $user_estado = $_POST['estado'];
    $user_telefone = $_POST['telefone'];
    $user_celular = $_POST['celular'];
    $user_email = $_POST['email'];
    $user_senha = $_POST['senha'];


    if (
        empty($user_nome) || empty($user_cpf)
        || empty($user_rg) || empty($user_data_nasc)
        || empty($user_endereco) || empty($user_numero)
        || empty($user_cep) || empty($user_cidade)
        || empty($user_estado) || empty($user_telefone)
        || empty($user_celular) || empty($user_email)
        || empty($user_senha || empty($user_foto))
    ) {



        echo "<script>alert('Por favor, preencha todos os campos.');</script>";
    } else {

        $file = '../data/usuarios.json';
        $users = [];

        if (file_exists($file)) {

            $users = json_decode(file_get_contents($file), true);
        }

        $userExiste = false;


        foreach ($users as $usuario) {

            if ($usuario['email'] === $user_email) {

                $userExiste = true;

                break;
            }
        }

        if ($userExiste) {


            echo "<script>alert('Este e-mail já está cadastrado.');</script>";
        } else {

            $ultimoUsuario = end($users);
            $novoId = $ultimoUsuario ? $ultimoUsuario['id'] + 1 : 1;

            $users[] = [

                'nome' => $user_nome,
                'cpf' => $user_cpf,
                'rg' => $user_rg,
                'data' => $user_data_nasc,
                'endereco' => $user_endereco,
                'numero' => $user_numero,
                'cep' => $user_cep,
                'cidade' => $user_cidade,
                'estado' => $user_estado,
                'telefone' => $user_telefone,
                'celular' => $user_celular,
                'email' => $user_email,
                'senha' => $user_senha,
                'id' => $novoId

            ];

            file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));



            echo "<script>alert('Registro bem-sucedido!! Você pode fazer login agora.');</script>";
            header('Refresh: 2; URL=login.php');
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

        <form action="cadastro.php" class="formulario" method="POST" enctype="multipart/form-data">

            <?php if ($message): ?>
                <p><?php echo $message; ?></p>
            <?php endif; ?>

            <div class="form-group" id="campo-foto">
                <img class="foto-perfil" id="fotoPerfil" src="\Trabalho_DW\data\img\img_perfil\perfil_exemplo.png"
                    alt="Foto_perfil">
                <input type="file" id="input-foto" accept="image/*" name="foto_upload">
            </div>

            <div class="form-group" id="campo-nome">
                <label for="nome">NOME</label>
                <input type="text" id="nome" placeholder="Seu nome" name="nome">
            </div>
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" id="cpf" placeholder="000.000.000-00" maxlength="14" name="cpf">
            </div>
            <div class="form-group">
                <label for="rg">RG</label>
                <input type="text" id="rg" placeholder="Seu RG" name="rg">
            </div>

            <div class="form-group">
                <label for="data">Data de Nasc</label>
                <input type="date" id="data" name="data">
            </div>

            <div class="form-group" id="campo-endereco">
                <label for="endereco">ENDEREÇO</label>
                <input type="text" id="endereco" name="endereco" placeholder="Seu endereço">
            </div>

            <div class="form-group">
                <label for="numero">NÚMERO</label>
                <input type="number" id="numero" name="numero" placeholder="Seu número">
            </div>

            <div class="form-group">
                <label for="cep">CEP</label>
                <input type="text" id="cep" name="cep" maxlength="9" placeholder="00000-000">
            </div>
            <div class="form-group">
                <label for="cidade">CIDADE</label>
                <input type="text" id="cidade" name="cidade" placeholder="Sua cidade">
            </div>
            <div class="form-group">
                <label for="estado">ESTADO</label>
                <select id="estado" name="estado" class="estado-select">
                    <option value="">-- Selecione um estado --</option>
                    <option value="AC">Acre (AC)</option>
                    <option value="AL">Alagoas (AL)</option>
                    <option value="AP">Amapá (AP)</option>
                    <option value="AM">Amazonas (AM)</option>
                    <option value="BA">Bahia (BA)</option>
                    <option value="CE">Ceará (CE)</option>
                    <option value="DF">Distrito Federal (DF)</option>
                    <option value="ES">Espírito Santo (ES)</option>
                    <option value="GO">Goiás (GO)</option>
                    <option value="MA">Maranhão (MA)</option>
                    <option value="MT">Mato Grosso (MT)</option>
                    <option value="MS">Mato Grosso do Sul (MS)</option>
                    <option value="MG">Minas Gerais (MG)</option>
                    <option value="PA">Pará (PA)</option>
                    <option value="PB">Paraíba (PB)</option>
                    <option value="PR">Paraná (PR)</option>
                    <option value="PE">Pernambuco (PE)</option>
                    <option value="PI">Piauí (PI)</option>
                    <option value="RJ">Rio de Janeiro (RJ)</option>
                    <option value="RN">Rio Grande do Norte (RN)</option>
                    <option value="RS">Rio Grande do Sul (RS)</option>
                    <option value="RO">Rondônia (RO)</option>
                    <option value="RR">Roraima (RR)</option>
                    <option value="SC">Santa Catarina (SC)</option>
                    <option value="SP">São Paulo (SP)</option>
                    <option value="SE">Sergipe (SE)</option>
                    <option value="TO">Tocantins (TO)</option>
                </select>

            </div>

            <div class="form-group">
                <label for="telefone">TELEFONE</label>
                <input type="tel" id="telefone" name="telefone" placeholder="(00) 00000-0000">
            </div>
            <div class="form-group">
                <label for="celular">CELULAR</label>
                <input type="tel" id="celular" name="celular" placeholder="(00) 00000-0000">
            </div>
            <div class="form-group" id="campo-email">
                <label for="email">EMAIL</label>
                <input type="email" id="email" name="email" placeholder="email@exemplo.com">
            </div>
            <div class="form-group" id="campo-senha">
                <label for="senha">SENHA</label>
                <input type="password" id="senha" name="senha" placeholder="Senha">
            </div>
            <div class="btn-cadastro">
                <button type="submit" id="cadastrar">CADASTRAR</button>
                <button type="button" id="voltar">VOLTAR</button>
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
</body>

</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var btn = document.getElementById('voltar');
        if (btn) {
            btn.addEventListener('click', function() {
                if (history.length > 1) {
                    history.back();
                } else {
        
                    window.location.href = '../index.php';
                }
            });
        }
    });
</script>
<script src="script.js"></script>
</body>

</html>