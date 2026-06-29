<?php
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_avaliacao = (int) $_POST['id_avaliacao'];
    $nota = (int) $_POST['nota'];
    $comentario = mysqli_real_escape_string($conexao, $_POST['comentario']);

    $sql = "UPDATE avaliacoes
            SET
                nota = $nota,
                comentario = '$comentario',
                data_avaliacao = CURRENT_TIMESTAMP
            WHERE id_avaliacao = $id_avaliacao
            AND status = 'ativa'";

    if ($conexao->query($sql)) {

        header("Location: ../gerenciar_avaliacoes.php");
        exit();

    } else {

        echo "Erro ao atualizar avaliação: " . $conexao->error;

    }
}

$conexao->close();
?>