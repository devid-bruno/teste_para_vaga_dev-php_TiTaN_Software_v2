CREATE DATABASE IF NOT EXISTS `project`

USE `project`

CREATE TABLE IF NOT EXISTS `tbl_usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `senha` varchar(20) NOT NULL,
  PRIMARY KEY (`id_usuario`)
);

CREATE TABLE IF NOT EXISTS `tbl_empresa` (
  `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) NOT NULL,
  PRIMARY KEY (`id_empresa`)
);

CREATE TABLE IF NOT EXISTS `tbl_funcionario` (
    `id_funcionario` int(11) NOT NULL AUTO_INCREMENT,
    `nome` varchar(50) NOT NULL,
    `cpf` varchar(11) NOT NULL,
    `rg` varchar(20) NOT NULL,
    `email` varchar(30) NOT NULL,
    `id_empresa` INT NOT NULL,
    PRIMARY KEY (`id_funcionario`),
    FOREIGN KEY (`id_empresa`) REFERENCES `tbl_empresa`(`id_empresa`)
);

INSERT INTO tbl_usuarios (login, senha) VALUES ('adm@adm.com', 'projeto');

INSERT INTO tbl_empresa (id_empresa, nome) VALUES (1, 'empresa 1');

INSERT INTO tbl_funcionario (id_funcionario, nome, cpf, rg, email, id_empresa) VALUES (1, 'funcionario 1', '12345678901', '123456789', 'func1@mail.com', 1);

SELECT * FROM tbl_usuarios;

ALTER TABLE `tbl_funcionario`
ADD COLUMN `data_cadastro` DATE NOT NULL DEFAULT '2023-01-01',
ADD COLUMN `salario` DOUBLE(10, 2) NOT NULL,
ADD COLUMN `bonificacao` DOUBLE(10, 2) NOT NULL;

SELECT * FROM tbl_funcionario;

INSERT INTO tbl_usuarios (login, senha) VALUES ('teste@gmail.com.br', '1234');

SELECT * FROM tbl_usuarios;

ALTER TABLE `tbl_usuarios`
MODIFY COLUMN `senha` VARCHAR(32) NOT NULL;

INSERT INTO tbl_usuarios (login, senha) VALUES ('teste@gmail.com.br', MD5('1234'));