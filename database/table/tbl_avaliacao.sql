CREATE TABLE tbl_avaliacao (
idAvaliacao INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
idProduto INT NOT NULL,
avaliacao INT NOT NULL DEFAULT 0,
FOREIGN KEY (idProduto) REFERENCES tbl_produto(idProduto));

DESCRIBE tbl_avaliacao;