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

-- Inserção de dados na tabela professores
INSERT INTO professores (username, email, password) VALUES
('Neylor', 'neylor@email.com', 'senha1'),
('Henrique', 'henrique@email.com', 'senha2'),
('Gonçalves', 'goncalves@email.com', 'senha3');

-- Inserção de dados na tabela turmas
INSERT INTO turmas (professor_id, name) VALUES
(1, 'Turma A'),
(2, 'Turma B'),
(3, 'Turma C');

-- Busca pelos IDs das turmas inseridas
SELECT * FROM turmas;

-- Inserção de dados na tabela atividades
INSERT INTO atividades (class_id, description) VALUES
(1, 'Atividade 1 da Turma A'),
(1, 'Atividade 2 da Turma A'),
(2, 'Atividade 1 da Turma B'),
(2, 'Atividade 2 da Turma B'),
(3, 'Atividade 1 da Turma C'),
(3, 'Atividade 2 da Turma C');
