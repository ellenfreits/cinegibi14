DROP DATABASE IF EXISTS cinegibi;
CREATE DATABASE cinegibi;
USE cinegibi;

-- =====================================
-- USUÁRIOS
-- =====================================

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(100) NOT NULL
);

INSERT INTO usuarios (nome, email, senha)
VALUES (
    'Administrador',
    'admin@cinegibi.com',
    '123456'
);

-- =====================================
-- FILMES
-- =====================================

CREATE TABLE filmes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    genero VARCHAR(50) NOT NULL,
    duracao INT NOT NULL,
    classificacao VARCHAR(20) NOT NULL
);

-- =====================================
-- SESSÕES
-- =====================================

CREATE TABLE sessoes (
    id INT AUTO_INCREMENT PRIMARY KEY,

    filme_id INT NOT NULL,

    data_sessao DATE NOT NULL,
    horario TIME NOT NULL,
    sala VARCHAR(20) NOT NULL,

    CONSTRAINT fk_sessao_filme
    FOREIGN KEY (filme_id)
    REFERENCES filmes(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

-- =====================================
-- INGRESSOS
-- =====================================

CREATE TABLE ingressos (
    id INT AUTO_INCREMENT PRIMARY KEY,

    cliente VARCHAR(100) NOT NULL,

    filme_id INT NOT NULL,

    quantidade INT NOT NULL,

    valor DECIMAL(10,2) NOT NULL,

    forma_pagamento VARCHAR(50) NOT NULL,

    CONSTRAINT fk_ingresso_filme
    FOREIGN KEY (filme_id)
    REFERENCES filmes(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);