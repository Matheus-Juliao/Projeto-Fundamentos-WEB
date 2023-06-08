CREATE TABLE usuarios (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(255) UNIQUE,
  email VARCHAR(255),
  senha VARCHAR(255)
);

CREATE TABLE alunos (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome_aluno VARCHAR(25),
  usuário_id INT,
  idade INT NOT NULL,
  genero VARCHAR(10) NOT NULL,
  telefone VARCHAR(255) NOT NULL,
  endereco VARCHAR(255) NOT NULL,
  FOREIGN KEY (usuário_id) REFERENCES usuarios(id)
);

CREATE TABLE instrutores (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome_instrutor VARCHAR(255),
  usuário_id INT,
  especialização VARCHAR(255) NOT NULL,
  telefone VARCHAR(255) NOT NULL,
  endereço VARCHAR(255) NOT NULL,
  FOREIGN KEY (usuário_id) REFERENCES usuarios(id)
);

CREATE TABLE planos_de_treinamento (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(255) NOT NULL,
  descrição TEXT NOT NULL,
  instrutor_id INT,
  FOREIGN KEY (instrutor_id) REFERENCES instrutores(id)
);

CREATE TABLE aulas (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(255) NOT NULL,
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