CREATE TABLE tbl_estado_civil(
idEstadoCivil INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
estado_civil VARCHAR(45) NOT NULL);

INSERT INTO tbl_estado_civil (estado_civil) VALUES("Solteiro");

INSERT INTO tbl_estado_civil (estado_civil) VALUES("Casado");

INSERT INTO tbl_estado_civil (estado_civil) VALUES("Viuvo");

INSERT INTO tbl_estado_civil (estado_civil) VALUES("Divorciado");