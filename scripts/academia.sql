CREATE TABLE usuarios (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(50) UNIQUE,
  email VARCHAR(50),
  senha VARCHAR(20)
);

CREATE TABLE alunos (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome_aluno VARCHAR(25),
  usuário_id INT,
  idade INT NOT NULL,
  genero VARCHAR(10) NOT NULL,
  telefone VARCHAR(20) NOT NULL,
  endereco VARCHAR(50) NOT NULL,
  FOREIGN KEY (usuário_id) REFERENCES usuarios(id)
);

CREATE TABLE instrutores (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome_instrutor VARCHAR(20),
  idade INT NOT NULL,
  usuário_id INT,
  genero VARCHAR(10) NOT NULL,
  telefone VARCHAR(20) NOT NULL,
  endereco VARCHAR(50) NOT NULL,
  especialização VARCHAR(25) NOT NULL,
  FOREIGN KEY (usuário_id) REFERENCES usuarios(id)
);

CREATE TABLE planos_de_treinamento (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(20) NOT NULL,
  descrição TEXT NOT NULL,
  valor decimal(5,2),
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
insert into usuarios (nome, email, senha) values ('adriano', 'adrianopinheiro2012@live.com', 123);
delete from usuarios where id = '2';
select * from usuarios;
select * from alunos;
select * from instrutores;
select * from planos_de_treinamento;

-- Dropar todas as tabelas caso existam:
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

-- instrutores JOIN usuarios
SELECT i.id AS instrutor_id, i.nome_instrutor, u.id AS usuario_id, u.nome AS usuario_nome, u.email
FROM instrutores AS i
JOIN usuarios AS u ON i.usuário_id = u.id;

-- planos_de_treinamento JOIN instrutores
SELECT p.id AS plano_id, p.nome AS plano_nome, p.descrição AS plano_descrição, i.id AS instrutor_id, i.nome_instrutor
FROM planos_de_treinamento AS p
JOIN instrutores AS i ON p.instrutor_id = i.id;
*/




