<?php
require_once 'php/conexao.php';

$sql = "SELECT 
            p.id_produto,
            p.nome,
            p.descricao,
            p.imagem_referencia,
            COALESCE(AVG(a.nota), 0) AS media_nota,
            COUNT(a.id_avaliacao) AS total_avaliacoes
        FROM produtos p
        LEFT JOIN avaliacoes a 
            ON p.id_produto = a.id_produto 
            AND a.status = 'ativa'
        WHERE p.ativo = 1
        GROUP BY p.id_produto, p.nome, p.descricao, p.imagem_referencia
        ORDER BY p.id_produto DESC";

$resultado = $conexao->query($sql);

$totalProdutosSql = "SELECT COUNT(*) AS total FROM produtos WHERE ativo = 1";
$totalProdutos = $conexao->query($totalProdutosSql)->fetch_assoc()['total'];

$totalAvaliacoesSql = "SELECT COUNT(*) AS total FROM avaliacoes WHERE status = 'ativa'";
$totalAvaliacoes = $conexao->query($totalAvaliacoesSql)->fetch_assoc()['total'];

$mediaGeralSql = "SELECT COALESCE(AVG(nota), 0) AS media FROM avaliacoes WHERE status = 'ativa'";
$mediaGeral = $conexao->query($mediaGeralSql)->fetch_assoc()['media'];

$produtosBemAvaliadosSql = "SELECT COUNT(*) AS total
                            FROM (
                                SELECT id_produto, AVG(nota) AS media
                                FROM avaliacoes
                                WHERE status = 'ativa'
                                GROUP BY id_produto
                                HAVING media >= 4
                            ) AS produtos_bons";
$produtosBemAvaliados = $conexao->query($produtosBemAvaliadosSql)->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos — Sistema de Avaliação de Produtos</title>
    <link rel="stylesheet" href="css/style.css">

    <style>
        .cards-resumo {
            display: grid !important;
            grid-template-columns: repeat(4, 1fr) !important;
            gap: 22px !important;
            margin: 0 0 30px !important;
        }

        .card-resumo {
            background: #ffffff !important;
            border-radius: 18px !important;
            padding: 22px !important;
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.08) !important;
            display: flex !important;
            align-items: center !important;
            gap: 16px !important;
            border: 1px solid #eeeeee !important;
        }

        .card-resumo-icone {
            width: 56px !important;
            height: 56px !important;
            min-width: 56px !important;
            border-radius: 16px !important;
            background: linear-gradient(135deg, #ff5a1f, #ff8a00) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 26px !important;
        }

        .card-resumo-icone.roxo {
            background: linear-gradient(135deg, #6c5ce7, #8e7cff) !important;
        }

        .card-resumo-icone.amarelo {
            background: linear-gradient(135deg, #ffc107, #ff9800) !important;
        }

        .card-resumo-icone.verde {
            background: linear-gradient(135deg, #22c55e, #16a34a) !important;
        }

        .card-resumo-info span {
            display: block !important;
            font-size: 0.82rem !important;
            font-weight: 700 !important;
            color: #555 !important;
            margin-bottom: 4px !important;
        }

        .card-resumo-info strong {
            display: block !important;
            font-size: 2rem !important;
            font-weight: 900 !important;
            color: #111827 !important;
            line-height: 1 !important;
        }

        .card-resumo-info p {
            font-size: 0.82rem !important;
            color: #777 !important;
            margin-top: 4px !important;
        }

        @media (max-width: 900px) {
            .cards-resumo {
                grid-template-columns: repeat(2, 1fr) !important;
            }
        }

        @media (max-width: 500px) {
            .cards-resumo {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
</head>
<body>

<header class="topo">
    <div class="container topo-conteudo">
        <div class="marca">
            <div class="icone-marca">★</div>
            <div>
                <h1>Sistema de Avaliação de Produtos</h1>
                <p>Escolha um produto para acessar a página de avaliação.</p>
            </div>
        </div>

        <a class="botao-topo" href="gerenciar_avaliacoes.php">
            ☰ Ver avaliações realizadas
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
            <div class="icone-secao">★</div>

            <div class="texto-secao">
                <h2>Produtos disponíveis para avaliação</h2>
                <p>
                    <?php echo $totalProdutos; ?> produtos cadastrados |
                    <?php echo $totalAvaliacoes; ?> avaliações realizadas
                </p>
            </div>

            <a class="botao-avaliacoes" href="gerenciar_avaliacoes.php">
                ☰ Ver avaliações realizadas
            </a>
        </div>
    </section>

    <section class="cards-resumo">
        <div class="card-resumo">
            <div class="card-resumo-icone">📦</div>
            <div class="card-resumo-info">
                <span>Produtos cadastrados</span>
                <strong><?php echo $totalProdutos; ?></strong>
                <p>ativos no sistema</p>
            </div>
        </div>

        <div class="card-resumo">
            <div class="card-resumo-icone roxo">💬</div>
            <div class="card-resumo-info">
                <span>Avaliações realizadas</span>
                <strong><?php echo $totalAvaliacoes; ?></strong>
                <p>no total</p>
            </div>
        </div>

        <div class="card-resumo">
            <div class="card-resumo-icone amarelo">⭐</div>
            <div class="card-resumo-info">
                <span>Média geral</span>
                <strong><?php echo number_format($mediaGeral, 1, ',', '.'); ?></strong>
                <p>de avaliações</p>
            </div>
        </div>

        <div class="card-resumo">
            <div class="card-resumo-icone verde">📈</div>
            <div class="card-resumo-info">
                <span>Bem avaliados</span>
                <strong><?php echo $produtosBemAvaliados; ?></strong>
                <p>acima de 4 estrelas</p>
            </div>
        </div>
    </section>

    <div class="barra-pesquisa">
        <input type="text" id="pesquisarProduto" placeholder="🔍 Pesquisar produto pelo nome ou descrição...">
    </div>

    <section class="grade-produtos">
        <?php if ($resultado && $resultado->num_rows > 0): ?>
            <?php while ($produto = $resultado->fetch_assoc()): ?>

                <article class="card-produto">
                    <img
                        src="<?php echo htmlspecialchars($produto['imagem_referencia']); ?>"
                        alt="Imagem do produto <?php echo htmlspecialchars($produto['nome']); ?>"
                        class="produto-imagem"
                    >

                    <div class="card-conteudo">
                        <h3><?php echo htmlspecialchars($produto['nome']); ?></h3>

                        <div class="produto-nota">
                            <?php
                            $media = round($produto['media_nota']);

                            for ($i = 1; $i <= 5; $i++):
                            ?>
                                <span class="estrela <?php echo $i <= $media ? 'ativa' : ''; ?>">★</span>
                            <?php endfor; ?>

                            <span class="texto-nota">
                                <?php echo number_format($produto['media_nota'], 1, ',', '.'); ?>/5
                            </span>
                        </div>

                        <small class="total-avaliacoes">
                            <?php echo $produto['total_avaliacoes']; ?> avaliações
                        </small>

                        <p><?php echo htmlspecialchars($produto['descricao']); ?></p>

                        <a class="botao-avaliar" href="avaliar.php?id_produto=<?php echo (int) $produto['id_produto']; ?>">
                            ⭐ Avaliar produto
                        </a>
                    </div>
                </article>

            <?php endwhile; ?>
        <?php else: ?>
            <p class="mensagem-vazia">Nenhum produto ativo encontrado no momento.</p>
        <?php endif; ?>
    </section>

</main>

<footer>
    Sistema de Avaliação de Produtos<br>
    Desenvolvido por Victor Hugo Pimenta © 2026
</footer>

<script src="js/script.js"></script>
</body>
</html>
<?php $conexao->close(); ?>