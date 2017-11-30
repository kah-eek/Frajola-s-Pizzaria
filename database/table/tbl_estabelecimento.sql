CREATE TABLE tbl_estabelecimento(
idPagina INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
idItemPagina INT NOT NULL,
titulo VARCHAR(240) NOT NULL,
iconeTitulo VARCHAR(340));

ALTER TABLE tbl_estabelecimento ADD CONSTRAINT fk_idItemPagina_tbl_estabelecimento FOREIGN KEY(idItemPagina) REFERENCES tbl_item_estabelecimento(idItemPagina);
