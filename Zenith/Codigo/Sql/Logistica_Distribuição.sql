USE ZENITH;

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