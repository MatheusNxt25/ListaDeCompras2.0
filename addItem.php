<?php
    include_once('conexao.php');

    class Produto {
        public $id;
        public $nome;
    }

    if(!empty($_GET['id'])){

        $id = $_GET['id'];
        $nomeLista = $_GET['nomeLista'];

    } elseif (isset($_POST['submit']))
    {

        $id_lista = $_POST['id_lista'];
        $produto = $_POST['produto'];
        $quantidade = $_POST['quantidade'];
        $nomeLista = $_POST['nomeLista'];

        $sql = "INSERT INTO ItensPorLista(idProduto, idLista, quantidade) VALUES (?, ?, ?)";
        $sth = $conn->prepare($sql);
        $sth->bindParam(1,$produto);
        $sth->bindParam(2,$id_lista);
        $sth->bindParam(3,$quantidade);
        try {
            $sth->execute();
        } catch (\Throwable $th) {
            print $th;
        }
       
    
        header("Location: addItem.php?id={$id_lista}&nomeLista={$nomeLista}");
        
    } else {
        header("Location: listas.php");
    }


    $sql = "SELECT id, nome FROM Produtos ORDER BY nome ASC";

    $sth = $conn->prepare($sql);
    $sth->execute();
    $Produtos = $sth->fetchAll(PDO::FETCH_CLASS, "Produto");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Item Por Lista</title>
    <link rel="stylesheet" href="style.css">
    <script>
        window.onload =  function(){
            <?php 
                if(isset($resposta))
                {
                    echo "alert('{$resposta}')";
                }
            ?>
        }
    </script>
</head>
<body class="body">
    <a href="sistema.php?id=<?php echo "{$id}" ?>" class="Voltar">Voltar</a>
    <div class="box">
        <form action="addItem.php" method="post">
            <input type="hidden" name="id_lista" value='<?php echo "{$id}" ?>'>
            <input type="hidden" name="nomeLista" value='<?php echo "{$nomeLista}" ?>'>
            <fieldset class="fieldset">
                <legend class="legend"><b>Add Item para lista <?php echo "{$nomeLista}" ?></b></legend>
                <br>

                <div class="inputBox">
                <select name="produto" id="produto" class="inputList" required>
                            <option selected></option>
                            <?php
                    
                                foreach ($Produtos as $produto) {
                                    echo "<option value='{$produto->id}'>{$produto->nome}</option>";
                                }

                            ?>
                </select>
                <label for="produto" class="labelInput" >Nome do Produto</label>
                </div>
                <br>
                <br>
                <div class="inputBox">
                    <input type="Number" name="quantidade" id="quantidade" class="inputList" required>
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