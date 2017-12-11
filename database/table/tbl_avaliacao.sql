CREATE TABLE tbl_avaliacao (
idAvaliacao INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
idProduto INT NOT NULL,
avaliacao INT NOT NULL DEFAULT 0,
FOREIGN KEY (idProduto) REFERENCES tbl_produto(idProduto) ON DELETE CASCADE);

ALTER TABLE tbl_avaliacao CHANGE COLUMN avaliacao avaliacao FLOAT NOT NULL DEFAULT 0;

DESCRIBE tbl_avaliacao;