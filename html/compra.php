<?php
session_start();

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

    <div class="conteudo-principal-compra">
        <div class="foto-compra">
            <img src="" alt="produto-foto">
        </div>

        <div class="detalhe-venda">
            <div>
                <label>Nome:</label>
                <input type="text" id="nome-compra" nome="nome-compra">
            </div>

            <div>
                <label>Preço:</label>
                <input type="text" id="preco-compra" nome="preco-compra">
            </div>

            <div>
                <label>Método de Pagamento:</label>
             

                <select id="mtd-pagamento" name="mtd-pagamento" class="select-pagamento">
                    <option value="">-- Selecione método de compra --</option>
                    <option value="AC">PIX</option>
                    <option value="AL">CARTÃO</option>
                    <option value="AP">BOLETO BANCÁRIO</option>
                </select>
            </div>

            <div>
                <label>Endereço de entrega:</label>
                <input type="text" id="endereco-compra" nome="endereco-compra">
            </div>

            <form class="finaliza-venda" action="vendas.php" method="POST">

             <div class="btn-produto">


                <button type="submit" class="botao-finalizar" id='botao-finalizar'>FINALIZAR COMPRA</button>
                <button type='button'class= "botao-detalhe" id='botao-detalhe'>VOLTAR</button>


            </div>


            </form>
            
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
    <script src='script.js'></script>
</body>

</html>