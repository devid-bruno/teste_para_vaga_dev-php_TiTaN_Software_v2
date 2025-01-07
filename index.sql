CREATE DATABASE IF NOT EXISTS `loja`;
USE `loja`;

CREATE TABLE `produtos`(
    `cod_prod` INT,
    `loj_prod` INT,
    `desc_prod` CHAR(40),
    `dt_inclu_prod` DATE,
    `preco_prod` DECIMAL(8, 3),
    PRIMARY KEY (`cod_prod`, `loj_prod`)
)

CREATE TABLE `estoque`(
    `cod_prod` INT,
    `loj_prod` INT,
    `qtd_prod` DECIMAL(15, 3),
    PRIMARY KEY (`cod_prod`, `loj_prod`)
)

CREATE TABLE `lojas` (
    `loj_prod` INT,
    `desc_loj` CHAR(40),
    PRIMARY KEY (`loj_prod`)
)

INSERT INTO `produtos` (`cod_prod`, `loj_prod`, `desc_prod`, `dt_inclu_prod`, `preco_prod`) VALUES
(170, 2, 'LEITE CONDENSADO MOCOCA', '2010-12-30', 45.40);

UPDATE `produtos` SET `preco_prod` = 95.40 WHERE `cod_prod` = 170 AND `loj_prod` = 2;


SELECT * FROM `produtos` WHERE `loj_prod` IN (1, 2); 

SELECT MIN(`dt_inclu_prod`) AS menor_data, MAX(`dt_inclu_prod`) maior_data FROM `produtos`;

SELECT COUNT(*) FROM `produtos`;

SELECT * FROM `produtos` WHERE `desc_prod` LIKE 'L%';

SELECT `loj_prod`, SUM(`preco_prod`)AS total FROM `produtos` GROUP BY`loj_prod`;

SELECT `loj_prod`, SUM(`preco_prod`) AS total FROM `produtos` GROUP BY `loj_prod` HAVING total > 100000;

""""""""""""""""""""""""""""""""""""""""""""""""

SELECT l.`loj_prod` AS codigo_loja, l.`desc_loj` AS descricao_loja, p.`cod_prod` AS codigo_produto, p.`desc_prod` AS descricao_produto, p.`preco_prod` AS preco_produto, e.`qtd_prod` AS quantidade_estoqueFROM `lojas` l
JOIN `produtos` p ON l.`loj_prod` = p.`loj_prod` JOIN `estoque` e ON p.`cod_prod` = e.`cod_prod` AND p.`loj_prod` = e.`loj_prod` WHERE l.`loj_prod` = 1;

SELECT p.`cod_prod`, p.`loj_prod`, p.`desc_prod`, p.`preco_prod`FROM `produtos` p LEFT JOIN `estoque` e ON p.`cod_prod` = e.`cod_prod` AND p.`loj_prod` = e.`loj_prod` WHERE e.`cod_prod` IS NULL;


SELECT e.`cod_prod`, e.`loj_prod`, e.`qtd_prod` FROM `estoque` e LEFT JOIN `produtos` p ON e.`cod_prod` = p.`cod_prod` AND e.`loj_prod` = p.`loj_prod`WHERE p.`cod_prod` IS NULL;