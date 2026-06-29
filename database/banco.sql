DROP DATABASE IF EXISTS sistema_avaliacao;

CREATE DATABASE sistema_avaliacao
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE sistema_avaliacao;

CREATE TABLE produtos (
    id_produto INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    imagem_referencia VARCHAR(500),
    ativo TINYINT DEFAULT 1,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE avaliacoes (
    id_avaliacao INT AUTO_INCREMENT PRIMARY KEY,
    id_produto INT NOT NULL,
    nota INT NOT NULL,
    comentario TEXT NOT NULL,
    status VARCHAR(20) DEFAULT 'ativa',
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    atualizado_em DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_avaliacoes_produtos
        FOREIGN KEY (id_produto)
        REFERENCES produtos(id_produto)
);

INSERT INTO produtos (nome, descricao, imagem_referencia, ativo) VALUES
('Fone Bluetooth Pulse', 'Fone sem fio com som estéreo e bateria de longa duração.', 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=640&q=80', 1),
('Smartwatch MoveFit', 'Relógio inteligente com monitoramento de atividades e sono.', 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=640&q=80', 1),
('Caixa de Som BeatBox', 'Caixa portátil com conexão Bluetooth e resistência à água.', 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=640&q=80', 1),
('Teclado Mecânico NitroKey', 'Teclado mecânico com iluminação LED e teclas silenciosas.', 'https://images.unsplash.com/photo-1618384887929-16ec33fab9ef?w=640&q=80', 1),
('Mouse Gamer Falcon', 'Mouse ergonômico com ajuste de DPI e iluminação RGB.', 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=640&q=80', 1),
('Webcam HD Vision', 'Webcam com resolução HD para videoaulas e reuniões online.', 'https://images.unsplash.com/photo-1587826080692-f439cd0b70da?w=640&q=80', 1),
('Notebook ProBook 15', 'Notebook com processador rápido, tela Full HD e bateria de longa duração, ideal para trabalho e estudo.', 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=640&q=80', 1),
('Smartphone UltraX 5G', 'Smartphone com câmera de 108MP, tela AMOLED 120Hz e conexão 5G para navegação ultra-rápida.', 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=640&q=80', 1),
('Tablet FlexPad 10"', 'Tablet leve com tela de 10 polegadas, caneta stylus inclusa e bateria para o dia todo.', 'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?w=640&q=80', 1),
('Câmera FotoMax DSLR', 'Câmera semi-profissional com sensor de 24MP, gravação em 4K e kit de lentes intercambiáveis.', 'https://images.unsplash.com/photo-1502920917128-1aa500764cbd?w=640&q=80', 1),
('Headset Gamer ProSound', 'Headset com som surround 7.1, microfone com cancelamento de ruído e iluminação RGB.', 'https://images.unsplash.com/photo-1612444530582-fc66183b16f7?w=640&q=80', 1);
