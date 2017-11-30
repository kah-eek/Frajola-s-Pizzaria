CREATE TABLE tbl_pizzaria(
idPizzaria INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
idEndereco INT NOT NULL,
telefone VARCHAR(11) NOT NULL);

DESCRIBE tbl_pizzaria;

ALTER TABLE tbl_pizzaria ADD CONSTRAINT fk_idEndereco_tbl_pizzaria FOREIGN KEY(idEndereco) REFERENCES tbl_endereco(idEndereco) ON DELETE CASCADE;

ALTER TABLE tbl_pizzaria DROP FOREIGN KEY fk_idEndereco_tbl_pizzaria;