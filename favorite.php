<?php
        $host = "localhost";
        $db_user = "root";
        $db_password = "senai";
        $db_name = "pingpong";

        $conn = new mysqli($host, $db_user, $db_password, $db_name);

        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }

        $id = $_GET['id'];
        $action = $_GET['action'];
        if ($id && $action) {
            $favorite = ($action === 'add') ? 1 : 0;
            $sql = "UPDATE historico SET favorite = $favorite WHERE id = $id";
            if ($conn->query($sql) === TRUE) {
                echo "Favorito atualizado com sucesso";
            } else {
                echo "Erro ao atualizar favorito: " . $conn->error;
            }
        }

        $conn->close();
    ?>