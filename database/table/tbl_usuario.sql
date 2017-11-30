CREATE TABLE tbl_usuario (
idUsuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
idPrivilegio INT NOT NULL,
idFuncionario INT NOT NULL,
usuario VARCHAR(100) NOT NULL,
senha VARCHAR(200) NOT NULL);

ALTER TABLE tbl_usuario CHANGE COLUMN usuario usuario VARCHAR(100) NOT NULL;

ALTER TABLE tbl_usuario ADD COLUMN foto_perfil VARCHAR(380) NOT NULL;

ALTER TABLE tbl_usuario CHANGE COLUMN senha senha VARCHAR(200) NOT NULL;

ALTER TABLE tbl_usuario ADD CONSTRAINT fk_idFuncionario_tbl_usuario FOREIGN KEY(idFuncionario) REFERENCES tbl_funcionario(idFuncionario);

ALTER TABLE tbl_usuario DROP FOREIGN KEY fk_idFuncionario_tbl_usuario;