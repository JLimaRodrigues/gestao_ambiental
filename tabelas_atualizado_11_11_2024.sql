-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 11/11/2024 às 15:09
-- Versão do servidor: 5.7.23-23
-- Versão do PHP: 8.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gestam16_gestao_ambiental`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `campo_atuacao`
--

CREATE TABLE `campo_atuacao` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `campo_atuacao`
--

INSERT INTO `campo_atuacao` (`id`, `descricao`) VALUES
(1, 'Requisitos Gerais'),
(2, 'Gestão de Resíduos Sólidos'),
(3, 'Gestão de Recursos Hídricos'),
(4, 'Uso e Ocupação do Solo'),
(5, 'Abastecimento-Manutenção'),
(6, 'Mecânica-Rampa de Lavagem'),
(7, 'Lubrificação'),
(8, 'Estoque de Produtos Químicos'),
(9, 'Emissões Atmosféricas-Qualidade do Ar'),
(10, 'Medidas de Emergência'),
(11, 'Controle de Vetores'),
(12, 'Preparo e Emprego da Tropa'),
(13, 'Educação Ambiental'),
(14, 'Licitações'),
(15, 'Combates a Perdas e Desperdícios');

-- --------------------------------------------------------

--
-- Estrutura para tabela `fotos`
--

CREATE TABLE `fotos` (
  `id_fotos` int(11) NOT NULL,
  `nome_arquivo` varchar(50) NOT NULL,
  `data` date NOT NULL,
  `id_setor` int(11) DEFAULT NULL,
  `id_subsecao` int(11) DEFAULT NULL,
  `id_local` int(11) DEFAULT NULL,
  `id_ocorrencia` int(11) DEFAULT NULL,
  `observacao` varchar(200) NOT NULL,
  `conforme` varchar(1) NOT NULL,
  `lcastanheira` int(11) DEFAULT NULL,
  `limbauba` int(11) DEFAULT NULL,
  `lpaubrasil` int(11) DEFAULT NULL,
  `id_campo_atuacao` int(11) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `lista_castanheira`
--

CREATE TABLE `lista_castanheira` (
  `id` int(11) NOT NULL,
  `item` varchar(10) NOT NULL,
  `desc_item` varchar(255) NOT NULL,
  `descricao` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `lista_castanheira`
--

INSERT INTO `lista_castanheira` (`id`, `item`, `desc_item`, `descricao`) VALUES
(1, '01', 'Plano de Gestão Ambiental', 'Possui o Plano de Gestão Ambiental atualizado conforme IR 50-20.'),
(2, '02', 'Capacitação para Impactos Ambientais', 'Envolvidos em atividades de impacto ambiental negativo possuem capacitação específica.'),
(3, '03', 'Conhecimento dos Impactos Negativos', 'A OM tem conhecimento dos impactos ambientais negativos não tratados.'),
(4, '04', 'Solicitação de Apoio para Impactos Negativos', 'A OM solicitou apoio e recursos para tratar os impactos ambientais negativos identificados.'),
(5, '05', 'Interações com o Meio Ambiente', 'A OM conhece suas atividades mais importantes que interagem com o meio ambiente.'),
(6, '06', 'Ações para Minimizar Impactos Negativos', 'Existem ações para minimizar os impactos ambientais negativos da OM.'),
(7, '07', 'Gestão à Vista', 'A OM usa gestão à vista para comunicação e divulgação de capacitação ambiental e indicadores.'),
(8, '08', 'Educação Ambiental Específica', 'A OM desenvolve trabalhos de educação ambiental para os integrantes, como palestras e folhetos.'),
(9, '09', 'Segregação de Resíduos', 'Existe segregação mínima de resíduos comuns com coletores específicos e em quantidade adequada.'),
(10, '10', 'Destinação de Resíduos Recicláveis', 'A OM destina resíduos recicláveis a cooperativas e empresas de reciclagem licenciadas.'),
(11, '11', 'Acondicionamento de Resíduos Orgânicos', 'A OM acondiciona resíduos orgânicos em coletores tampados e protegidos.'),
(12, '12', 'Política de Redução de Desperdício Orgânico', 'A OM possui política para redução de desperdício de resíduos orgânicos.'),
(13, '13', 'Controle de Quantidade de Resíduos', 'A OM controla a quantidade diária, semanal e mensal de resíduos produzidos.'),
(14, '14', 'Controle dos Tipos de Resíduos', 'A OM controla os tipos de resíduos gerados conforme as atividades.'),
(15, '15', 'Destinação de Resíduos de Animais', 'Os resíduos de dejetos dos animais são tratados para evitar destinação pública.'),
(16, '16', 'Destinação por Logística Reversa', 'Resíduos sólidos são destinados prioritariamente por logística reversa, conforme PNRS.'),
(17, '17', 'Limpeza de Caixas de Gordura e Fossas', 'A OM realiza limpeza periódica das caixas de gordura e fossas sépticas.'),
(18, '18', 'Comissão de Gerenciamento de Resíduos de Saúde', 'Há comissão de gerenciamento de resíduos de saúde, publicada em BI.'),
(19, '19', 'Destinação de Óleos Lubrificantes', 'Óleos usados para rerrefino são destinados a empresas licenciadas pela ANP.'),
(20, '20', 'Controle de Consumo de Água', 'A OM possui registro de controle do consumo de água.'),
(21, '21', 'Conservação das Caixas de Gordura', 'As caixas de gordura estão bem conservadas e funcionais.'),
(22, '22', 'Manutenção de Sistemas de Efluentes', 'A OM realiza manutenção adequada dos sistemas de tratamento de efluentes.'),
(23, '23', 'Operador Qualificado para ETE/ETA', 'A OM possui empresa ou operador capacitado para ETE/ETA.'),
(24, '24', 'Autorização para Poço Artesiano Desativado', 'A OM tem autorização para desativação de poço do órgão competente.'),
(25, '25', 'Análise dos Pontos de Consumo Externo', 'A OM analisa os pontos de consumo para atendimento ao público externo.'),
(26, '26', 'Separação de Água da Chuva do Esgoto', 'A OM possui estrutura para separar a água da chuva do esgoto.'),
(27, '27', 'Critérios de Sustentabilidade em Licitações', 'Existem critérios de sustentabilidade nos processos de licitação.'),
(28, '28', 'Logística Reversa em Contratos', 'A OM inclui logística reversa de produtos em contratos e licitações.'),
(29, '29', 'Identificação de Áreas Degradadas', 'As áreas degradadas da OM foram identificadas.'),
(30, '30', 'Monitoramento de Recuperação de Áreas', 'A OM monitora a recuperação das áreas degradadas.'),
(31, '31', 'Responsabilidade Ambiental em Contratos de Arrendamento', 'Contratos de áreas arrendadas definem responsabilidade ambiental.'),
(32, '32', 'Cadastro e Autorização do P Distr Cl III', 'O Posto de Distribuição Classe III está cadastrado e autorizado pela ANP.'),
(33, '33', 'Limpeza da Caixa Separadora de Água e Óleo', 'A OM realiza limpeza periódica da caixa separadora de água e óleo.'),
(34, '34', 'Identificação de Produtos Químicos', 'Produtos químicos fracionados são identificados e rotulados com simbologia de risco.'),
(35, '35', 'Estocagem de Produtos Inflamáveis', 'Produtos inflamáveis são estocados em ambientes resistentes ao fogo.'),
(36, '36', 'Posição dos Produtos Corrosivos no Estoque', 'Produtos corrosivos são armazenados na parte inferior do estoque.'),
(37, '37', 'Extintores e Avisos de Não Fumar', 'Existem extintores e avisos de \"Não Fumar\" próximos à estocagem de inflamáveis.'),
(38, '38', 'Plano de Manutenção de Máquinas', 'A OM possui plano de manutenção de máquinas e equipamentos.'),
(39, '39', 'Lacre e Segurança dos Extintores', 'Extintores estão com lacre e grampo de segurança.'),
(40, '40', 'Certificação da Empresa de Extintores', 'A empresa de extintores é certificada pelo Corpo de Bombeiros e INMETRO.'),
(41, '41', 'Capacitação para Uso de Extintores', 'Há militares e/ou civis capacitados para manusear extintores e hidrantes.'),
(42, '42', 'Sinalização de Emergência', 'A OM possui sinalização de emergência, incluindo rotas de fuga.'),
(43, '43', 'Sistema de Combate a Incêndio', 'Sistema de combate a incêndio está em boas condições e passa por manutenções.'),
(44, '44', 'Sirene de Alerta', 'A OM possui sirene de alerta.'),
(45, '45', 'Plano de Prevenção e Combate a Incêndio', 'A OM possui plano de prevenção e combate a incêndio do ano corrente.'),
(46, '46', 'Aceiros Florestais', 'A unidade realiza aceiros florestais.'),
(47, '47', 'Programa para Reduzir Perdas e Desperdícios de Água', 'A OM possui programa para reduzir e prevenir desperdícios de água.'),
(48, '48', 'Economia de Energia', 'A OM possui métodos para proporcionar economia de energia elétrica.'),
(49, '49', 'Ventilação e Iluminação Natural', 'A OM prioriza o uso de ventilação e iluminação natural.'),
(50, '50', 'Controle Integrado de Pragas e Vetores', 'A OM possui programa integrado de controle de pragas e vetores.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `lista_imbauba`
--

CREATE TABLE `lista_imbauba` (
  `id` int(11) NOT NULL,
  `item` varchar(10) NOT NULL,
  `desc_item` varchar(255) NOT NULL,
  `descricao` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `lista_imbauba`
--

INSERT INTO `lista_imbauba` (`id`, `item`, `desc_item`, `descricao`) VALUES
(1, '01', 'Materiais de Amianto', 'A OM ainda possui telhas, caixas d´água ou qualquer material de amianto?'),
(2, '02', 'Publicação do Responsável Ambiental', 'O responsável pelo meio ambiente foi publicado em boletim junto com seu substituto?'),
(3, '03', 'Capacitação em Gestão Ambiental', 'Os responsáveis pela gestão ambiental possuem capacitação pelo AVPIMA?'),
(4, '04', 'Plano de Gerenciamento de Resíduos Sólidos', 'Possui PGRS com responsável técnico conforme legislação vigente?'),
(5, '05', 'Local para Armazenamento de Resíduos', 'Possui local apropriado para armazenamento de resíduos diversos?'),
(6, '06', 'Armazenamento de Pneus Usados', 'A OM armazena pneus usados em local protegido contra intempéries?'),
(7, '07', 'Acondicionamento de Resíduos Perigosos', 'Resíduos perigosos são acondicionados conforme legislação?'),
(8, '08', 'Armazenamento de Óleos e Graxas', 'Óleos e graxas são armazenados em recipientes resistentes a vazamentos?'),
(9, '09', 'Transporte de Resíduos Perigosos', 'Resíduos perigosos são transportados conforme legislação?'),
(10, '10', 'Destinação de Resíduos Perigosos', 'Resíduos perigosos são destinados para empresas licenciadas conforme legislação?'),
(11, '11', 'Destinação de Resíduos Não Perigosos', 'Resíduos não perigosos são destinados conforme legislação?'),
(12, '12', 'Plano de Gerenciamento de Resíduos de Saúde', 'Possui PGRSS com responsável técnico conforme legislação vigente?'),
(13, '13', 'Armazenamento de Resíduos de Saúde', 'Resíduos de saúde são armazenados adequadamente conforme legislação?'),
(14, '14', 'Posição de Recipientes Perfurocortantes', 'Recipientes perfurocortantes estão posicionados adequadamente?'),
(15, '15', 'Transporte Interno de Resíduos de Saúde', 'Transporte interno de resíduos de saúde é realizado conforme legislação vigente?'),
(16, '16', 'Transporte Externo de Resíduos de Saúde', 'Transporte externo de resíduos de saúde é feito com segurança e em bombonas lacradas.'),
(17, '17', 'Destinação de Resíduos de Saúde', 'Destinação final dos resíduos de saúde é realizada para OM ou empresa licenciada.'),
(18, '18', 'Comprovante de Transporte de Resíduos', 'Todos os resíduos possuem CTR ou MTR conforme legislação?'),
(19, '19', 'Certificado de Destinação Final de Resíduos', 'Todos os resíduos possuem Certificado de Destinação Final conforme legislação vigente.'),
(20, '20', 'Cadastro de Usuários de Recursos Hídricos', 'OM que usa recursos hídricos possui o CNARH conforme exigido?'),
(21, '21', 'Outorga para Captação de Água', 'Captação de água por poços ou corpos de água é outorgada ou dispensada conforme legislação?'),
(22, '22', 'Controle de Qualidade da Água', 'OM sem abastecimento de concessionária controla qualidade da água conforme legislação?'),
(23, '23', 'Higienização de Reservatórios de Água', 'Bebedouros e reservatórios são higienizados periodicamente conforme legislação?'),
(24, '24', 'Licença para Operação de ETE', 'OM possui inexigibilidade de licença ou licença para Operação de ETE?'),
(25, '25', 'Monitoramento de Efluentes Tratados', 'OM monitora tratamento e lançamento de efluentes conforme legislação?'),
(26, '26', 'Outorga para Lançamento de Efluentes', 'OM que possui ETE tem outorga para lançamento do efluente tratado em corpos de água?'),
(27, '27', 'Tratamento de Efluentes', 'Todos os efluentes gerados são tratados conforme a legislação vigente.'),
(28, '28', 'Respeito às Áreas de Preservação Permanente', 'Áreas de Preservação Permanente são respeitadas conforme a legislação vigente?'),
(29, '29', 'Autorização de Supressão Vegetal', 'Supressão vegetal é realizada com Autorização de Supressão Vegetal (ASV).'),
(30, '30', 'Licença para Uso de Motosserra', 'Motosserra e operador da OM possuem licença para porte e uso no IBAMA.'),
(31, '31', 'Projeto de Recuperação de Áreas Degradadas', 'Áreas degradadas possuem PRAD em andamento com cronograma.'),
(32, '32', 'Cadastro e Autorização do P Distr Cl III', 'O Posto de Distribuição Classe III está cadastrado e autorizado pela ANP.'),
(33, '33', 'Atendimento das Condicionantes do P Distr Cl III', 'P Distr Cl III licenciado possui suas condicionantes atendidas.'),
(34, '34', 'Área Impermeável em Postos de Abastecimento', 'Postos possuem área impermeável com canaletas para caixa separadora de água e óleo.'),
(35, '35', 'Separação de Águas Contaminadas', 'Águas de chuva e de lavagem de viaturas com óleo são direcionadas para caixa separadora.'),
(36, '36', 'Bacias de Contenção para Tanques de Combustíveis', 'Tanques possuem bacias de contenção dimensionadas conforme legislação.'),
(37, '37', 'Armazenamento de Produtos Químicos', 'Produtos químicos armazenados com bacias de contenção adequadas.'),
(38, '38', 'Manuseio de Produtos Químicos', 'Produtos químicos são manuseados conforme FDS disponível próxima ao produto.'),
(39, '39', 'Controle de Emissões Atmosféricas', 'Fumaça de escapamentos de veículos a diesel está de acordo com a escala Ringelmann.'),
(40, '40', 'Plano de Manutenção de Climatização (PMOC)', 'OM possui PMOC dos sistemas de climatização e segue o plano.'),
(41, '41', 'Equipe de Combate a Incêndio', 'Existe equipe treinada para combate a incêndio publicada em BI.'),
(42, '42', 'Equipamentos de Combate a Incêndio', 'Equipamentos estão visíveis, sinalizados e dimensionados conforme previsto.'),
(43, '43', 'Plano de Atendimento à Emergências', 'OM possui Plano de Atendimento à Emergências ambientais para transporte de resíduos.'),
(44, '44', 'Kit de Emergência para Derramamento', 'OM dispõe de kit de emergência para derramamento de óleo/produtos químicos.'),
(45, '45', 'Licença para Dedetização e Desratização', 'Empresa responsável por dedetização e desratização possui licença e registro.'),
(46, '46', 'Destinação Adequada de Resíduos em Campos de Instrução', 'OM destina adequadamente resíduos nos campos de instrução.'),
(47, '47', 'Preservação das Árvores em Campos de Instrução', 'Preservação da área é realizada evitando o corte de árvores.'),
(48, '48', 'Preservação dos Cursos de água', 'Preservação de cursos de água é realizada nos campos de instrução.'),
(49, '49', 'Preservação dos Animais Silvestres', 'Preservação dos animais silvestres é realizada durante instruções.'),
(50, '50', 'Equipe de Prevenção de Incêndios em Acampamentos', 'Equipe de prevenção e combate a incêndios é designada em acampamentos.'),
(51, '51', 'Prevenção de Acidentes com Animais Peçonhentos', 'OM realiza instruções para prevenir acidentes com animais peçonhentos.'),
(52, '52', 'Proteção contra Vetores de Doenças', 'OM toma medidas de proteção contra vetores durante manobras e acampamentos.'),
(53, '53', 'Cuidados Ambientais em Ordens de Instrução', 'Ordens de instrução incluem cuidados ambientais.'),
(54, '54', 'Recuperação da Cobertura Vegetal no Estande de Tiro', 'Prevê-se recuperação da cobertura vegetal nas áreas de erosão.'),
(55, '55', 'Uso de Cal nas Áreas de Latrina', 'Cal e material seco são colocados nas áreas de latrina durante instruções.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `lista_pau_brasil`
--

CREATE TABLE `lista_pau_brasil` (
  `id` int(11) NOT NULL,
  `item` varchar(10) NOT NULL,
  `desc_item` varchar(255) NOT NULL,
  `descricao` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `lista_pau_brasil`
--

INSERT INTO `lista_pau_brasil` (`id`, `item`, `desc_item`, `descricao`) VALUES
(1, '01', 'Objetivos e Metas', 'Os objetivos e metas foram definidos de forma desafiadora e alcançável no PGA.'),
(2, '02', 'Controle de Recursos Naturais', 'A OM controla o consumo de todos os recursos naturais, como água e energia, por indicadores.'),
(3, '03', 'Consumo de Papel', 'A OM acompanha o consumo de papel usado para impressão e cópias.'),
(4, '04', 'Uso de Papel Reciclado', 'A OM utiliza papel não-clorado ou reciclado.'),
(5, '05', 'Reutilização de Papel', 'A OM promove a reutilização do papel A4 antes de enviá-lo para reciclagem, como na confecção de blocos de anotação.'),
(6, '06', 'Campanhas de Conscientização', 'A OM promove campanhas de racionalização para uso consciente de copos plásticos, energia, água e papel.'),
(7, '07', 'Disponibilização de Copos Permanentes', 'A OM disponibiliza copos permanentes para todos os militares e servidores.'),
(8, '08', 'Redução do Consumo de Energia', 'A OM utiliza equipamentos que reduzem o consumo de energia, como ar condicionado eficiente e sensores de presença.'),
(9, '09', 'Campanhas sobre Uso de Fumo e Álcool', 'A OM promove campanhas sobre o uso de fumo e álcool.'),
(10, '10', 'Incentivo ao Uso de Bicicletas', 'A OM possui bicicletário para incentivar o uso de bicicletas pelos militares e servidores.'),
(11, '11', 'Distribuição de Kits Ambientais', 'A OM distribui kits ambientais com instruções sobre qualidade de vida.'),
(12, '12', 'Controle da Qualidade do Ar', 'A OM monitora a qualidade do ar em ambientes coletivos com ar condicionado.'),
(13, '13', 'Ginástica Laboral', 'A OM oferece ginástica laboral e equipamentos ergométricos para os militares e servidores.'),
(14, '14', 'Consumo de Energia Solar', 'A OM utiliza placas solares para consumo de energia.'),
(15, '15', 'Uso de Madeira Certificada', 'A OM prioriza o uso de madeira certificada e materiais de fontes sustentáveis.'),
(16, '16', 'Parcerias de Educação Ambiental', 'A OM participa de parcerias no desenvolvimento de programas de educação e conservação ambiental.'),
(17, '17', 'Cartilhas Educativas', 'A OM desenvolve cartilhas educativas sobre sustentabilidade para capacitação de militares e servidores.'),
(18, '18', 'Celebração de Datas Comemorativas', 'A OM celebra datas comemorativas relacionadas à sustentabilidade.'),
(19, '19', 'Cláusulas de Educação Ambiental em Contratos', 'A OM inclui cláusulas de capacitação em educação ambiental para funcionários terceirizados.'),
(20, '20', 'Coletores para Resíduos Recicláveis', 'A OM possui coletores para tipos de resíduos recicláveis e orgânicos em quantidade suficiente.'),
(21, '21', 'Reutilização de Resíduos Orgânicos', 'A OM reutiliza resíduos orgânicos para biodigestão e/ou compostagem.'),
(22, '22', 'Coletores de Lixo Orgânico e Seco', 'A OM possui coletores para separação de lixo orgânico e seco nas copas.'),
(23, '23', 'Estudo de Viabilidade para Ecoponto', 'A OM estuda a viabilidade de um ecoponto para coleta de pilhas, baterias e óleo de cozinha.'),
(24, '24', 'Coleta de Resíduos Perigosos', 'A OM possui contratos com cooperativas para coleta e destinação de resíduos perigosos.'),
(25, '25', 'Levantamento de Resíduos Orgânicos', 'A OM realiza levantamento de resíduos orgânicos em restaurantes e lanchonetes para destinação adequada.'),
(26, '26', 'Destinação de Resíduos de Construção Civil', 'A OM vincula ao contrato de obra a destinação correta dos resíduos de construção civil.'),
(27, '27', 'Plantio de Árvores', 'A OM realiza o plantio de mudas e árvores.'),
(28, '28', 'Reuso de Água para Lavagem de Veículos', 'A OM utiliza água de captação de chuvas para lavagem de viaturas.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `local`
--

CREATE TABLE `local` (
  `id` int(11) NOT NULL,
  `local` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ocorrencia`
--

CREATE TABLE `ocorrencia` (
  `id` int(11) NOT NULL,
  `ocorrencia` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `setores`
--

CREATE TABLE `setores` (
  `id` int(11) NOT NULL,
  `setor` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `subsecoes`
--

CREATE TABLE `subsecoes` (
  `id` int(11) NOT NULL,
  `subsecao` varchar(30) NOT NULL,
  `setor_superior` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `admin` varchar(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `usuario`, `senha`, `email`, `admin`) VALUES
(1, 'douglas', 'douglas', '$2y$10$JcW/MUHytTPl6/.XxVWTYuwYk7c7Qf9bawSa95twUkl7vqo3E9HXy', 'douglas.marcondes@gmail.com', 'S'),
(2, 'marcondes', 'marcondes', '$2y$10$wDbSJga88QL.pxgtzeoHouxOKzuHOoBP00kYXfP8QG9NnFDf.35X6', 'celcavmarcondes@gmail.com', 'S'),
(3, 'admin', 'admin', '$2y$10$m0pLBg9mmKSHtbdz8vQOXe51fMCUSe5RnMGkDbeETNwgdZPVIuHNO', 'admin@gmail.com', 'S');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `campo_atuacao`
--
ALTER TABLE `campo_atuacao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`id_fotos`);

--
-- Índices de tabela `lista_castanheira`
--
ALTER TABLE `lista_castanheira`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `lista_imbauba`
--
ALTER TABLE `lista_imbauba`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `lista_pau_brasil`
--
ALTER TABLE `lista_pau_brasil`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `local`
--
ALTER TABLE `local`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ocorrencia`
--
ALTER TABLE `ocorrencia`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `setores`
--
ALTER TABLE `setores`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `subsecoes`
--
ALTER TABLE `subsecoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `campo_atuacao`
--
ALTER TABLE `campo_atuacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id_fotos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `lista_castanheira`
--
ALTER TABLE `lista_castanheira`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de tabela `lista_imbauba`
--
ALTER TABLE `lista_imbauba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de tabela `lista_pau_brasil`
--
ALTER TABLE `lista_pau_brasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `local`
--
ALTER TABLE `local`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `ocorrencia`
--
ALTER TABLE `ocorrencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `setores`
--
ALTER TABLE `setores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `subsecoes`
--
ALTER TABLE `subsecoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;