CREATE DATABASE IF NOT EXISTS ATENDIMENTO;

-- Usar o banco de dados ZENITH
USE ATENDIMENTO;


CREATE TABLE IF NOT EXISTS Cliente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    senha VARCHAR(10) NOT NULL,
    tipo ENUM('normal', 'prioritario') NOT NULL,
    status ENUM('pendente', 'em_andamento', 'concluido', 'recusado') DEFAULT 'pendente',
    data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Criação da tabela Atendente
CREATE TABLE IF NOT EXISTS Atendente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    senha VARCHAR(255) NOT NULL
);

-- Criação da tabela Adm
CREATE TABLE IF NOT EXISTS Adm (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    senha VARCHAR(255) NOT NULL
);

-- Inserção dos administradores pré-adicionados
INSERT INTO Adm (usuario, senha) VALUES
('Neylor', '12345'),
('Franco', '12345'),
('Teste', '12345');

UPDATE Cliente SET status = 'recusado' WHERE id = 11
