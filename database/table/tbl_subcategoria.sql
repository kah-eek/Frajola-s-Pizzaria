CREATE TABLE tbl_subcategoria(
idSubcategoria INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
idCategoria INT NOT NULL,
FOREIGN KEY (idCategoria) REFERENCES tbl_categoria(idCategoria),
subcategoria VARCHAR(80) NOT NULL
);