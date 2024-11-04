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


-- Inserindo dados na tabela `setores`
INSERT INTO `setores` (`setor`, `localizacao`, `observacao`) VALUES
('Recursos Humanos', 'São Paulo', 'Gestão de pessoal e processos relacionados.'),
('Tecnologia da Informação', 'São Paulo', 'Suporte e desenvolvimento de sistemas.'),
('Financeiro', 'São Paulo', 'Gestão financeira e contabilidade.'),
('Marketing', 'São Paulo', 'Campanhas e estratégias de marketing.'),
('Vendas', 'São Paulo', 'Gestão de vendas e relacionamento com clientes.');

-- Inserindo dados na tabela `subsecoes`
INSERT INTO `subsecoes` (`subsecao`, `setor_superior`, `atividade`, `observacao`) VALUES
('Recrutamento', 1, 'Atração e seleção de talentos.', 'Processo de contratação.'),
('Desenvolvimento', 2, 'Desenvolvimento de novos sistemas.', 'Criação de software.'),
('Suporte Técnico', 2, 'Atendimento e resolução de problemas.', 'Suporte ao usuário.'),
('Contabilidade', 3, 'Gestão contábil e relatórios.', 'Registro financeiro.'),
('Controle de Estoque', 3, 'Gestão de produtos e materiais.', 'Controle de inventário.'),
('Comunicação', 4, 'Gestão da comunicação interna e externa.', 'Campanhas de comunicação.'),
('Pesquisa de Mercado', 4, 'Análise de mercado e concorrência.', 'Coleta de dados.'),
('Vendas Diretas', 5, 'Vendas diretas ao cliente.', 'Atendimento a clientes.'),
('Atendimento ao Cliente', 5, 'Suporte e resolução de problemas para clientes.', 'Melhorar a experiência do cliente.'),
('Gestão de Projetos', 2, 'Planejamento e execução de projetos de TI.', 'Gerenciamento de projetos de tecnologia.');

INSERT INTO `local` (`local`, `descricao`, `observacao`) VALUES
('Escritório Central', 'Local administrativo principal', 'Sede da empresa em São Paulo.'),
('Centro de Distribuição', 'Armazenamento de produtos', 'Local para estocagem e envio de produtos.'),
('Unidade de Produção', 'Fábrica principal', 'Produção e manufatura de produtos.'),
('Filial Rio de Janeiro', 'Unidade de suporte e vendas', 'Atendimento ao cliente e vendas na região.'),
('Filial Belo Horizonte', 'Suporte e atendimento', 'Apoio ao cliente e estoque regional.');

INSERT INTO `ocorrencia` (`ocorrencia`, `observacao`) VALUES
('Manutenção de Equipamento', 'Reparo e atualização de máquinas na fábrica.'),
('Treinamento de Equipe', 'Capacitação para equipe de atendimento ao cliente.'),
('Visita de Auditoria', 'Auditoria financeira para o setor de contabilidade.'),
('Reunião de Planejamento', 'Planejamento estratégico com o setor de marketing.'),
('Incidente de Segurança', 'Ocorrência relacionada à segurança física no centro de distribuição.');
