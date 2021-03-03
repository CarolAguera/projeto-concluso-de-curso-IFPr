-- MySQL Script generated by MySQL Workbench
-- Fri Feb 26 09:15:18 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema tcc
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema tcc
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tcc` DEFAULT CHARACTER SET utf8 ;
USE `tcc` ;

-- -----------------------------------------------------
-- Table `tcc`.`Categoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tcc`.`Categoria` ;

CREATE TABLE IF NOT EXISTS `tcc`.`Categoria` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `status` INT NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc`.`Marca`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tcc`.`Marca` ;

CREATE TABLE IF NOT EXISTS `tcc`.`Marca` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `status` TINYINT(1) NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc`.`Medida`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tcc`.`Medida` ;

CREATE TABLE IF NOT EXISTS `tcc`.`Medida` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `status` TINYINT(1) NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc`.`Produto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tcc`.`Produto` ;

CREATE TABLE IF NOT EXISTS `tcc`.`Produto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `status` TINYINT(1) NOT NULL,
  `nome` VARCHAR(200) NOT NULL,
  `valor_venda` DOUBLE NOT NULL,
  `codigo` INT NOT NULL,
  `quantidade` INT NOT NULL,
  `Categoria_id` INT NOT NULL,
  `Marca_id` INT NOT NULL,
  `medida_id` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE INDEX `fk_Produto_Categoria1_idx` ON `tcc`.`Produto` (`Categoria_id` ASC) ;

CREATE INDEX `fk_Produto_Marca1_idx` ON `tcc`.`Produto` (`Marca_id` ASC) ;

CREATE INDEX `fk_Produto_medida1_idx` ON `tcc`.`Produto` (`medida_id` ASC) ;




-- -----------------------------------------------------
-- Table `tcc`.`Cliente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tcc`.`Cliente` ;

CREATE TABLE IF NOT EXISTS `tcc`.`Cliente` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `local_trabalho` VARCHAR(200) NULL,
  `telefone_trabalho` VARCHAR(45) NULL,
  `nome_completo` VARCHAR(200) NOT NULL,
  `data_nascimento` DATE NOT NULL,
  `cpf` VARCHAR(45) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `sexo` TINYINT(1) NOT NULL,
  `telefone_residencial` VARCHAR(45) NULL,
  `telefone_celular` VARCHAR(45) NOT NULL,
  `endereco` VARCHAR(255) NOT NULL,
  `cep` VARCHAR(45) NOT NULL,
  `numero` INT NOT NULL,
  `cidade` VARCHAR(100) NOT NULL,
  `estado` VARCHAR(100) NOT NULL,
  `status` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc`.`Usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tcc`.`Usuario` ;

CREATE TABLE IF NOT EXISTS `tcc`.`Usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `status` TINYINT(1) NOT NULL,
  `nome_completo` VARCHAR(200) NOT NULL,
  `data_nascimento` DATE NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `sexo` TINYINT(1) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `data_admissao` DATE NOT NULL,
  `data_demissao` DATE NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc`.`Venda`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tcc`.`Venda` ;

CREATE TABLE IF NOT EXISTS `tcc`.`Venda` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `status` TINYINT(1) NOT NULL,
  ` data_hora` DATETIME NOT NULL,
  `valorTotal` DOUBLE NOT NULL,
  `valorRecebido` DOUBLE NOT NULL,
  `saldoReceber` DOUBLE NOT NULL,
  `Usuario_id` INT NOT NULL,
  `Cliente_id` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;
CREATE INDEX `fk_ControleDeVendas_CLIENTE1_idx` ON `tcc`.`Venda` (`Cliente_id` ASC) ;

CREATE INDEX `fk_Venda_Usuario1_idx` ON `tcc`.`Venda` (`Usuario_id` ASC) ;



-- -----------------------------------------------------
-- Table `tcc`.`Itens de Venda`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tcc`.`Itens de Venda` ;

CREATE TABLE IF NOT EXISTS `tcc`.`Itens de Venda` (
  `Venda_id` INT NOT NULL,
  `Produto_id` INT NOT NULL,
  `quantidadeVendida` INT NOT NULL,
  `desconto` DOUBLE NULL,
  `valorTotal` DOUBLE NOT NULL,
  PRIMARY KEY (`Venda_id`, `Produto_id`))
ENGINE = InnoDB;
CREATE INDEX `fk_Venda_has_Produto_Produto1_idx` ON `tcc`.`Itens de Venda` (`Produto_id` ASC) ;

CREATE INDEX `fk_Venda_has_Produto_Venda1_idx` ON `tcc`.`Itens de Venda` (`Venda_id` ASC) ;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;