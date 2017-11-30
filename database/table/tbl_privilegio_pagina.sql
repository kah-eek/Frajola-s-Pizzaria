CREATE TABLE tbl_privilegio_pagina (
idPrivilegioPagina INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
idPrivilegio INT NOT NULL,
CONSTRAINT fk_idPrivilegio_tbl_privilegio_pagina FOREIGN KEY(idPrivilegio) REFERENCES tbl_privilegio(idPrivilegio),
idPagina INT NOT NULL);

/* tbl_curiosidade_decada */
ALTER TABLE tbl_privilegio_pagina ADD CONSTRAINT fk_idPagina_tbl_curiosidade_decada FOREIGN KEY(idPagina) REFERENCES tbl_curiosidade_decada(idPagina);

/* tbl_sobre_pizzaria */
ALTER TABLE tbl_privilegio_pagina ADD CONSTRAINT fk_idPagina_tbl_sobre_pizzaria FOREIGN KEY(idPagina) REFERENCES tbl_sobre_pizzaria(idPagina);

/* tbl_promocao */
ALTER TABLE tbl_privilegio_pagina ADD CONSTRAINT fk_idPagina_tbl_promocao FOREIGN KEY(idPagina) REFERENCES tbl_promocao(idPagina);

/* tbl_estabelecimento */
ALTER TABLE tbl_privilegio_pagina ADD CONSTRAINT fk_idPagina_tbl_estabelecimento FOREIGN KEY(idPagina) REFERENCES tbl_estabelecimento(idPagina);

/* tbl_pizza_mes */
ALTER TABLE tbl_privilegio_pagina ADD CONSTRAINT fk_idPagina_tbl_pizza_mes FOREIGN KEY(idPagina) REFERENCES tbl_pizza_mes(idPagina);