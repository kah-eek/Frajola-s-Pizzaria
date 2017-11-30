CREATE TABLE tbl_produto(
idProduto INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
titulo VARCHAR(100) NOT NULL,
preco DECIMAL(5,2) NOT NULL,
descricao VARCHAR(60) NOT NULL,
detalhes VARCHAR(400) NOT NULL,
imagemProduto VARCHAR(340) NOT NULL,
idSubcategoria INT NOT NULL,
ativo TINYINT(1) NOT NULL DEFAULT 0,
click INT NOT NULL DEFAULT 0,
FOREIGN KEY (idSubcategoria) REFERENCES tbl_subcategoria(idSubcategoria));

DESCRIBE tbl_produto;