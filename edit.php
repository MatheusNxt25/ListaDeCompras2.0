<?php
    include_once('conexao.php');

    class Produto {
        public $id;
        public $nome;
        public $quant;
    }

    if(!empty($_GET['id'])){

        $id = $_GET['id'];
        $nomeLista = $_GET['nomeLista'];
        $id_produto = $_GET['idProduto'];

        $sql = "
            SELECT I.id as id, P.nome as nome, I.quantidade as quant 
            FROM ItensPorLista AS I 
            INNER JOIN Produtos AS P 
            ON I.idProduto = P.id 
            WHERE I.id= ?
        ";
        $sth = $conn->prepare($sql);
        $sth->bindParam(1, $id_produto);
        $sth->execute();
        $Produtos = $sth->fetchAll(PDO::FETCH_CLASS, "Produto");
        $idProduto = $Produtos[0]->id;
        $nomeProduto = $Produtos[0]->nome;
        $quantProduto = $Produtos[0]->quant;

    } elseif (isset($_POST['submit']))
    {
        $id_lista = $_POST['id_lista'];
        $produto = $_POST['produto'];
        $quantidade = $_POST['quantidade'];

        $sql = "UPDATE ItensPorLista SET quantidade= ? WHERE id= ?";
        $sth = $conn->prepare($sql);
        $sth->bindParam(1, $quantidade);
        $sth->bindParam(2, $produto);
        $sth->execute();
    
        header("Location: sistema.php?id={$id_lista}");
        
    } else {
        header("Location: listas.php");
    }


    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editando Item</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="body">
    <a href="sistema.php?id=<?php echo "{$id}" ?>" class="Voltar">Voltar</a>
    <div class="box">
        <form action="edit.php" method="post">
            <input type="hidden" name="id_lista" value='<?php echo "{$id}" ?>'>
            <input type="hidden" name="nomeLista" value='<?php echo "{$nomeLista}" ?>'>
            <input type="hidden" name="produto" value='<?php echo "{$idProduto}" ?>'>
            
            <fieldset class="fieldset">
                <legend class="legend"><b>Editando Item da lista <?php echo "{$nomeLista}" ?></b></legend>
                <br>

                <div class="inputBox">

                <input type="text" name="produto" id="produto" class="inputList" disabled="true" value='<?php echo "{$nomeProduto}" ?>' required>
                </div>
                <br>
                <br>
                <div class="inputBox">
                    <input type="Number" name="quantidade" id="quantidade" class="inputList" value='<?php echo "{$quantProduto}" ?>' required>
                    <label for="quantidade" class="labelInput" >Unidades</label>
                </div>
                <br>
                <br>
                <input type="submit" name="submit" id="submit"  >
            </fieldset>
        </form>
    </div>
</body>
</html>