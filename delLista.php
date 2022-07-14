<?php
    include_once('conexao.php');

    if(!empty($_GET['id'])){

        $id = $_GET['id'];

        $sql = "
            DELETE FROM Listas WHERE id= ?
        ";
        $sth = $conn->prepare($sql);
        $sth->bindParam(1, $id);
        $sth->execute();

        header("Location: listas.php");

    } else {
        header("Location: listas.php");
    }
    
?>