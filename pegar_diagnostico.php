<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado da Consulta</title>
    <link rel="stylesheet" href="style_prontuario.css">
</head>
<body>
    <div class="container">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $conectar = new PDO("mysql:host=localhost;dbname=postinho", "root", "");

            //PEGA O ID DO PACIENTE DA PASTA DE PRONTUARIO E COLOCA NUMA VARIAVEL 
            $idPaciente = $_POST['id_paciente'];
            

            // FAZ O SQL DO DIAGNOSTICO PELO ID DO PACIENTE
            $consulta = $conectar->prepare("
                SELECT c.DIAGNOSTICO, m.NM_MEDICO 
                FROM consulta c
                INNER JOIN medico m ON c.CD_MEDICO = m.CD_MEDICO
                WHERE c.CD_PACIENTE = :id_paciente
            ");

            //COLOCA O ID QUE EU PEGUEI NO :id_paciente
            $consulta->bindParam(':id_paciente', $idPaciente);  
            $consulta->execute();

            // PEGA O TODOS OS DIAGNOSTICOS DO PACIENTE E  COLOCA NO ARRAY
            $diagnosticos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            // PERCORRE ESSE ARRAY MOSTRANDO OS DIAGNOSTICOS
            if($diagnosticos){
                echo "<h2>Resultado da Consulta</h2>";
                foreach($diagnosticos as $diagnostico){
                    echo "<p>Diagnóstico: <span class='diagnostico'>" . $diagnostico['DIAGNOSTICO'] . "</span></p>";
                    echo "<p>Médico: <span class='medico'>" . $diagnostico['NM_MEDICO'] . "</span></p>";
                }
            } else{
                    echo "<p class='error'>Nenhum diagnóstico encontrado para o paciente com ID " . $idPaciente . "</p>";
            }

                 }   

        ?>
    </div>
</body>
</html>

