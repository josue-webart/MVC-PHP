-- --------------------------------------------------------
-- Servidor:                     localhost
-- Versão do servidor:           10.3.39-MariaDB-1:10.3.39+maria~ubu2004 - mariadb.org binary distribution
-- OS do Servidor:               debian-linux-gnu
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para projeto_mvc
CREATE DATABASE IF NOT EXISTS `projeto_mvc` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `projeto_mvc`;

-- Copiando estrutura para tabela projeto_mvc.depoimentos
CREATE TABLE IF NOT EXISTS `depoimentos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `mensagem` text NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Copiando dados para a tabela projeto_mvc.depoimentos: ~4 rows (aproximadamente)
INSERT INTO `depoimentos` (`id`, `nome`, `mensagem`, `data`) VALUES
	(1, 'Negrita', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis illum fuga exercitationem, neque inventore tempore iusto minima nulla enim! Maiores doloremque dolorum nam. Beatae velit magnam ex. Vero, ipsa autem!', '2023-07-25 10:10:30'),
	(2, 'Maria DB', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2023-07-25 10:13:04'),
	(3, 'Pedro Rodrigues', 'Corporis illum fuga exercitationem, neque inventore tempore iusto minima nulla enim! Maiores doloremque dolorum nam. Beatae velit magnam ex. Vero, ipsa autem!', '2023-07-25 10:54:34'),
	(4, 'Clarisa', 'Teste teste amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2023-07-25 14:31:07'),
	(5, 'Jensy Martinez', 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2023-07-25 14:32:23'),
	(6, 'Pablo Domiciano', 'Teste teste amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2023-07-26 15:54:18'),
	(8, 'Matheus Bosquetti', 'Vou parar de fumar no 2025, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2023-08-09 09:03:55');

-- Copiando estrutura para tabela projeto_mvc.profesores
CREATE TABLE IF NOT EXISTS `profesores` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `descricao` longtext NOT NULL,
  `foto` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Copiando dados para a tabela projeto_mvc.profesores: ~2 rows (aproximadamente)
INSERT INTO `profesores` (`id`, `nome`, `descricao`, `foto`) VALUES
	(1, 'Ana Martinez', 'Prazer, me chamo Ana Beatriz, meus alunos me chamam de Teacher Bia, tenho 26 anos e sou casada.\r\n\r\nSou professora desde 2020, já trabalhei 1 ano em uma escola particular dando aulas para crianças do ensino infantil e fundamental 1. Atualmente sou formada em Processos Gerenciais e fiz o curso completo de inglês da escola CNA idiomas.\r\n\r\nSou fluente em português, inglês e espanhol. Morei 3 anos na Argentina, lá pude aprender o idioma e também praticar o inglês com pessoas de outros países.', 'foto1'),
	(2, 'Ana Luisa', 'Prazer, eu sou a Ana Luiza, mais conhecida como Analu, tenho 25 anos e moro no Brasil.\r\n\r\nSou formada em Ciências Biológicas, amo a natureza, as plantas e os insetos, mas ensinar inglês tem sido minha profissão desde 2017. Trabalhei em uma escola de línguas por 5 anos e lá descobri o que realmente gostava de fazer!\r\n\r\nO meu contato com o inglês se iniciou aos 16 anos na escola CNA idiomas e não parou mais. Através da mesma conquistei uma certificação de Cambridge, trabalhei lá por alguns anos como professora e coordenadora e recentemente morei por alguns meses na Georgia, Estados Unidos, como babá.', 'foto2');

-- Copiando estrutura para tabela projeto_mvc.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Copiando dados para a tabela projeto_mvc.usuarios: ~1 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`) VALUES
	(1, 'Josue Martinez', 'josue@projetomvc.com', '$2y$10$.YJbPUuwjvJsYEFN7aCbwuTnWdiusgSMCMHwqF54xDp.yI9wbHu26'),
	(3, 'Ana Beatriz', 'ana@projetomvc.com', '$2y$10$15JhA0AYjJNaQBD8yHrzyOkKdKsmnhB61CHbaWrHtAU8AwCS28WSu');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
