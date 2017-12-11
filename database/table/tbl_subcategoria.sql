CREATE TABLE tbl_subcategoria(
idSubcategoria INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
idCategoria INT NOT NULL,
FOREIGN KEY (idCategoria) REFERENCES tbl_categoria(idCategoria),
subcategoria VARCHAR(80) NOT NULL
);

ALTER TABLE tbl_subcategoria DROP FOREIGN KEY tbl_subcategoria_ibfk_1;

ALTER TABLE tbl_subcategoria ADD CONSTRAINT fk_tbl_subcategoria_idCategoria FOREIGN KEY(idCategoria) REFERENCES tbl_categoria(idCategoria) ON DELETE CASCADE;