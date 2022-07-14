<?php
    include_once('conexao.php');

    if(!empty($_GET['id'])){

        $id = $_GET['id'];

        $sql = "DELETE FROM ItensPorLista WHERE id= ?";
        $sth = $conn->prepare($sql);
        $sth->bindParam(1, $id);
        $sth->execute();

        header("Location: sistema.php?id={$id}");

    } else {
        header("Location: listas.php");
    }

    
?>