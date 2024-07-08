USE ZENITH;

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
