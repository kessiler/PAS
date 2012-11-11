-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tempo de Gera��o: Out 07, 2012 as 11:04 PM
-- Vers�o do Servidor: 5.0.51
-- Vers�o do PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Banco de Dados: `webpas`
-- 

CREATE DATABASE  `webpas` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `webpas`;

-- 
-- Estrutura da tabela `usuarios`
-- 

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `CDUSUARIO` int(11) NOT NULL auto_increment COMMENT 'C�digo',
  `NMLOGIN` varchar(50) collate utf8_bin NOT NULL COMMENT 'Login',
  `CDSENHA` varchar(40) collate utf8_bin NOT NULL COMMENT 'Senha',
  `CDNOME` varchar(50) collate utf8_bin NOT NULL COMMENT 'Nome',
  `CDCPF` varchar(12) collate utf8_bin default NULL COMMENT 'CPF',
  `IDATIVO` varchar(1) collate utf8_bin NOT NULL COMMENT 'S OU N',
  PRIMARY KEY  (`CDUSUARIO`),
  KEY `NMLOGIN` (`NMLOGIN`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

-- 
-- Inserindo 'usu�rio' padr�o
-- 

INSERT INTO `usuarios` VALUES (1, 0x61646d696e, 0x3230326362393632616335393037356239363462303731353264323334623730, 0x41646d696e6973747261646f72, 0x313131313131313131313131, 0x53);
--  -- --------------------------------------------------------

-- 
-- Estrutura da tabela `clientes`
-- 

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `CDCLIENTE` int(11) NOT NULL auto_increment,
  `NMCLIENTE` varchar(100) collate utf8_bin NOT NULL,
  `DTNASCIMENTO` date NOT NULL,
  `NMRESPONSAVEL` varchar(100) collate utf8_bin default NULL,
  `GRAUPARENTESCO` varchar(30) collate utf8_bin default NULL,
  `CONVENIOS` varchar(200) collate utf8_bin default NULL,
  `IDBEBE` varchar(1) collate utf8_bin NOT NULL COMMENT 'S OU N',
  `IDFUMA` varchar(1) collate utf8_bin NOT NULL COMMENT 'S OU N',
  `NMVICIOS` varchar(100) collate utf8_bin default NULL,
  `ESCOLARIDADE` varchar(70) collate utf8_bin default NULL,
  `PROFISSAO` varchar(50) collate utf8_bin default NULL,
  `ESTADOCIVIL` varchar(1) collate utf8_bin NOT NULL COMMENT 'C, S, D, V',
  `IDFILHOS` varchar(1) collate utf8_bin NOT NULL COMMENT 'S OU N',
  `QTDFILHOS` int(11) default NULL,
  `AVALIACAOMEDICA` text collate utf8_bin,
  PRIMARY KEY  (`CDCLIENTE`),
  KEY `NMCLIENTE` (`NMCLIENTE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `dieta`
-- 

DROP TABLE IF EXISTS `dieta`;
CREATE TABLE `dieta` (
  `CDDIETA` int(11) NOT NULL auto_increment COMMENT 'C�digo da dieta',
  `NMDIETA` varchar(50) collate utf8_bin NOT NULL COMMENT 'Nome da dieta',
  `DSDIETA` varchar(200) collate utf8_bin default NULL COMMENT 'Descri��o da dieta',
  `IDATIVO` varchar(1) collate utf8_bin NOT NULL default 'S' COMMENT 'S ou N',
  PRIMARY KEY  (`CDDIETA`),
  KEY `NMDIETA` (`NMDIETA`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `logoperacao`
-- 

DROP TABLE IF EXISTS `logoperacao`;
CREATE TABLE `logoperacao` (
  `NRSEQOPERACAO` int(11) NOT NULL auto_increment,
  `DTOPERACAO` date NOT NULL,
  `IDOPERACAO` varchar(1) collate utf8_bin NOT NULL COMMENT 'S OU N',
  `CDUSUARIO` int(11) NOT NULL,
  `CDPRODUTO` int(11) NOT NULL,
  `QTDPROD` float NOT NULL,
  PRIMARY KEY  (`NRSEQOPERACAO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

ALTER TABLE `logoperacao` ADD CONSTRAINT FK_USUARIO FOREIGN KEY (`CDUSUARIO`) REFERENCES `usuarios` (`CDUSUARIO`);
ALTER TABLE `logoperacao` ADD CONSTRAINT FK_PRODUTOS_LOG FOREIGN KEY (`CDPRODUTO`) REFERENCES `produtos` (`CDPRODUTO`);

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `produtos`
-- 

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE `produtos` (
  `CDPRODUTO` int(11) NOT NULL auto_increment COMMENT 'C�digo',
  `NMPRODUTO` varchar(50) collate utf8_bin NOT NULL COMMENT 'Nome',
  `DSPRODUTO` varchar(200) collate utf8_bin default NULL COMMENT 'Descri��o',
  `QTDPROD` float NOT NULL default '0' COMMENT 'Quantidade',
  `TIPOPROD` varchar(1) collate utf8_bin NOT NULL COMMENT 'Tipo / ''M'', ''O'', ''A''',
  PRIMARY KEY  (`CDPRODUTO`),
  KEY `NMPRODUTO` (`NMPRODUTO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `relacdieta`
-- 

DROP TABLE IF EXISTS `relacdieta`;
CREATE TABLE `relacdieta` (
  `DTOPERACAO` date NOT NULL,
  `CDUSUARIO` int(11) NOT NULL,
  `CDDIETA` int(11) NOT NULL,
  `CDCLIENTE` int(11) NOT NULL,
  PRIMARY KEY  (`DTOPERACAO`,`CDUSUARIO`,`CDDIETA`,`CDCLIENTE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE `usuarios` ADD CONSTRAINT FK_USUARIO_DIE FOREIGN KEY (`CDUSUARIO`) REFERENCES `usuarios` (`CDUSUARIO`);
ALTER TABLE `dieta` ADD CONSTRAINT FK_DIETA FOREIGN KEY (`CDDIETA`) REFERENCES `dieta` (`CDDIETA`);
ALTER TABLE `clientes` ADD CONSTRAINT FK_CLIENTE_DIE FOREIGN KEY (`CDCLIENTE`) REFERENCES `clientes` (`CDCLIENTE`);


-- --------------------------------------------------------

-- 
-- Estrutura da tabela `relacmedicamento`
-- 

DROP TABLE IF EXISTS `relacmedicamento`;
CREATE TABLE `relacmedicamento` (
  `DTOPERACAO` date NOT NULL,
  `CDUSUARIO` int(11) NOT NULL,
  `CDPRODUTO` int(11) NOT NULL,
  `CDCLIENTE` int(11) NOT NULL,
  PRIMARY KEY  (`CDUSUARIO`,`CDPRODUTO`,`CDCLIENTE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE `usuarios` ADD CONSTRAINT FK_USUARIO_MED FOREIGN KEY (`CDUSUARIO`) REFERENCES `usuarios` (`CDUSUARIO`);
ALTER TABLE `produtos` ADD CONSTRAINT FK_PRODUTOS_MED FOREIGN KEY (`CDPRODUTO`) REFERENCES `produtos` (`CDPRODUTO`);
ALTER TABLE `clientes` ADD CONSTRAINT FK_CLIENTE_MED FOREIGN KEY (`CDCLIENTE`) REFERENCES `clientes` (`CDCLIENTE`);




