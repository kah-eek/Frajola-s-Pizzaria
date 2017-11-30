CREATE TABLE tbl_privilegio(
idPrivilegio INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
privilegio VARCHAR(250) NOT NULL);

INSERT INTO tbl_privilegio (privilegio) VALUES("Administrador");

INSERT INTO tbl_privilegio (privilegio) VALUES("Operador Básico");

INSERT INTO tbl_privilegio (privilegio) VALUES("Cataloguista");