CREATE DATABASE IF NOT EXISTS academia;
USE academia;

CREATE TABLE usuarios (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(255) UNIQUE,
  email VARCHAR(255),
  senha VARCHAR(255)
);

CREATE TABLE alunos (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome_aluno VARCHAR(25),
  usuario_id INT,
  idade INT NOT NULL,
  genero VARCHAR(10) NOT NULL,
  telefone VARCHAR(255) NOT NULL,
  endereco VARCHAR(255) NOT NULL,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE instrutores (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome_instrutor VARCHAR(50),
  usuario_id INT NOT NULL,
  idade INT NOT NULL,
  genero VARCHAR(10) NOT NULL,
  especializacao VARCHAR(300) NOT NULL,
  telefone VARCHAR(20) NOT NULL,
  endereco VARCHAR(50) NOT NULL,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE planos_de_treinamento (
  id INT PRIMARY KEY AUTO_INCREMENT,
  valor decimal(5,2),
  nome VARCHAR(20) NOT NULL,
  descricao TEXT NOT NULL,
  instrutor_id INT,
  FOREIGN KEY (instrutor_id) REFERENCES instrutores(id)
);

CREATE TABLE aulas (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(20) NOT NULL,
  instrutor_id INT,
  FOREIGN KEY (instrutor_id) REFERENCES instrutores(id)
);

CREATE TABLE alunos_planos_de_treinamento (
  aluno_id INT,
  planos_de_treinamento_id INT,
  FOREIGN KEY (aluno_id) REFERENCES alunos(id),
  FOREIGN KEY (planos_de_treinamento_id) REFERENCES planos_de_treinamento(id)
);

/*
-- USADOS PARA DESENVOLVIMENTO

-- INSERT
insert into usuarios (nome, email, senha) values ('adriano', 'adrianopinheiro2012@live.com', 123);
insert into instrutores (nome_instrutor, usuario_id, especializacao, telefone, endereco) 
	values ("Adriano Pinheiro", 2, "Musculação, Zumba, Natação", "19970707070", "Rua Joaquim Marcelino Leite, 265");
insert into aulas (nome, instrutor_id) values ("Zumba", 1);
insert into aulas (nome, instrutor_id) values ("Natação", 1);
insert into instrutores (nome_instrutor, usuario_id, idade, genero, especializacao, telefone, endereco) values ("Matheus", 1, 34, "Masculino", "", "", "");
INSERT INTO instrutores (nome_instrutor, usuario_id, idade, genero, telefone, endereco, especializacao) VALUES ($nome', '$usuario_id', '$idade', '$genero', '$telefone', '$endereco', '$especializacao')"

-- SELECT
select * from usuarios;
select * from alunos;
select * from instrutores;
select * from planos_de_treinamento;
select * from instrutores;
select * from aulas;
select * from alunos_planos_de_treinamento;

-- DELETE
DELETE FROM aulas WHERE instrutor_id=4;
DELETE FROM instrutores WHERE id=4;

-- DROPAR TODAS AS TABELAS CASO EXISTAM:
DROP TABLE IF EXISTS alunos_planos_de_treinamento;
DROP TABLE IF EXISTS aulas;
DROP TABLE IF EXISTS planos_de_treinamento;
DROP TABLE IF EXISTS instrutores;
DROP TABLE IF EXISTS alunos;
DROP TABLE IF EXISTS usuarios;

-- ALUNOS JOIN USUÁRIOS
SELECT a.id AS aluno_id, a.nome_aluno, u.id AS usuario_id, u.nome AS usuario_nome, u.email
FROM alunos AS a
JOIN usuarios AS u ON a.usuário_id = u.id;

-- USUÁRIOS JOIN INSTRUTORES
SELECT i.id, i.nome_instrutor, i.idade, i.genero, i.especializacao, i.telefone, i.endereco, u.nome 
FROM usuarios u INNER JOIN instrutores i ON u.id = i.usuario_id;

-- PLANOS_DE_TREINAMENTO JOIN INSTRUTORES
SELECT p.id AS plano_id, p.nome AS plano_nome, p.descrição AS plano_descrição, i.id AS instrutor_id, i.nome_instrutor
FROM planos_de_treinamento AS p
JOIN instrutores AS i ON p.instrutor_id = i.id;

-- AULAS JOIN INSTRUTORES
SELECT a.id, a.nome as aula, i.nome_instrutor, i.especializacao 
FROM aulas a INNER JOIN instrutores i on a.instrutor_id = i.id;
*/