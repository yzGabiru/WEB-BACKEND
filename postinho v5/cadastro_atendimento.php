<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //JA DEVE TER UMAS 30 CONEXOES EM UM BANCO SO
    $conectar = new PDO("mysql:host=localhost;dbname=postinho", "root", "");

    // PEGA OS DADOS ENVIADOS DA ABA DE ATENDIMENTO
    $cd_paciente = $_POST['CD_PACIENTE']; 
    $cd_MEDICO = $_POST['CD_MEDICO']; 
    $diagnostico = $_POST['DIAGNOSTICO']; 
    $data_consulta = $_POST['DATA']; 

    //PREPARA O SQL DE INSERCAO PASSA OS DADOS E EXECUTA
    $ponteiro = $conectar->prepare('INSERT INTO `consulta`(`CD_PACIENTE`, `CD_MEDICO`, `DIAGNOSTICO`, `DT_ATENDIMENTO`) VALUES (?, ?, ?, ?)');

    $ponteiro->bindParam(1, $cd_paciente); 
    $ponteiro->bindParam(2, $cd_MEDICO);
    $ponteiro->bindParam(3, $diagnostico); 
    $ponteiro->bindParam(4, $data_consulta);    

    //VERIFICAÇÃO BBASICA
    if ($ponteiro->execute()) {
        echo "<html><p><h2>DADOS INSERIDOS COM SUCESSO!</h2></p></html>";
    } else {
        echo "Erro ao inserir dados no banco de dados.";
    }
}

  