CREATE DATABASE estaciona_aqui;

USE estaciona_aqui;

-- Tabela tipo_vaga
CREATE TABLE `tipo_vaga` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` enum('MOTO','CARRO PEQUENO','CARRO GRANDE','CAMINHÃO') NOT NULL,
  PRIMARY KEY (`id`)
);

-- Tabela status
CREATE TABLE `status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
);

-- Tabela tarifa
CREATE TABLE `tarifa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo_vaga_id` int NOT NULL,
  `data_inicio` datetime DEFAULT CURRENT_TIMESTAMP,
  `data_fim` date DEFAULT NULL,
  `valor_primeira_hora` decimal(10,2) NOT NULL,
  `valor_demais_horas` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_vaga_id` (`tipo_vaga_id`),
  CONSTRAINT `tarifa_ibfk_1` FOREIGN KEY (`tipo_vaga_id`) REFERENCES `tipo_vaga` (`id`)
);

-- 4. Tabela veiculo
CREATE TABLE `veiculo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `proprietario` varchar(100) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `placa` varchar(20) NOT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `cor` varchar(30) DEFAULT NULL,
  `tipo_vaga_id` int NOT NULL,
  `tarifa_id` int NOT NULL,
  `vaga` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_vaga_id` (`tipo_vaga_id`),
  KEY `tarifa_id` (`tarifa_id`),
  CONSTRAINT `veiculo_ibfk_1` FOREIGN KEY (`tipo_vaga_id`) REFERENCES `tipo_vaga` (`id`),
  CONSTRAINT `veiculo_ibfk_2` FOREIGN KEY (`tarifa_id`) REFERENCES `tarifa` (`id`)
);

-- Tabela veiculo_status
CREATE TABLE `veiculo_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `veiculo_id` int NOT NULL,
  `status_id` int NOT NULL,
  `data_inicio` datetime DEFAULT CURRENT_TIMESTAMP,
  `data_fim` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `veiculo_id` (`veiculo_id`),
  KEY `status_id` (`status_id`),
  CONSTRAINT `veiculo_status_ibfk_1` FOREIGN KEY (`veiculo_id`) REFERENCES `veiculo` (`id`),
  CONSTRAINT `veiculo_status_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
);

-- Tabela configuracao_vaga
CREATE TABLE `configuracao_vaga` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo_vaga_id` int NOT NULL,
  `quantidade` int NOT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_vaga_id` (`tipo_vaga_id`),
  CONSTRAINT `configuracao_vaga_ibfk_1` FOREIGN KEY (`tipo_vaga_id`) REFERENCES `tipo_vaga` (`id`)
);

-- Tabela usuario
CREATE TABLE `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `permissoes` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
);

-- Inserts padrões
INSERT INTO tipo_vaga (tipo) VALUES 
  ('MOTO'),
  ('CARRO PEQUENO'),
  ('CARRO GRANDE'),
  ('CAMINHÃO');

INSERT INTO status (descricao) VALUES 
  ('Cancelado'),
  ('Estacionado'),
  ('Pronto para saída'),
  ('Baixa realizada');

