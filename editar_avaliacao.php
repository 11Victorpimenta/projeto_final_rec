<?php
include 'php/conexao.php';

$idAvaliacao = isset($_GET['id_avaliacao']) ? (int) $_GET['id_avaliacao'] : 0;
$avaliacao = null;

if ($idAvaliacao > 0) {
    $sql = "SELECT a.id_avaliacao, a.nota, a.comentario, p.nome, p.descricao, p.imagem_referencia
            FROM avaliacoes AS a
            JOIN produtos AS p ON a.id_produto = p.id_produto
            WHERE a.id_avaliacao = $idAvaliacao AND a.status = 'ativa' LIMIT 1";
    $resultado = $conexao->query($sql);
    $avaliacao = $resultado ? $resultado->fetch_assoc() : null;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Edite a avaliação selecionada no Sistema de Avaliação de Produtos.">
    <title>Editar Avaliação — Sistema de Avaliação de Produtos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header class="topo">
        <div class="container topo-conteudo">
            <div class="marca">
                <div class="icone-marca">★</div>
                <div>
                    <h1>Sistema de Avaliação de Produtos</h1>
                    <p>Edite a avaliação selecionada.</p>
                </div>
            </div>
            <a class="botao-topo" href="gerenciar_avaliacoes.php">
                ← Voltar para avaliações
            </a>
        </div>
    </header>

    <main class="container pagina-avaliacao">

        <?php if ($avaliacao): ?>
            <section class="caixa-avaliacao">

                <p class="titulo-form">✏️ Editar avaliação</p>

                <div class="info-produto">
                    <img
                        src="<?php echo htmlspecialchars($avaliacao['imagem_referencia']); ?>"
                        alt="Imagem do produto <?php echo htmlspecialchars($avaliacao['nome']); ?>"
                        class="produto-imagem"
                    >
                    <div>
                        <h2><?php echo htmlspecialchars($avaliacao['nome']); ?></h2>
                        <p><?php echo htmlspecialchars($avaliacao['descricao']); ?></p>
                    </div>
                </div>

                <form class="avaliacao-form" action="php/atualizar_avaliacao.php" method="post">
                    <input type="hidden" name="id_avaliacao" value="<?php echo (int) $avaliacao['id_avaliacao']; ?>">
                    <input type="hidden" name="nota" id="nota" value="<?php echo (int) $avaliacao['nota']; ?>">

                    <div>
                        <label>Nota</label>
                        <div class="avaliacao-estrelas">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <button type="button" class="estrela-botao" data-value="<?php echo $i; ?>">★</button>
                            <?php endfor; ?>
                        </div>
                    </div>

                    <div>
                        <label for="comentario">Comentário <span style="color:#c44">*</span></label>
                        <textarea id="comentario" name="comentario" rows="5"><?php echo htmlspecialchars($avaliacao['comentario']); ?></textarea>
                    </div>

                    <div class="erro-avaliacao" aria-live="polite"></div>

                    <div class="grupo-botoes">
                        <button type="submit" class="botao-avaliar">Salvar alteração ➔</button>
                        <a class="botao-avaliar botao-secundario" href="gerenciar_avaliacoes.php">← Cancelar</a>
                    </div>
                </form>

            </section>
        <?php else: ?>
            <div class="caixa-aviso">
                <h2>Avaliação não encontrada.</h2>
                <p>Verifique o ID da avaliação e tente novamente.</p>
                <a href="gerenciar_avaliacoes.php" class="botao-avaliar">← Voltar para avaliações</a>
            </div>
        <?php endif; ?>

    </main>

    <script src="js/script.js"></script>
</body>
</html>
<?php $conexao->close(); ?>
