-- Criar o banco de dados se não existir
CREATE DATABASE IF NOT EXISTS ZENITH;

-- Usar o banco de dados ZENITH
USE ZENITH;

-- Criar a tabela de cadastro
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    sobrenome VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);
