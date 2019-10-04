-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 04-Out-2019 às 05:41
-- Versão do servidor: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saboresdomundo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao`
--

CREATE TABLE `avaliacao` (
  `id` int(11) NOT NULL,
  `receita` int(11) NOT NULL,
  `avaliacao` varchar(20) NOT NULL,
  `usuario` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `avaliacao`
--

INSERT INTO `avaliacao` (`id`, `receita`, `avaliacao`, `usuario`, `timestamp`) VALUES
(1, 1, '4', 2, '2019-09-29 21:01:17'),
(3, 1, '4', 2, '2019-09-29 21:06:50'),
(4, 1, '4', 2, '2019-09-29 21:06:51'),
(5, 1, '4', 2, '2019-09-29 21:08:11'),
(6, 1, '5', 15, '2019-10-02 01:51:47'),
(7, 1, '5', 15, '2019-10-02 01:52:47'),
(8, 1, '5', 15, '2019-10-02 01:54:04'),
(18, 1, '5', 15, '2019-10-02 02:01:17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `titulo` varchar(50) CHARACTER SET latin1 NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `titulo`, `timestamp`) VALUES
(1, 'Carnes', '2019-09-18 00:31:45'),
(2, 'Massas', '2019-09-25 02:24:00'),
(3, 'Massas', '2019-09-25 02:49:27'),
(4, 'Massas', '2019-09-25 03:30:43'),
(5, 'Frango Assado', '2019-10-02 02:13:37'),
(6, 'Frango Assado', '2019-10-02 02:14:09'),
(7, 'Frango Assado', '2019-10-02 02:14:13'),
(8, 'SalomÃƒÂ£o Assado', '2019-10-02 02:15:29'),
(9, 'SalomÃƒÂ£o Assado', '2019-10-02 02:17:59'),
(10, 'SalomÃƒÂ£o Assado', '2019-10-02 02:18:00'),
(11, 'SalomÃ£o Assado', '2019-10-02 02:19:10'),
(12, 'SalomÃ£o Assado', '2019-10-02 02:19:11'),
(13, 'SalomÃ£o Assado', '2019-10-02 02:19:12'),
(14, 'SalomÃ£o Assado', '2019-10-02 02:19:12'),
(15, 'SalomÃ£o Assado', '2019-10-02 02:19:12'),
(16, 'SalomÃ£o Assado', '2019-10-02 02:19:13'),
(17, 'SalomÃ£o Assado', '2019-10-02 02:20:04'),
(18, 'SalomÃ£o Assado', '2019-10-02 02:20:04'),
(19, 'SalomÃ£o Assado', '2019-10-02 02:20:36'),
(20, 'SalomÃ£o Assado', '2019-10-02 02:20:36'),
(21, 'SalomÃ£o Assado', '2019-10-02 02:20:37'),
(22, 'SalomÃ£o Assado', '2019-10-02 02:20:37'),
(23, 'SalomÃ£o Assado', '2019-10-02 02:21:56'),
(24, 'SalomÃ£o Assado', '2019-10-02 02:21:56'),
(25, 'SalomÃ£o Assado', '2019-10-02 02:23:13'),
(26, 'SalomÃ£o Assado', '2019-10-02 02:23:14'),
(27, 'SalomÃ£o Assado', '2019-10-02 02:23:14'),
(28, 'SalomÃ£o Assado', '2019-10-02 02:23:36'),
(29, 'SalomÃ£o Assado', '2019-10-02 02:53:35'),
(30, 'SalomÃ£o Assado', '2019-10-03 00:58:37');

-- --------------------------------------------------------

--
-- Estrutura da tabela `foto_receita`
--

CREATE TABLE `foto_receita` (
  `id` int(11) NOT NULL,
  `receita` int(11) NOT NULL,
  `path_foto` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ingrediente`
--

CREATE TABLE `ingrediente` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `medida` varchar(15) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ingrediente`
--

INSERT INTO `ingrediente` (`id`, `nome`, `medida`, `timestamp`) VALUES
(1, 'ovo', 'unidade', '2019-09-25 02:13:50'),
(2, 'ovo', 'unidade', '2019-09-25 02:15:01');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ingrediente_receita`
--

CREATE TABLE `ingrediente_receita` (
  `id` int(11) NOT NULL,
  `ingrediente` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `receita` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ingrediente_receita`
--

INSERT INTO `ingrediente_receita` (`id`, `ingrediente`, `quantidade`, `receita`, `timestamp`) VALUES
(1, 5, 15, 7, '2019-10-01 00:56:43');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pais`
--

CREATE TABLE `pais` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `localidade` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pais`
--

INSERT INTO `pais` (`id`, `nome`, `localidade`, `timestamp`) VALUES
(1, 'Brasil', 'Ameria Latina', '2019-09-25 02:04:41'),
(2, 'Brasil', 'Ameria Latina', '2019-09-25 02:05:36'),
(3, 'Brasil', 'Ameria Latina', '2019-09-25 02:05:52');

-- --------------------------------------------------------

--
-- Estrutura da tabela `receita`
--

CREATE TABLE `receita` (
  `id` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `modo_preparo` text NOT NULL,
  `usuario` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `receita`
--

INSERT INTO `receita` (`id`, `titulo`, `modo_preparo`, `usuario`, `timestamp`) VALUES
(1, 'Minha Primeira Receita', 'Adiciona tudo no fogo e deixa rolar', 5, '2019-09-25 01:48:50');

-- --------------------------------------------------------

--
-- Estrutura da tabela `receita_favorita`
--

CREATE TABLE `receita_favorita` (
  `id` int(11) NOT NULL,
  `receita` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `receita_favorita`
--

INSERT INTO `receita_favorita` (`id`, `receita`, `usuario`, `timestamp`) VALUES
(1, 1, 25, '2019-10-01 00:59:46');

-- --------------------------------------------------------

--
-- Estrutura da tabela `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `endpoint` text COLLATE utf8_unicode_ci,
  `auth` text COLLATE utf8_unicode_ci,
  `p256dh` text COLLATE utf8_unicode_ci,
  `usuario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `nascimento` date NOT NULL,
  `email` varchar(80) NOT NULL,
  `senha` varchar(80) NOT NULL,
  `changelog` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `nascimento`, `email`, `senha`, `changelog`) VALUES
(1, 'Higor', '0000-00-00', 'gg@gmail.com', '1234', '2019-09-13 00:18:19'),
(2, 'Higor', '0000-00-00', 'gg@gmail.com', '1234', '2019-09-13 00:20:56'),
(3, 'Higor', '0000-00-00', 'gg@gmail.com', '1234', '2019-09-13 00:20:57'),
(4, 'Higor', '0000-00-00', 'gg@gmail.com', '1234', '2019-09-13 00:20:57'),
(5, 'Higor', '0000-00-00', 'gg@gmail.com', '1234', '2019-09-13 00:20:58'),
(6, 'Higor', '0000-00-00', 'gg@gmail.com', '1234', '2019-09-13 00:20:58'),
(7, 'Higor', '0000-00-00', 'gg@gmail.com', '1234', '2019-09-13 00:20:58'),
(8, 'Higor', '0000-00-00', 'gg@gmail.com', '1234', '2019-09-13 00:20:59'),
(9, 'alinson', '0000-00-00', 'gg@gmail.com', '987', '2019-09-13 00:45:38'),
(10, 'Nivaldo', '2018-11-20', 'gg@gmail.com', '1234', '2019-09-13 00:21:00'),
(11, 'Higor', '0000-00-00', 'gg@gmail.com', '1234', '2019-09-13 00:21:00'),
(12, 'Higor', '0000-00-00', 'gg@gmail.com', '1234', '2019-09-13 00:21:00'),
(13, 'Higor', '0000-00-00', 'gg@gmail.com', '1234', '2019-09-13 00:21:01'),
(14, 'Higor', '0000-00-00', 'gg@gmail.com', '1234', '2019-09-13 00:21:01'),
(15, 'alinson', '0000-00-00', 'gg@gmail.com', '1234', '2019-09-13 00:21:01'),
(16, 'Higor', '0000-00-00', 'gg@gmail.com', '1234', '2019-09-13 00:21:02'),
(17, 'Higor', '0000-00-00', 'gg@gmail.com', '1234', '2019-09-13 00:21:02'),
(18, 'Higor', '0000-00-00', 'gg@gmail.com', '1234', '2019-09-13 00:21:02'),
(19, 'Higor', '0000-00-00', 'gg@gmail.com', '1234', '2019-09-13 00:21:03'),
(20, 'Higor', '0000-00-00', 'gg@gmail.com', '1234', '2019-09-13 00:21:03'),
(21, 'Higor', '0000-00-00', 'gg@gmail.com', '1234', '2019-09-13 00:23:38'),
(22, 'Higor', '0000-00-00', 'gg@gmail.com', '1234', '2019-09-17 22:24:09'),
(23, 'Higor', '0000-00-00', 'gg@gmail.com', '1234', '2019-09-17 22:24:28'),
(24, 'Higor', '0000-00-00', 'gg@gmail.com', '1234', '2019-09-17 22:24:29'),
(25, 'Higor', '0000-00-00', 'gg@gmail.com', '1234', '2019-09-17 22:24:30'),
(26, 'Higor', '0000-00-00', 'gg@gmail.com', '1234', '2019-09-17 22:25:33'),
(27, 'Higor', '0000-00-00', 'gg@gmail.com', '1234', '2019-09-17 22:26:04'),
(28, 'Higor', '0000-00-00', 'gg@gmail.com', '1234', '2019-09-17 22:26:33'),
(29, 'Higor', '0000-00-00', 'gg@gmail.com', '1234', '2019-09-17 22:27:04'),
(30, 'JoÃ£o', '0000-00-00', 'JoÃ£o@joÃ£o.com', '1234', '2019-09-17 22:29:45'),
(31, 'JosÃƒÂ©', '0000-00-00', 'JoÃƒÂ£o@joÃƒÂ£o.com', '1234', '2019-09-17 22:32:24'),
(32, 'José', '0000-00-00', 'JoÃƒÂ£o@joÃƒÂ£o.com', '1234', '2019-09-17 22:33:29'),
(33, 'José', '0000-00-00', 'João@joão.com', '1234', '2019-09-17 22:34:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foto_receita`
--
ALTER TABLE `foto_receita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingrediente_receita`
--
ALTER TABLE `ingrediente_receita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receita`
--
ALTER TABLE `receita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receita_favorita`
--
ALTER TABLE `receita_favorita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avaliacao`
--
ALTER TABLE `avaliacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `foto_receita`
--
ALTER TABLE `foto_receita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ingrediente`
--
ALTER TABLE `ingrediente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ingrediente_receita`
--
ALTER TABLE `ingrediente_receita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pais`
--
ALTER TABLE `pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `receita`
--
ALTER TABLE `receita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `receita_favorita`
--
ALTER TABLE `receita_favorita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
