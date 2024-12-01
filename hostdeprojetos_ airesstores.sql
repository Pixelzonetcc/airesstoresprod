-- Criação do banco de dados, se não existir
CREATE DATABASE IF NOT EXISTS hostdeprojetos_airesstores;
USE hostdeprojetos_airesstores;

SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
START TRANSACTION;
SET time_zone = '+00:00';

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Estrutura de tabelas

-- Tabela cart
CREATE TABLE cart (
  id int(11) NOT NULL AUTO_INCREMENT,
  user_id int(11) NOT NULL,
  name varchar(100) NOT NULL,
  price DECIMAL(10, 2) NOT NULL,  -- Alterado para DECIMAL para suportar valores monetários
  quantity int(11) NOT NULL,
  image varchar(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela message
CREATE TABLE message (
  id int(11) NOT NULL AUTO_INCREMENT,
  user_id int(11) NOT NULL,
  name varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  number varchar(12) NOT NULL,
  message varchar(500) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela orders
CREATE TABLE orders (
  id int(11) NOT NULL AUTO_INCREMENT,
  user_id int(11) NOT NULL,
  name varchar(100) NOT NULL,
  number varchar(12) NOT NULL,
  email varchar(100) NOT NULL,
  method varchar(50) NOT NULL,
  address varchar(500) NOT NULL,
  total_products varchar(1000) NOT NULL,
  total_price DECIMAL(10, 2) NOT NULL,  -- Alterado para DECIMAL para suportar valores monetários
  placed_on varchar(50) NOT NULL,
  payment_status varchar(20) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela products
CREATE TABLE products (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  price DECIMAL(10, 2) NOT NULL,  -- Alterado para DECIMAL para suportar valores monetários
  image varchar(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela users
CREATE TABLE users (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  password varchar(255) NOT NULL,  -- Alterado para varchar(255) para armazenar senhas com hash
  user_type varchar(20) NOT NULL DEFAULT 'user',
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
