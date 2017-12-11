CREATE TABLE tbl_endereco(
idEndereco INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
idCidade INT NOT NULL,
cep VARCHAR(8) NOT NULL,
logradouro VARCHAR(250) NOT NULL,
numero VARCHAR(6) NOT NULL,
bairro VARCHAR(200) NOT NULL); 

DESCRIBE tbl_endereco;


ALTER TABLE tbl_endereco CHANGE COLUMN latitude latitude DOUBLE NOT NULL DEFAULT 0;

ALTER TABLE tbl_endereco CHANGE COLUMN longitude longitude DOUBLE NOT NULL DEFAULT 0;

ALTER TABLE tbl_endereco ADD CONSTRAINT fk_idCidade_tbl_endereco FOREIGN KEY(idCidade) REFERENCES tbl_cidade(idCidade) ON DELETE CASCADE;

ALTER TABLE tbl_endereco DROP FOREIGN KEY fk_idCidade_tbl_endereco;
