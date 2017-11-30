CREATE TABLE tbl_item_pagina(
idItemPagina INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
idDecada INT NOT NULL,
titulo VARCHAR(120) NOT NULL,
imagemPrincipal VARCHAR(340) NOT NULL,
imagemFundo VARCHAR(340) NOT NULL,
descricao VARCHAR(600) NOT NULL, 
ativo TINYINT(1) NOT NULL);

ALTER TABLE tbl_item_pagina RENAME tbl_item_curiosidade_decada;

ALTER TABLE tbl_item_curiosidade_decada ADD CONSTRAINT fk_idDecada_tbl_curiosidade_decada FOREIGN KEY(idDecada) REFERENCES tbl_decada(idDecada);