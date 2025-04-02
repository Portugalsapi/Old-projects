-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Jul-2021 às 01:40
-- Versão do servidor: 10.4.19-MariaDB
-- versão do PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cantoinfor`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `price` float NOT NULL,
  `description` varchar(80) NOT NULL,
  `stock` int(50) NOT NULL,
  `category` enum('computadores','perifericos','jogos','') NOT NULL,
  `imagem` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `name`, `price`, `description`, `stock`, `category`, `imagem`) VALUES
(14, 'Computador Desktop Gaming MR51FG1', 700, 'AMD Ryzen 5 1600 | GeForce GTX 1050 Ti | 8 GB | 500 GB SSD', 10, 'computadores', 'desktop3.jpg'),
(15, 'Portátil Gaming ASUS R75A36PB1 ', 1499, 'AMD Ryzen 7 5800H | GeForce RTX 3060 | RAM: 16 GB | 512 GB SSD ', 10, 'computadores', 'portatil2.jpg'),
(18, 'Portátil Gaming MSI GP65', 1950, 'Intel Core i7-10750H | GeForce RTX 2060 | RAM: 16 GB | 1 TB SSD', 10, 'computadores', 'portatil1.jpg'),
(19, 'Acer Nitro', 960, 'Intel Core i5-9300H | Nvidia GeForce GTX 1650 | RAM: 8GB | 512GB SSD', 10, 'computadores', 'portatil3.jpg'),
(20, 'Mouse Gaming Razer Viper', 79.99, '5G Optical Sensor | 16,000 DPI | Speedflex Cable', 10, 'perifericos', 'mouserazer.jpg'),
(21, 'Mouse Gaming Razer Deathadder Essential White', 65, 'Focus+ Optical Sensor | 20,000 DPI | HyperSpeed', 10, 'perifericos', 'mouserazer2.jpg'),
(22, 'Mouse Gaming Kadru', 30, 'RGB | 4000 DPI | 6 botões', 10, 'perifericos', 'mousekadru.jpg'),
(23, 'Headset Razer ManOwar', 180, 'Sound: -112 ± 3 dB | MIC: -38 ± 3 dB', 10, 'perifericos', 'headset4.jpg'),
(24, 'Headset Gaming HYPERX Cloud Alpha', 80, 'Sound: -100 ± 2 dB | MIC: -35 ± 2 dB', 10, 'perifericos', 'headset1.jpg'),
(25, 'Minecraft Java Edition - PC CD-Key', 25, 'Online Mode | Survival | +6 Anos', 10, 'jogos', 'game5.jpg'),
(26, 'Rocket League - PC CD-Key Steam', 35, 'Online Mode | FPS | +3 Anos', 10, 'jogos', 'game1.png'),
(27, 'Grand Theft Auto V - PC CD-Key Steam', 59.99, 'Online Mode | FPS | +18 Anos', 10, 'jogos', 'game2.jpg'),
(28, 'RUST - PC CD-Key Steam', 40, 'Online Mode | FPS | +18 Anos', 10, 'jogos', 'game4.png'),
(29, 'ARK Survival Evolve - PC CD-Key Steam', 15, 'Online Mode | Survival | +6 Anos', 10, 'jogos', 'game3.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `level`) VALUES
(10, 'admin', 'admin@gmail.com', '$2y$10$o.9I9GAhiaQs8hRC25Isdu02qk0HHcq3T92REiIX8JsS7odJ69wWG', 1),
(14, 'paulo', 'paulo@gmail.com', '$2y$10$RY9cEb6GAh7l8EuJo9DOsOMdF7VV5cOlYsAGgSNjZq12cfkA1w146', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
