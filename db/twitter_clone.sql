-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Abr-2020 às 23:39
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `twitter_clone`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tweets`
--

CREATE TABLE `tweets` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tweet` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tweets`
--

INSERT INTO `tweets` (`id`, `id_user`, `tweet`, `date`) VALUES
(2, 1, 'TOU COM DEPRESSÃOOOOOO', '2020-04-25 15:50:49'),
(3, 2, 'há pessoas que dizem que teem depressão na tanga, essas pessoas não sabem mesmo o que é respeito :(', '2020-04-25 15:52:14'),
(4, 1, 'Peço desculpa ', '2020-04-25 15:53:39'),
(6, 1, 'Tweet do João\r\n', '2020-04-25 16:15:59'),
(7, 3, 'Meu primeiro tweet', '2020-04-25 16:24:56'),
(8, 4, 'Meu primeiro tweet\r\n', '2020-04-25 23:32:33'),
(9, 4, 'Segundo', '2020-04-25 23:32:40'),
(10, 5, 'Primeiro tweet\r\n', '2020-04-27 18:20:18'),
(11, 3, 'Estou farta da quarentena mds', '2020-04-29 21:51:51'),
(12, 2, 'Removi o meu primeiro tweet, como o tempo passa', '2020-04-29 22:31:40'),
(13, 2, 'Mesmo @maria também, estou farta', '2020-04-29 22:36:03'),
(15, 3, 'Love you @dara', '2020-04-29 22:36:58');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'João Gomes', 'joaopfg.2002@gmail.com', '202cb962ac59075b964b07152d234b70'),
(2, 'Dara Alves', 'dara@gmail.com', '900150983cd24fb0d6963f7d28e17f72'),
(3, 'Maria', 'maria@gmail.com', '202cb962ac59075b964b07152d234b70'),
(4, 'Daniel Santos', 'daniel@gmail.com', '202cb962ac59075b964b07152d234b70'),
(5, 'Ruka', 'ruka@gmail.com', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_followers`
--

CREATE TABLE `user_followers` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_user_following` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `user_followers`
--

INSERT INTO `user_followers` (`id`, `id_user`, `id_user_following`) VALUES
(14, 2, 1),
(15, 1, 2),
(16, 1, 5),
(18, 3, 1),
(19, 2, 3),
(20, 3, 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `user_followers`
--
ALTER TABLE `user_followers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `user_followers`
--
ALTER TABLE `user_followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
