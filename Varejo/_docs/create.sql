CREATE DATABASE varejo
    DEFAULT CHARACTER SET = 'utf8mb4';
USE varejo

CREATE TABLE usuario (
  id INTEGER   NOT NULL AUTO_INCREMENT ,
  nome VARCHAR(32)   NOT NULL ,
  senha VARCHAR(32)   NOT NULL   ,
PRIMARY KEY(id)  );

CREATE UNIQUE INDEX usuario_unique ON usuario (nome);

CREATE TABLE produto (
  id INTEGER   NOT NULL AUTO_INCREMENT ,
  usuario_id INTEGER   NOT NULL ,
  nome VARCHAR(64)   NOT NULL ,
  quantidade FLOAT   NOT NULL ,
  validade DATETIME      ,
PRIMARY KEY(id)    ,
  FOREIGN KEY(usuario_id)
    REFERENCES usuario(id)
      ON DELETE CASCADE
      ON UPDATE CASCADE);

CREATE INDEX produto_FKIndex1 ON produto (usuario_id);
CREATE INDEX IFK_rel_usuario_produto ON produto (usuario_id);

CREATE TABLE venda (
  id INTEGER NOT NULL AUTO_INCREMENT,
  produto_id INTEGER NOT NULL,
  quantidade FLOAT NOT NULL,
  valor FLOAT NOT NULL,
  data_venda DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(id),
  FOREIGN KEY(produto_id)
    REFERENCES produto(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE compra (
  id INTEGER NOT NULL AUTO_INCREMENT,
  produto_id INTEGER NOT NULL,
  quantidade FLOAT NOT NULL,
  valor FLOAT NOT NULL,
  data_compra DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(id),
  FOREIGN KEY(produto_id)
    REFERENCES produto(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);