<?php
if(isset($_GET['id']) && !empty($_GET['id'])){
    include 'conexao.php';

    $id = intval($_GET['id']);
    $query = 'DELETE FROM historico WHERE id=' . $id;
    $result = mysqli_query($conn, $query);

    if($result){
        header('Location: ping-pong.php?mensagem=Registro deletado com sucesso!');
        exit;
    } else {
        header('Location: ping-pong.php?mensagem=Erro ao excluir registro!');
        exit();
    }
} 
    exit();
    
 ?>
