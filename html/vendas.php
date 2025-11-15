<?php
session_start();

if(!isset($_SESSION['logado']) || $_SESSION['logado'] !== true || !isset($_SESSION['id'])){

    header('Location: login.php');
    exit;


}


if($_SERVER['REQUEST_METHOD'] == 'POST'){


    $produto_id = $_POST['produto_id'] ?? null;
    $produto_nome = $_POST['produto_nome'] ?? 'Produto não espefificado';
    $produto_preco = (float) ($_POST['produto_preco'] ?? 0);
    $metodo_pagamento = $_POST['mtd-pagamento'] ?? null;

    $usuario_id = $_SESSION['id'];


    if(empty($produto_id) || empty($metodo_pagamento) || $produto_preco <=0){

        echo "<script>
                alert('Erro ao processar a compra. Tente novamente.');
                window.location.href = '../index.php';
              </script>";
        exit;

    }


    $file = '../data/vendas.json';

    $vendas = [];


    if(file_exists($file)){

        $vendas = json_decode(file_get_contents($file), true);


    }

    $ultimoID = 0;

    if(!empty($vendas)){

        $ultimaVenda = end($vendas);
        $ultimoID = $ultimaVenda['id'] ?? 0;
    }

    $novoId = $ultimoID + 1;

    $novaVenda = [
        'id' => $novoId,
        'data' => date('Y-m-d'), 
        'produto_id' => $produto_id, 
        'produto' => $produto_nome,
        'preco' => $produto_preco,
        'metodo_pagamento' => $metodo_pagamento,
        'usuario_id' => $usuario_id,
        'status' => 'Concluída'
    ];


    $vendas[] = $novaVenda;

    if(file_put_contents($file , json_encode($vendas, JSON_PRETTY_PRINT))){

        echo "<script>
                alert('Compra finalizada com sucesso!');
                window.location.href = 'perfil.php';
              </script>";

    }else{

        echo "<script>
                alert('Erro ao salvar sua compra. Tente novamente.');
                window.location.href = 'compra.php?id=$produto_id';
              </script>";

    }
    exit;

}else{

    header('Location: ../index.php');


}

?>