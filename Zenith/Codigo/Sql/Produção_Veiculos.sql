- Seleção do banco de dados ZENITH
USE ZENITH;

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