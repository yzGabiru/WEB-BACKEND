<?php
$conect = new PDO("mysql:host=localhost;dbname=postinho", "root", "");

// PEGA TODOS OS NOMES DOS PACIENTES PRA COLOCAR NO SELECT DENTRO DO HTML
$consulta_nomes_pacientes = $conect->query("SELECT CD_PACIENTE, NOME FROM paciente");
$nomes_paciente = $consulta_nomes_pacientes->fetchAll(PDO::FETCH_ASSOC);

//MESMA COISA COM OS MEDICOS
$consulta_nomes_medicos = $conect->query("SELECT CD_MEDICO, NM_MEDICO FROM medico");
$nomes_medico = $consulta_nomes_medicos->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style_atendimento.css">
    <title>ATENDIMENTO</title>
</head>
<body>
<header class="site-header">
        <h1 class="site-title" >MEDQUINHO</h1>
        <nav class="site-nav">
            <a href="index.php">VOLTAR</a>
        </nav>
    </header>
    <div class="conteiner">
        
        <form id="atendimento">
        <h1>ATENDIMENTO</H1>
        

        <select name="paciente" id="paciente" required>
            <option value="">Selecione um paciente</option>
            <!-- LOOP PRA PERCORRER OS NOMES DE PACIENTES -->
            <?php foreach ($nomes_paciente as $paciente): ?>
                <option value="<?php echo $paciente['CD_PACIENTE']; ?>"><?php echo $paciente['NOME']; ?></option>
            <?php endforeach; ?>
        </select>
        <select name="medico" id="medico" required>
            <option value="">Selecione um medico</option>
            <!-- MAIS UM LOOP SO QUE PRA MEDICOS -->
            <?php foreach ($nomes_medico as $medico): ?>
                <option value="<?php echo $medico['CD_MEDICO']; ?>"><?php echo $medico['NM_MEDICO']; ?></option>
            <?php endforeach; ?>
        </select>
        <div id="areadetexto">
            <textarea id="diagnostico" placeholder="DIAGNÓSTICO" required></TExtarea>
        </div>
        <div class="botao">
                    <button type="submit">ENVIAR</button>
                </div>

        <div id="resultado"></div>
        </form>
    </div>

    <script>
    $(document).ready(function(){
        $('#atendimento').submit(function(e){ 
            e.preventDefault(); //EVOTANDO QUE O FORMULARIO SEJA ENVIADO DIRETAO
            

            var formData = {
                CD_PACIENTE: $('#paciente').val(), // PEGA O VALOR SELECIONADO NO SELECT PARA PACIENTE
                CD_MEDICO: $('#medico').val(), // PEGA O MEDICO
                DIAGNOSTICO: $('#diagnostico').val(), // DIAGNOSTICO
                DATA: new Date().toISOString().slice(0, 10) // PEGA A DATA ATUAL PRA NAO TER QUE FICAR COLOCANDO
            };

            //AJAX COM MAIS UM ARQUIVO PRA NAO PERDER O COSTUME
            $.ajax({
                type: 'POST',
                url: 'cadastro_atendimento.php',
                data: formData,
                success: function(response){
                    $('#resultado').html(response); 
                }
            });
        }); 
    });
</script>



<footer class="site-footer">
        <p class="footer-text">UNESC - 2024</p>
    </footer>
</body>
</html>
