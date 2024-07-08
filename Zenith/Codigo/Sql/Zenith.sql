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

-- Tabela de produção de veículos
CREATE TABLE IF NOT EXISTS producao_veiculos (
id INT AUTO_INCREMENT PRIMARY KEY,
modelo VARCHAR(255) NOT NULL,
quantidade_produzida INT NOT NULL,
linha_producao VARCHAR(255) NOT NULL
);

-- Tabela de log de produção de veículos
CREATE TABLE IF NOT EXISTS log_producao_veiculos (
id INT AUTO_INCREMENT PRIMARY KEY,
timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
acao VARCHAR(255) NOT NULL,
id_producao_veiculo INT NOT NULL
);

-- Trigger para registrar ação de inserção na tabela de produção de veículos
DELIMITER //
CREATE TRIGGER insere_producao_veiculo AFTER INSERT ON producao_veiculos
FOR EACH ROW
BEGIN
INSERT INTO log_producao_veiculos (acao, id_producao_veiculo)
VALUES ('Inserção', NEW.id);
END//

-- Trigger para registrar ação de atualização na tabela de produção de veículos
CREATE TRIGGER atualiza_producao_veiculo AFTER UPDATE ON producao_veiculos
FOR EACH ROW
BEGIN
INSERT INTO log_producao_veiculos (acao, id_producao_veiculo)
VALUES ('Atualização', OLD.id);
END//

-- Trigger para registrar ação de exclusão na tabela de produção de veículos
CREATE TRIGGER deleta_producao_veiculo AFTER DELETE ON producao_veiculos
FOR EACH ROW
BEGIN
INSERT INTO log_producao_veiculos (acao, id_producao_veiculo)
VALUES ('Exclusão', OLD.id);
END//

DELIMITER ;

-- Tabela de controle de qualidade de veículos
CREATE TABLE IF NOT EXISTS controle_qualidade_veiculos (
id INT AUTO_INCREMENT PRIMARY KEY,
id_producao_veiculo INT,
defeitos_encontrados TEXT,
status_qualidade VARCHAR(255)
);

-- Tabela de log de controle de qualidade de veículos
CREATE TABLE IF NOT EXISTS log_controle_qualidade_veiculos (
id_log INT AUTO_INCREMENT PRIMARY KEY,
timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
acao VARCHAR(255) NOT NULL,
id_controle_qualidade_veiculo INT NOT NULL
);

-- Trigger para registrar ação de inserção na tabela de controle de qualidade de veículos
DELIMITER //
CREATE TRIGGER insere_controle_qualidade_veiculo AFTER INSERT ON controle_qualidade_veiculos
FOR EACH ROW
BEGIN
INSERT INTO log_controle_qualidade_veiculos (acao, id_controle_qualidade_veiculo)
VALUES ('Inserção', NEW.id);
END//

-- Trigger para registrar ação de atualização na tabela de controle de qualidade de veículos
CREATE TRIGGER atualiza_controle_qualidade_veiculo AFTER UPDATE ON controle_qualidade_veiculos
FOR EACH ROW
BEGIN
INSERT INTO log_controle_qualidade_veiculos (acao, id_controle_qualidade_veiculo)
VALUES ('Atualização', OLD.id);
END//

-- Trigger para registrar ação de exclusão na tabela de controle de qualidade de veículos
CREATE TRIGGER deleta_controle_qualidade_veiculo AFTER DELETE ON controle_qualidade_veiculos
FOR EACH ROW
BEGIN
INSERT INTO log_controle_qualidade_veiculos (acao, id_controle_qualidade_veiculo)
VALUES ('Exclusão', OLD.id);
END//

DELIMITER ;

-- Tabela de logística de distribuição de veículos
CREATE TABLE IF NOT EXISTS logistica_distribuicao_veiculos (
id INT AUTO_INCREMENT PRIMARY KEY,
id_producao_veiculo INT,
destino VARCHAR(255),
metodo_envio VARCHAR(255)
);

-- Tabela de log de logística
CREATE TABLE IF NOT EXISTS log_logistica (
id_log INT AUTO_INCREMENT PRIMARY KEY,
timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
acao VARCHAR(255) NOT NULL,
id_logistica_veiculo INT NOT NULL
);

-- Trigger para registrar ação de inserção na tabela de logística de distribuição de veículos
DELIMITER //
CREATE TRIGGER insere_logistica_distribuicao_veiculo AFTER INSERT ON logistica_distribuicao_veiculos
FOR EACH ROW
BEGIN
INSERT INTO log_logistica (acao, id_logistica_veiculo)
VALUES ('Inserção', NEW.id);
END//

-- Trigger para registrar ação de atualização na tabela de logística de distribuição de veículos
CREATE TRIGGER atualiza_logistica_distribuicao_veiculo AFTER UPDATE ON logistica_distribuicao_veiculos
FOR EACH ROW
BEGIN
INSERT INTO log_logistica (acao, id_logistica_veiculo)
VALUES ('Atualização', OLD.id);
END//

-- Trigger para registrar ação de exclusão na tabela de logística de distribuição de veículos
CREATE TRIGGER deleta_logistica_distribuicao_veiculo AFTER DELETE ON logistica_distribuicao_veiculos
FOR EACH ROW
BEGIN
INSERT INTO log_logistica (acao, id_logistica_veiculo)
VALUES ('Exclusão', OLD.id);
END//

DELIMITER ;