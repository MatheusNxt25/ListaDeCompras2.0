<?php

    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '1234';
    $dbName = 'listadeprodutos';


    try {
        $conn = new PDO('mysql:host=' . $dbHost . ';dbname=' . $dbName, $dbUsername, $dbPassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = '
            CREATE TABLE IF NOT EXISTS Produtos (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nome VARCHAR(255) NOT NULL UNIQUE
            ) ENGINE = innodb;
            CREATE TABLE IF NOT EXISTS Listas (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nome VARCHAR(255) NOT NULL
            ) ENGINE = innodb;
            CREATE TABLE IF NOT EXISTS ItensPorLista (
                id INT AUTO_INCREMENT PRIMARY KEY,
                idProduto INT,
                idLista INT,
                quantidade INTEGER NOT NULL,
                FOREIGN KEY (idProduto)
                    REFERENCES Produtos (id)
                    ON DELETE CASCADE,
                FOREIGN KEY (idLista)
                    REFERENCES Listas (id)
                    ON DELETE CASCADE,
                CONSTRAINT UK_Produto_Lista UNIQUE (idProduto,idLista)
            ) ENGINE = innodb;
        ';

        $result = $conn->exec($sql);

        
    } catch (\Throwable $th) {
        echo "Erro: " . $th;
    }


?>