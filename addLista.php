<?php

    include_once("conexao.php");


    if(isset($_POST['submit']))
    {

        $nomeLista = $_POST['nome'];
        $sql = "INSERT INTO Listas(nome) VALUES ('{$nomeLista}')";
        $sth = $conn->query($sql);
        $id = $conn->lastInsertId();
        header("Location: sistema.php?id={$id}");
        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Lista</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="body">
    <a href="listas.php" class="Voltar">Voltar</a>
    <div class="box">
        <form action="addLista.php" method="post">
            <fieldset class="fieldset">
                <legend class="legend"><b>Nova Lista</b></legend>
                <br>

                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputList" required>
                    <label for="nome" class="labelInput" >Nome da Lista</label>
                </div>
                <br>
                <br>
                <input type="submit" name="submit" id="submit">
            </fieldset>
        </form>
    </div>
</body>
</html>