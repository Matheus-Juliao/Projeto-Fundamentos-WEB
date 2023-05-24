CREATE TABLE usuarios (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(255),
  email VARCHAR(255),
  senha VARCHAR(255)
);

CREATE TABLE alunos (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome_aluno VARCHAR(25),
  usuário_id INT,
  idade INT,
  genero VARCHAR(10),
  telefone VARCHAR(255),
  endereço VARCHAR(255),
  FOREIGN KEY (usuário_id) REFERENCES usuarios(id)
);

CREATE TABLE instrutores (
  id INT PRIMARY KEY AUTO_INCREMENT,
  usuário_id INT,
  especialização VARCHAR(255),
  telefone VARCHAR(255),
  endereço VARCHAR(255),
  FOREIGN KEY (usuário_id) REFERENCES usuarios(id)
);

CREATE TABLE planos_de_treinamento (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(255),
  descrição TEXT,
  instrutor_id INT,
  FOREIGN KEY (instrutor_id) REFERENCES instrutores(id)
);

CREATE TABLE aulas (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(255),
  instrutor_id INT,
  FOREIGN KEY (instrutor_id) REFERENCES instrutores(id)
);

CREATE TABLE alunos_planos_de_treinamento (
  aluno_id INT,
  planos_de_treinamento_id INT,
  FOREIGN KEY (aluno_id) REFERENCES alunos(id),
  FOREIGN KEY (planos_de_treinamento_id) REFERENCES planos_de_treinamento(id)
);


SELECT a.id AS aluno_id, a.nome AS aluno_nome, pt.id AS planos_de_treinamento_id, pt.nome AS planos_de_treinamento_nome
FROM alunos AS a
JOIN alunos_planos_de_treinamento AS apt ON a.id = apt.aluno_id
JOIN planos_de_treinamento AS pt ON apt.planos_de_treinamento_id = pt.id;

SELECT c.id AS class_id, c.name AS class_name, i.id AS instructor_id, i.name AS instructor_name
FROM classes AS c
JOIN instructors AS i ON c.instructor_id = i.id;

SELECT s.id AS student_id, s.name AS student_name, tp.id AS training_plan_id, tp.name AS training_plan_name, i.id AS instructor_id, i.name AS instructor_name
FROM students AS s
JOIN students_training_plans AS stp ON s.id = stp.student_id
JOIN training_plans AS tp ON stp.training_plan_id = tp.id
JOIN instructors AS i ON tp.instructor_id = i.id;
