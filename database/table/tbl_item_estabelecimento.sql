CREATE TABLE tbl_item_estabelecimento(
idItemPagina INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
idPizzaria INT NOT NULL,
imagemEstabelecimento VARCHAR(340) NOT NULL,
iconeBanda VARCHAR(340) NOT NULL,
ativo TINYINT(1) NOT NULL);

DESCRIBE tbl_item_estabelecimento;

ALTER TABLE tbl_item_estabelecimento ADD CONSTRAINT fk_idPizzaria_tbl_item_estabelecimento FOREIGN KEY(idPizzaria) REFERENCES tbl_pizzaria(idPizzaria) ON DELETE CASCADE;
