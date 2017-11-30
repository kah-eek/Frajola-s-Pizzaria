CREATE TABLE tbl_funcionario (
idFuncionario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(200) NOT NULL,
celular VARCHAR(12) NOT NULL,
telefone VARCHAR(11),
email VARCHAR(80) NOT NULL,
sexo CHAR(1) NOT NULL);

ALTER TABLE tbl_funcionario ADD COLUMN cpf VARCHAR(14) NOT NULL; 

ALTER TABLE tbl_funcionario ADD COLUMN dtNasc DATE NOT NULL;
 
ALTER TABLE tbl_funcionario ADD COLUMN salario DECIMAL(6,2) NOT NULL; 

ALTER TABLE tbl_funcionario CHANGE COLUMN salario salario DECIMAL(10,2) NOT NULL; 

ALTER TABLE tbl_funcionario ADD COLUMN idEstadoCivil INT NOT NULL; 

ALTER TABLE tbl_funcionario ADD CONSTRAINT fk_idEstadoCivil_tbl_estado_civil FOREIGN KEY(idEstadoCivil) REFERENCES tbl_estado_civil(idEstadoCivil);

ALTER TABLE tbl_funcionario DROP FOREIGN KEY fk_idEstadoCivil_tbl_estado_civil;

