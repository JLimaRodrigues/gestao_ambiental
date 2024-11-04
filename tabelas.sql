SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;

-- Estrutura para a tabela `local`
CREATE TABLE `local` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `local` varchar(30) NOT NULL,
  `descricao` varchar(30) DEFAULT NULL,
  `observacao` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estrutura para a tabela `ocorrencia`
CREATE TABLE `ocorrencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ocorrencia` varchar(30) NOT NULL,
  `observacao` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estrutura para a tabela `setores`
CREATE TABLE `setores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setor` varchar(30) NOT NULL,
  `localizacao` varchar(30) DEFAULT NULL,
  `observacao` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estrutura para a tabela `subsecoes`
CREATE TABLE `subsecoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subsecao` varchar(30) NOT NULL,
  `setor_superior` int(11) NOT NULL,
  `atividade` varchar(200) DEFAULT NULL,
  `observacao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estrutura para a tabela `fotos`
CREATE TABLE `fotos` (
  `id_fotos` int(11) NOT NULL AUTO_INCREMENT,
  `nome_arquivo` varchar(50) NOT NULL,
  `data` date NOT NULL,
  `id_setor` int(11) DEFAULT NULL,
  `id_subsecao` int(11) DEFAULT NULL,
  `id_local` int(11) DEFAULT NULL,
  `id_ocorrencia` int(11) DEFAULT NULL,
  `observacao` varchar(200) NOT NULL,
  PRIMARY KEY (`id_fotos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

