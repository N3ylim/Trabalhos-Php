-- scripts.sql

CREATE DATABASE IF NOT EXISTS forum;
USE forum;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE topicos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_autor INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_autor) REFERENCES usuarios(id)
);

CREATE TABLE mensagens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_autor INT NOT NULL,
    id_topico INT NOT NULL,
    conteudo TEXT NOT NULL,
    imagem VARCHAR(255),
    data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_autor) REFERENCES usuarios(id),
    FOREIGN KEY (id_topico) REFERENCES topicos(id)
);

CREATE TABLE mensagens_imagens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_mensagem INT,
    nome_arquivo VARCHAR(255),
    caminho_arquivo VARCHAR(255),
    FOREIGN KEY (id_mensagem) REFERENCES mensagens(id) ON DELETE CASCADE
);

