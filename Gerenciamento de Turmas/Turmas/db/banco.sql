-- Criação do banco de dados
CREATE DATABASE sistema_escolar;

-- Seleciona o banco de dados
USE sistema_escolar;

-- Criação da tabela de professores
CREATE TABLE professores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Criação da tabela de turmas
CREATE TABLE turmas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    professor_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    FOREIGN KEY (professor_id) REFERENCES professores (id) ON DELETE CASCADE
);

-- Criação da tabela de atividades
CREATE TABLE atividades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    class_id INT NOT NULL,
    description TEXT NOT NULL,
    FOREIGN KEY (class_id) REFERENCES turmas (id) ON DELETE CASCADE
);
