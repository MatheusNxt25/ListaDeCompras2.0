<?php
    
    if(isset($_POST['submit']))
    {

        
        include_once('conexao.php');
        
        $Produto = $_POST['produto'];

        $sql = "INSERT INTO Produtos(nome) VALUES ('{$Produto}')";
        try {
            $sth = $conn->query($sql);
            $result = 'Produto cadastrado com sucesso!';
        } catch (\Throwable $th) {
            $result = 'Produto não pode ser cadastrado.';
        }
        

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produto</title>
    <link rel="stylesheet" href="style.css">
    <script>
        window.onload =  function(){
            <?php 
                if(isset($result))
                {
                    echo "alert('{$result}')";
                }
            ?>
        }
    </script>
</head>
<body class="body">
    <a href="listas.php" class="Voltar">Voltar</a>
    <div class="box">
        <form action="cadastroProduto.php" method="post">
            <fieldset class="fieldset">
                <legend class="legend"><b>Cadastro de Produto</b></legend>
                <br>

                <div class="inputBox">
                    <input type="text" name="produto" id="produto" class="inputList" required>
                    <label for="produto" class="labelInput" >Nome do Produto</label>
                </div>
                <br>
                <br>
                <input type="submit" name="submit" id="submit">
            </fieldset>
        </form>
    </div>
</body>
</html>