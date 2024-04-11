<?php

//PRA VERIFICAR SE O CPF JA TA CADASTRADO NO SISTEMA
function verificarCPF($cpf) {
    
  $conectar = new PDO("mysql:host=localhost;dbname=postinho", "root", "");


  $verificar_cpf = $conectar->prepare("SELECT CPF FROM paciente WHERE CPF = :cpf");
  $verificar_cpf->bindParam(':cpf', $cpf);
  $verificar_cpf->execute();

  
  if($verificar_cpf->rowCount() != 0 ){
       // CPF JA CADASTRADO
      return true;
  } else {
      // CPF NAO CADASTRADO
      return false; 
  }
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //CONEXAO COM O BANCO DE DADOS DO XAMPP
    $conect = new PDO("mysql:host=localhost;dbname=postinho", "root", "");
    //PEGA O CPF QUE FOI MANDADO PELO AJAX PRA VERIFICAR SE ELE JA EXISTE
    $cpf = $_POST['cpf'];

    if(verificarCPF($cpf)){
      echo '<html><p><h2 style="color: #030E4F; font-family: sans-serif;">CPF JA CONSTA NO SISTEMA!</h2></p></html>';
    } else { //SE NAO EXISTIR ELE SEGUE COM O PROGRAMA PRA SALVAR OS DADOS NO BANCO DE DADOS

    //PEGA AS VARIAVEIS QUE RECEBERAM OS DADOS E ATRIBUI A OUTRA DENTRO DESSE ARQUIVO
    $nm_cliente = $_POST['nm_pessoa'];
    $idade = $_POST['idade'];
    $sexo = $_POST['sexo'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];
    $tipo_s = $_POST['tipo_s'];
    $ativo = $_POST['ativo'];

    //PREPARA O SQL PARA EXECUTAR, ATRIBUI A UMA VARIAVEL DE PONTEIRO
    $ponteiro = $conect->prepare('INSERT INTO `paciente`(`NOME`, `IDADE`, `SEXO`, `CPF`, `TELEFONE`, `ENDERECO`,`PESO`,`ALTURA`,`TIPO_S`,`ATIVO`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    
    // PASSANDO CADA INFORMAÇÃO PEGA DO FORMULARIO
    $ponteiro->bindParam(1, $nm_cliente);
    $ponteiro->bindParam(2, $idade);
    $ponteiro->bindParam(3, $sexo);
    $ponteiro->bindParam(4, $cpf);
    $ponteiro->bindParam(5, $telefone);
    $ponteiro->bindParam(6, $endereco);
    $ponteiro->bindParam(7, $peso);
    $ponteiro->bindParam(8, $altura);
    $ponteiro->bindParam(9, $tipo_s);
    $ponteiro->bindParam(10, $ativo);


    //OU EXECUTA OU DA ERRO
    if ($ponteiro->execute()) {
      echo '<html><p><h2 style="color: #030E4F; font-family: sans-serif;">DADOS INSERIDOS COM SUCESSO!</h2></p></html>';
  } else {
      echo '<html><p><h2 style="color: #030E4F; font-family: sans-serif;">ERRO AO INSERIR OS DADOS!</h2></p></html>';
  }
}
}

