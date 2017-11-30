CREATE TABLE tbl_pizza_mes(
idPagina INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
idItemPagina INT NOT NULL,
titulo VARCHAR(240) NOT NULL); 

ALTER TABLE tbl_pizza_mes ADD CONSTRAINT fk_idItemPagina_tbl_pizza_mes FOREIGN KEY(idItemPagina) REFERENCES tbl_item_pizza_mes(idItemPagina);
