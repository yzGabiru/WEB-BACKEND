<!-- GAMBIARRA PRA COLOCAR O CSS -->
<html>
<link rel="stylesheet" href="style_resultadoBusca.css">
</html>

<?php
$conect = new PDO("mysql:host=localhost;dbname=postinho", "root", "");




if (isset($_GET['valor'])) {
    //PEGA O QUE TA ESCRITO NO INPUT (valor é o id do input)
    $valor = $_GET['valor'];

    // VERIFICICA DE FOI NOME OU CPF (é o select)
    $campo = $_GET['busca'] == 'cpf' ? 'CPF' : 'NOME';

    // FAZ A CONSULTA SQL
    $consulta = $conect->prepare("SELECT * FROM paciente WHERE $campo = :valor");
    $consulta->bindParam(':valor', $valor);
    $consulta->execute();

    // VERIFICA SE FOI ENCONTRADA ALGUMA COISA
    if ($consulta->rowCount() > 0) {

        echo "<h2>Resultados da busca:</h2>";
        echo "<ul>";

        //INICIA UMA SESSAO NO NAVEGADOR QUE VOU USAR PRA MANDAR UNS DADOS PRA OUTRA PAGINA
        session_start();

        //LOOP PARA MOSTRAR OS DADOS DO PACIENTE UM EMBAIXO DO OUTRO
        while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
            echo "<li> <strong>";
            echo "Nome: " . $row['NOME'] . " <br>";
            echo "Idade: " . $row['IDADE'] . "<br>";
            echo "Sexo: " . $row['SEXO'] . "<br>";
            echo "CPF: " . $row['CPF'] . "<br>";
            echo "Telefone: " . $row['TELEFONE'] . "<br>";
            echo "Endereço: " . $row['ENDERECO'] . "<br>";
            echo "Peso: " . $row['PESO'] . "<br>";
            echo "Altura: " . $row['ALTURA'] . "<br>";
            echo "Ativo: " . $row['ATIVO'] . "<br>";
            //CRIA UM BOTAO NO HTML E ATRIBUI A ELE ALGUNS DADOS PRA SEREM ENVIADOS PRA OUTRA PAGINA QUANDO CLICADO
            echo "<div class='button-container'><a href='prontuario.html?id_paciente=". urlencode($row['CD_PACIENTE']) . "&nome=".  urlencode($row['NOME']) . "' class='ver-prontuario-button'>VER PRONTUÁRIO</a></div><br>";
            echo "</li>";
        }
        echo "</ul>";
    }
    else {
        //SE NAO FOR ENCONTRADO NENHUM PACIENTE COM OS DADOS FORNECIDOS
        echo "<p>Nenhum resultado encontrado.</p>";
    }
}
