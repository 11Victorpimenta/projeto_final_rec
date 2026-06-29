USE sistema_avaliacao;
CREATE TABLE IF NOT EXISTS avaliacoes (
    id_avaliacao INT AUTO_INCREMENT PRIMARY KEY,
    id_produto INT NOT NULL,
    nota INT NOT NULL,
    comentario TEXT NOT NULL,
    status VARCHAR(20) DEFAULT 'ativa',
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    atualizado_em DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_avaliacoes_produtos
        FOREIGN KEY (id_produto) REFERENCES produtos(id_produto)
);
