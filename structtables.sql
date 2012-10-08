-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tempo de Geração: Out 07, 2012 as 09:46 PM
-- Versão do Servidor: 5.0.51
-- Versão do PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Banco de Dados: `webpas`
-- 

-- --------------------------------------------------------

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

-- 
-- Extraindo dados da tabela `clientes`
-- 


-- --------------------------------------------------------

-- 
-- Estrutura da tabela `dieta`
-- 

DROP TABLE IF EXISTS `dieta`;
CREATE TABLE `dieta` (
  `CDDIETA` int(11) NOT NULL auto_increment COMMENT 'Código da dieta',
  `NMDIETA` varchar(50) collate utf8_bin NOT NULL COMMENT 'Nome da dieta',
  `DSDIETA` varchar(200) collate utf8_bin default NULL COMMENT 'Descrição da dieta',
  `IDATIVO` varchar(1) collate utf8_bin NOT NULL default 'S' COMMENT 'S ou N',
  PRIMARY KEY  (`CDDIETA`),
  KEY `NMDIETA` (`NMDIETA`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- 
-- Extraindo dados da tabela `dieta`
-- 


-- --------------------------------------------------------

-- 
-- Estrutura da tabela `produtos`
-- 

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE `produtos` (
  `CDPRODUTO` int(11) NOT NULL auto_increment COMMENT 'Código',
  `NMPRODUTO` varchar(50) collate utf8_bin NOT NULL COMMENT 'Nome',
  `DSPRODUTO` varchar(200) collate utf8_bin default NULL COMMENT 'Descrição',
  `QTDPROD` int(11) NOT NULL default '0' COMMENT 'Quantidade',
  `TIPOPROD` varchar(1) collate utf8_bin NOT NULL COMMENT 'Tipo / ''M'', ''O'', ''A''',
  PRIMARY KEY  (`CDPRODUTO`),
  KEY `NMPRODUTO` (`NMPRODUTO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- 
-- Extraindo dados da tabela `produtos`
-- 


-- --------------------------------------------------------

-- 
-- Estrutura da tabela `usuarios`
-- 

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `CDUSUARIO` int(11) NOT NULL auto_increment COMMENT 'Código',
  `NMLOGIN` varchar(50) collate utf8_bin NOT NULL COMMENT 'Login',
  `CDSENHA` varchar(40) collate utf8_bin NOT NULL COMMENT 'Senha',
  `IDADMIN` varchar(1) collate utf8_bin NOT NULL COMMENT 'A ou M / admin ou membro',
  `CDNOME` varchar(50) collate utf8_bin NOT NULL COMMENT 'Nome',
  `CDCPF` varchar(12) collate utf8_bin default NULL COMMENT 'CPF',
  `IDATIVO` varchar(1) collate utf8_bin NOT NULL COMMENT 'S OU N',
  PRIMARY KEY  (`CDUSUARIO`),
  KEY `NMLOGIN` (`NMLOGIN`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- 
-- Extraindo dados da tabela `usuarios`
-- 

INSERT INTO `usuarios` VALUES (1, 0x61646d696e, 0x3230326362393632616335393037356239363462303731353264323334623730, 0x41, 0x41646d696e6973747261646f72, 0x313131313131313131313131, 0x53);
