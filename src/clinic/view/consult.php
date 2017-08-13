<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>indexDentist</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/clinica/css2/deletepatient.css"/>
</head>
<body>
<?php
foreach ($this->session->getFlashBag()->all() as $type => $messages) {
    foreach ($messages as $message) {
        echo '<div class="alert alert-'.$type.'">'.$message.'</div>';
    }
}
echo $error;
?>
<form action="/clinica/front.php/consult"  method="POST">
    <h3>CPF DO PACIENTE:</h3>
     <input type="text" name="cpf" >
    <h3>DATA:</h3>
    <input type="text" name="date" >
    <h3>HORA:</h3>
    <input type="text" name="hour" >
    <h3>cpf do denstista:</h3>
    <input type="text" name="dentist" >
    <br/><br/>
    <input type="submit" value="Enviar">
</form>
<a href="/clinica/front.php/data">voltar</a>
</body>
</html>