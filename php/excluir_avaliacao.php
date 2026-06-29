<?php
include 'conexao.php';

$id_avaliacao = isset($_POST['id_avaliacao']) ? (int) $_POST['id_avaliacao'] : 0;

if ($id_avaliacao > 0) {
    $sql = "UPDATE avaliacoes 
            SET status = 'excluida' 
            WHERE id_avaliacao = $id_avaliacao";

    if (!$conexao->query($sql)) {
        die('Erro ao excluir avaliação: ' . $conexao->error);
    }
}

header('Location: ../gerenciar_avaliacoes.php');
exit;