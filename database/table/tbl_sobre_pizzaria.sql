CREATE TABLE tbl_sobre_pizzaria (
idPagina INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
idItemPagina INT NOT NULL,
titulo VARCHAR(240) NOT NULL,
subtitulo VARCHAR(120) NOT NULL);

ALTER TABLE tbl_sobre_pizzaria ADD CONSTRAINT fk_idItemPagina_tbl_sobre_pizzaria FOREIGN KEY(idItemPagina) REFERENCES tbl_item_sobre_pizzaria(idItemPagina);
