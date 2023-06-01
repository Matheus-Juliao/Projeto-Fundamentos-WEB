<?php
// Conexão com o banco de dados
$servername = "seu_servidor";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "seu_banco_de_dados";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi estabelecida corretamente
if ($conn->connect_error) {
  die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Função para atualizar informações na tabela "usuarios"
function atualizarUsuario($id, $nome, $email) {
  global $conn;
  $sql = "UPDATE usuarios SET nome = '$nome', email = '$email' WHERE id = $id";
  if ($conn->query($sql) === TRUE) {
    echo "Dados do usuário atualizados com sucesso!";
  } else {
    echo "Erro ao atualizar os dados do usuário: " . $conn->error;
  }
}

// Função para atualizar informações na tabela "alunos"
function atualizarAluno($id, $nome, $idade, $genero, $telefone, $endereco) {
  global $conn;
  $sql = "UPDATE alunos SET nome_aluno = '$nome', idade = $idade, genero = '$genero', telefone = '$telefone', endereço = '$endereco' WHERE id = $id";
  if ($conn->query($sql) === TRUE) {
    echo "Dados do aluno atualizados com sucesso!";
  } else {
    echo "Erro ao atualizar os dados do aluno: " . $conn->error;
  }
}

// Função para atualizar informações na tabela "instrutores"
function atualizarInstrutor($id, $especializacao, $telefone, $endereco) {
  global $conn;
  $sql = "UPDATE instrutores SET especialização = '$especializacao', telefone = '$telefone', endereço = '$endereco' WHERE id = $id";
  if ($conn->query($sql) === TRUE) {
    echo "Dados do instrutor atualizados com sucesso!";
  } else {
    echo "Erro ao atualizar os dados do instrutor: " . $conn->error;
  }
}

// Função para atualizar informações na tabela "planos_de_treinamento"
function atualizarPlanoTreinamento($id, $nome, $descricao) {
  global $conn;
  $sql = "UPDATE planos_de_treinamento SET nome = '$nome', descrição = '$descricao' WHERE id = $id";
  if ($conn->query($sql) === TRUE) {
    echo "Dados do plano de treinamento atualizados com sucesso!";
  } else {
    echo "Erro ao atualizar os dados do plano de treinamento: " . $conn->error;
  }
}

// Processa o envio do formulário e chama a função de atualização adequada
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $tabela = $_POST["tabela"];
  $id = $_POST["id"];

  if ($tabela == "usuarios") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    atualizarUsuario($id, $nome, $email);
  } elseif ($tabela == "alunos") {
    $nome = $_POST["nome_aluno"];
    $idade = $_POST["idade"];
    $genero
