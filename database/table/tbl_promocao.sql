CREATE TABLE tbl_promocao(
idPagina INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
idItemPagina INT NOT NULL,
titulo VARCHAR(240));

ALTER TABLE tbl_promocao CHANGE COLUMN titulo titulo VARCHAR(240) NOT NULL;

ALTER TABLE tbl_promocao ADD CONSTRAINT fk_idItemPagina_tbl_promocao FOREIGN KEY(idItemPagina) REFERENCES tbl_item_promocao(idItemPagina);
