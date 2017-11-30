CREATE TABLE tbl_curiosidade_decada (
idPagina INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
idItemPagina INT NOT NULL,
titulo VARCHAR(240));

ALTER TABLE tbl_curiosidade_decada CHANGE COLUMN titulo titulo VARCHAR(240) NOT NULL;

ALTER TABLE tbl_curiosidade_decada ADD CONSTRAINT fk_idItemPagina_tbl_curiosidade_decada FOREIGN KEY(idItemPagina) REFERENCES tbl_item_curiosidade_decada(idItemPagina);

ALTER TABLE tbl_curiosidade_decada DROP FOREIGN KEY fk_idItemPagina_tbl_curiosidade_decada;