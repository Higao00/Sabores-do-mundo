-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16-Out-2019 às 12:38
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
  `path_icon` varchar(80) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `titulo`, `path_icon`, `timestamp`) VALUES
(1, 'Carnes', 'images/icon-categoria/5da65f33e30e3.jpg', '2019-10-16 00:07:15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `foto_receita`
--

CREATE TABLE `foto_receita` (
  `id` int(11) NOT NULL,
  `receita` int(11) NOT NULL,
  `path_foto` varchar(255) NOT NULL,
  `usuario` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `foto_receita`
--

INSERT INTO `foto_receita` (`id`, `receita`, `path_foto`, `usuario`, `timestamp`) VALUES
(1, 1, 'foto_receita/5da35775dda9c.jpg', 57, '2019-10-13 16:57:26'),
(2, 1, 'foto_receita/5da35776366d8.jpg', 57, '2019-10-13 16:57:26'),
(3, 1, 'foto_receita/5da3577693d02.jpg', 57, '2019-10-13 16:57:26'),
(4, 2, 'foto_receita/5da3c46b35a34.jpg', 57, '2019-10-14 00:42:19'),
(5, 2, 'foto_receita/5da3c46bb0ee4.jpg', 57, '2019-10-14 00:42:19');

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
(1, 'Igrediente 1', 'unídade', '2019-10-13 16:57:49'),
(2, 'café', 'unídade', '2019-10-14 00:43:02');

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
(1, 1, 20, 1, '2019-10-13 16:57:50'),
(2, 2, 20, 2, '2019-10-14 00:43:03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pais`
--

CREATE TABLE `pais` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `localidade` varchar(50) NOT NULL,
  `path_icon` varchar(80) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pais`
--

INSERT INTO `pais` (`id`, `nome`, `localidade`, `path_icon`, `timestamp`) VALUES
(2, 'Brasil', 'Ameria Latina', '', '2019-09-25 02:05:36'),
(6, 'Africa', 'Angola', 'images/icon-pais/5da658d8c8d09.jpg', '2019-10-15 23:40:08'),
(7, 'Europa', 'FranÃ§a', 'images/icon-pais/5da65b009bebd.jpg', '2019-10-15 23:49:20'),
(8, 'Alonso', 'Alindo', 'images/icon-pais/5da65b58c9579.jpg', '2019-10-15 23:50:48');

-- --------------------------------------------------------

--
-- Estrutura da tabela `receita`
--

CREATE TABLE `receita` (
  `id` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `modo_preparo` text NOT NULL,
  `usuario` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `categoria` int(11) NOT NULL,
  `pais` int(11) NOT NULL,
  `tempo_preparo` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `receita`
--

INSERT INTO `receita` (`id`, `titulo`, `modo_preparo`, `usuario`, `timestamp`, `categoria`, `pais`, `tempo_preparo`) VALUES
(1, 'Minha Primeira Receita', '<br>1 : depois sirva a quem quiser sercir', 57, '2019-10-13 16:57:49', 0, 0, ''),
(2, 'Minha segunda ReceÃ­ta', '<br>1 : Primeira Leve ao Fogo por Meia Hora<br>2 : depois sirva a quem quiser sercir', 57, '2019-10-14 00:43:03', 0, 0, '');

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
  `usuario` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `subscribers`
--

INSERT INTO `subscribers` (`id`, `endpoint`, `auth`, `p256dh`, `usuario`, `status`) VALUES
(1, 'https://fcm.googleapis.com/fcm/send/dWOmpjVA44Q:APA91bGK9ARS4uwVwwyK2rccWe9qJOo35MdgaXb-hF2fHz4Y7fJcMgBwDfiMJ6odbJbjuYipu0wCWhxRQS9u6WbKk59IDodUNT8Mwcdfpn5ybnf4OtVxYtn6w9llS_jPK8BzGsYI1z39', 'P75allqOs0IbbPg7vwqLMQ==', 'BJcEKjrRTqE30RbfW/jO/CMsoYFsVBeOX1pgQXdFipoyge1dt3nizQJbww2AJITpO0aDUa2/r/6B+9sTaPCLmMg=', 0, 1),
(2, 'https://fcm.googleapis.com/fcm/send/cgC960H0DBo:APA91bHy8iuGag8ZMiIaKhaR1xfQiOnwFSoqqAp9Ms0M4SHScJCcI4e0j46hLa5UzsdeLA_fSpkmI4NzrI7N9lS5nudND3yxNRppKrp0kbeRaNSzi4p1GGLM-hcQmVoIsSPR9aaUa5QG', '5wJeVuZ+vAW1lZmHUwrUlA==', 'BN3J62AorvX6q2hBPXyBAK8DIp+WjHjmgt1cIH8+oLl11Fd3unYFGlu9CTseYgZOIoXlufZ/PRIQGjUDK4NQUkY=', 0, 1),
(3, 'https://fcm.googleapis.com/fcm/send/dUehZXtCIW4:APA91bHEDNft-kmoH7CqMRGtDe5t958KapWgxHXMDwZeOX7MnPjh_4yD0NQOuXREhTx4dWuZJZ6SxxF-9JxtCYUGXvRPpCj6giVRNWMySZzbmlUv1iuJ0OjSUjJfQjSt3CnvHT0IweHK', 'gSQaf1xuh8gjuKtEjYoLCw==', 'BEfEO7xtg2af3HM25ebaZ+D9O4GA9t2/He3sbSYOgdgCzulUG1RotIbe9ROBGrmfaNkLQaS46oD9ZQVlGdPYqOc=', 0, 1),
(4, 'https://fcm.googleapis.com/fcm/send/c5FKV2giiq4:APA91bG3WM34-O4ip3Bi6D80qha6pA5QoWQb7mCfdKFVNJTUpKz0qPOvCltM1VW7OnA5AZhPicXWG_UhgHcGZ7s8jBcfH2lvMdj8MQrUD_mk9BDahkJx1TaVFr4e4Y7IyjaKMHdvT98M', 'CeQn/Ct9r3Ywx6q6nVeT2w==', 'BJKXh04ZpN8pnW27L2DW5ALxEFVj7fc1RwunPHiEX6riGKlEobvvmwIYQwN5iVDbj1jOBPfMLAnQA11dwribjuk=', 0, 1),
(5, 'https://fcm.googleapis.com/fcm/send/dNKhRX-hoto:APA91bFIa7uQxaWbyQFu9AS6w7AFJqZgOgk0lui8DiT_A_Y0RDmX-p8ZUGYRTAzUg9g61O-T6P7bX6mY0bwCVRnMtVV--ZYIO67qM_KsE8ejbGJXUF1t95eIrsSasdAeq_CgdoVgTtMj', 'RfBzQIKLChOZ3YnohTU4TA==', 'BHF69L8MoTfe8CiVQkUNRV+ZI4aHU1mnbEinEpdokzdNtkaHAL6hUyDOwfJf8i5aIpVPGVHjDGPs7+g+JrQsVZo=', 0, 1),
(6, 'https://fcm.googleapis.com/fcm/send/dVp9KEyl4Hs:APA91bFLvwLFWN2dvOEm_i6W7NT_V94rv6iBxl5i8wj2d25Ou3vEdoqWFtV4vbM15eIxz_q81ywY_BPG6kOX40Cq8Dc6WzOWjsRXqtHHQlayBGCZgH0j5Yo9HuZv7pkPNZHT2xDrtk46', 'NQLauguNMrms2xNn9FZxkQ==', 'BEWT9bPj+/OFrBR6WYuen1ApwDW8mZ8YANkKqn/wkos0/09mXlOExCOjP9k4mqFSdhDIpD0xVegjmkvC1iXZM/A=', 55, 1),
(7, 'https://fcm.googleapis.com/fcm/send/dwyqhnretZs:APA91bGo2p-DNewrNpvQF6FDcUHz_II7UyY4YJxDIi9xcTNgiA5BgMQamUHlduRauKPFpVcy7SnBqLNpxqakeH2Y9otY-XXOrZHYbfQuwNDQDGRZO9hsXa4HVzV9A7niyw6qeCuei3Hn', 'Mu3gOXlygmpobTidGuJy2Q==', 'BMl37rb5zWAwRdaGI+lZ81NTKzU3BwFXGgCfQaQebEdsEnU30tn/DRG1WoVxxTe6f60oJvlpW5Ju4dE8cTFZrjg=', 55, 1),
(8, 'https://fcm.googleapis.com/fcm/send/feVU8i5s5Vg:APA91bEdNgKV9LY-YTDHjYuVK_fNvK1q4DGJCt5ZGYlwE_eYBxZAqMqLQVoSLlF0c2guCtkA-7kLvbbBmcJb1RLKC2kHC6VViL2gt1TYLhgzYyym0EKUBXj-FgINycaYJwYGxu2RL1xI', 'qGhnOsnVKp9J+fDBfyJ5Qw==', 'BPa53EDmJCtoBS44h/6U4mEj2vvqBGKYKyovNSqxnO6EmND1YDhhBpNAyhrTDSVKiA7yjCs8+1soRMeX97QMRVU=', 55, 1),
(9, 'https://fcm.googleapis.com/fcm/send/dKqyCsNpiy8:APA91bGtjYaQPrL91eBWcjl8esiQc5INkxSf4ukCNiJg5s7SWmD3WAIPClSfkk1jKSkxcjR-SCjQ6ICMv3_wJzmoTaR-9h5NEU3-1tjCwFv6e-yONBX8V2KqZB-Af5da_0THLonqKgl1', 'Ny8r+31GlqLwrwjXW6tlPQ==', 'BIJeSEIF3Ht3RU1ALpiA2HuqIrXmCBxDsH+tdIt6qACgQ3o+aZd4HA3Wna/SqzzjCq8MrQfLkTpDhu01ZfOCctA=', 0, 1),
(10, 'https://fcm.googleapis.com/fcm/send/fu34rTnLBhs:APA91bHClPtQIvEn2fNd8gzXD1EJ1C502hnyB_8Yw_b6XWBAyOrssKv9yHW0kxKdWExJeRdwOm0ieFdCzPZF41w0KF3KVqZwfUZLepqOQJR_rQOQIb0Yk_oCXFI-7qb9hJzUWmOoaA28', 'DNz80vEt9xTTQTDmaq1E1A==', 'BIHNA3+vvPJf0hTixIQTxljV6RbtcgyaLIYWwyDtVTfk3SmyugL8zrDfKkA+ZM0zGcm5dpLXhr+tG7LtVtmzBDo=', 57, 1),
(11, 'https://fcm.googleapis.com/fcm/send/fAtUrr522Qc:APA91bFQb8o7gCMlJiJAYtQdERZz4tCk0Z2sysiEdif4d0Q4XyqHP_5l5cCYhVGs5RyGJnQCXiS3MARkbJnptIPqGc9_Mp3ZjR35KfKYhpRh4Bl6CoGLGIsjRRf4Ci-bVwBUoopj1n_l', 'pr3znlWbslZl4r6wwTo2Bg==', 'BPwtVuI6b+UCozj65fTcPjtQVrp0HO7wfrZf0AKbPkj3eUeBUyjTweMjZ+hfJmsOhCP9b37sCtyQXPWJOhLdLFk=', 57, 1),
(12, 'https://fcm.googleapis.com/fcm/send/eMgfjwICGIQ:APA91bFJbTpqRWDEYtwecmjyrAn_xhzdVR9o6qyJUFyb0y0lq1XD-B7MtjXnd82TXFylPMM1exCkm_FaePV_gEMBiATJTPR5FWeTiAGDEY2IINGnJwWpB57YqcUBMxRK1FMQGvKw3tF2', 'rvURRYpZK9c2kTaJ9TP5sg==', 'BBOQBpNGNR6ojHWZLu52vXm0gCeC2KzFA+qQZYq3kFHi8pvHtERD4e54Qh2WSBcpP97DXrmF3ICiSQhrKfldA8I=', 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) CHARACTER SET utf8 NOT NULL,
  `nascimento` date NOT NULL,
  `email` varchar(80) CHARACTER SET utf8 NOT NULL,
  `senha` varchar(80) CHARACTER SET utf8 NOT NULL,
  `changelog` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `nascimento`, `email`, `senha`, `changelog`) VALUES
(1, 'admin', '0000-00-00', 'admin@admin.com', '81dc9bdb52d04dc20036dbd8313ed055', '2019-10-16 00:11:57');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `foto_receita`
--
ALTER TABLE `foto_receita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ingrediente`
--
ALTER TABLE `ingrediente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ingrediente_receita`
--
ALTER TABLE `ingrediente_receita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pais`
--
ALTER TABLE `pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `receita`
--
ALTER TABLE `receita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `receita_favorita`
--
ALTER TABLE `receita_favorita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
