<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>indexDentist</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/clinica/css2/home.css"/>
</head>
<body>
<?php
foreach ($this->session->getFlashBag()->all() as $type => $messages) {
    foreach ($messages as $message) {
        echo '<div class="alert alert-'.$type.'">'.$message.'</div>';
    }
}
?>
<div id="interface">
    <header id="cabecalho">
        <hgroup>
            <h1>Ferreira Ortodontia</h1>
        </hgroup>
        <nav>
            <a href="/clinica/front.php/register">Cadastrar novo paciente</a><br/><br/>
            <a href="/clinica/front.php/consult">marcar nova consulta</a><br/><br/>
            <a href="/clinica/front.php/deleteconsult">excluir consulta</a><br/><br/>
            <a href="/clinica/front.php/showconsultday">pesquisar consultas do dia por paciente</a><br/><br/>
            <a href="/clinica/front.php/showconsultall">exibir consultas por paciente</a><br/><br/>
            <a href="/clinica/front.php/allconsults">exibir todas as consultas por data</a><br/><br/>
            <a href="/clinica/front.php/showpatient">apagar paciente</a><br/><br/>
            <a href="/clinica/front.php/allpatients">exibir todos pacientes cadastrados</a><br/><br/>
            <a href="/clinica/front.php/index">voltar</a><br/><br/>
        </nav>
    </header>
</div>
</body>
</html>