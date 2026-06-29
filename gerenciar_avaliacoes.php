<?php
include 'php/conexao.php';

$sql = "SELECT 
            a.id_avaliacao, 
            a.nota, 
            a.comentario, 
            a.data_avaliacao, 
            p.nome AS produto_nome,
            p.imagem_referencia
        FROM avaliacoes AS a
        JOIN produtos AS p ON a.id_produto = p.id_produto
        WHERE a.status = 'ativa'
        ORDER BY a.data_avaliacao DESC";

$resultado = $conexao->query($sql);

$totalAvaliacoesSql = "SELECT COUNT(*) AS total FROM avaliacoes WHERE status = 'ativa'";
$totalAvaliacoes = $conexao->query($totalAvaliacoesSql)->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Avaliações — Sistema de Avaliação de Produtos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="topo">
    <div class="container topo-conteudo">
        <div class="marca">
            <div class="icone-marca">★</div>
            <div>
                <h1>Sistema de Avaliação de Produtos</h1>
                <p>Gerencie as avaliações registradas.</p>
            </div>
        </div>

        <a class="botao-topo" href="produtos.php">
            ← Voltar para produtos
        </a>
    </div>
</header>

<main class="container">

    <?php if (isset($_GET['sucesso'])): ?>
        <div class="mensagem-sucesso">
            ✔ Operação realizada com sucesso!
        </div>
    <?php endif; ?>

    <section class="secao-titulo">
        <div class="destaque-secao">
            <div class="icone-secao">☰</div>

            <div class="texto-secao">
                <h2>Avaliações realizadas</h2>
                <p><?php echo $totalAvaliacoes; ?> avaliações ativas cadastradas no sistema.</p>
            </div>

            <a class="botao-avaliacoes" href="produtos.php">
                + Nova avaliação
            </a>
        </div>
    </section>

    <div class="barra-pesquisa">
        <input type="text" id="pesquisarAvaliacao" placeholder="🔍 Pesquisar avaliação por produto ou comentário...">
    </div>

    <section class="secao-gerenciar">
        <?php if ($resultado && $resultado->num_rows > 0): ?>
            <div class="tabela-wrapper">
                <table class="tabela-avaliacoes">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Avaliação</th>
                            <th>Comentário</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($avaliacao = $resultado->fetch_assoc()): ?>
                            <tr class="linha-avaliacao">
                                <td>
                                    <div class="produto-tabela">
                                        <img 
                                            src="<?php echo htmlspecialchars($avaliacao['imagem_referencia']); ?>" 
                                            alt="Imagem do produto <?php echo htmlspecialchars($avaliacao['produto_nome']); ?>"
                                            class="imagem-tabela"
                                        >

                                        <strong>
                                            <?php echo htmlspecialchars($avaliacao['produto_nome']); ?>
                                        </strong>
                                    </div>
                                </td>

                                <td>
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <span class="estrela <?php echo $i <= $avaliacao['nota'] ? 'ativa' : ''; ?>">★</span>
                                    <?php endfor; ?>

                                    <span class="nota-numero">
                                        <?php echo (int) $avaliacao['nota']; ?>/5
                                    </span>
                                </td>

                                <td>
                                    <?php echo nl2br(htmlspecialchars($avaliacao['comentario'])); ?>
                                </td>

                                <td>
                                    <?php echo date('d/m/Y', strtotime($avaliacao['data_avaliacao'])); ?>
                                </td>

                                <td>
                                    <div class="td-acoes">
                                        <a 
                                            class="botao-avaliar botao-pequeno" 
                                            href="editar_avaliacao.php?id_avaliacao=<?php echo (int) $avaliacao['id_avaliacao']; ?>"
                                        >
                                            ✏️ Editar
                                        </a>

                                        <form class="form-excluir-avaliacao" action="php/excluir_avaliacao.php" method="post">
                                            <input 
                                                type="hidden" 
                                                name="id_avaliacao" 
                                                value="<?php echo (int) $avaliacao['id_avaliacao']; ?>"
                                            >

                                            <button 
                                                type="submit" 
                                                class="botao-avaliar botao-excluir botao-pequeno" 
                                                onclick="return confirm('Deseja realmente excluir esta avaliação?')"
                                            >
                                                🗑 Excluir
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="mensagem-vazia">
                <p>Não há avaliações ativas no momento.</p>
            </div>
        <?php endif; ?>

        <div class="acoes-inferiores">
            <a class="botao-avaliar" href="produtos.php">← Voltar para produtos</a>
        </div>
    </section>

</main>

<script src="js/script.js"></script>
</body>
</html>
<?php $conexao->close(); ?>