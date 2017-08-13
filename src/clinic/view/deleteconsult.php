<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html" charset="utf-8">
    <title>ler</title>
    <link rel="stylesheet" type="text/css" href="/clinica/css2/deletepatient.css"/>
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
<form name="excluir" action="/clinica/front.php/deleteconsult" method="POST">
    <h3>INSIRA O CPF DO CLIENTE:</h3>
    <input type="text" name="cpf" >
    <br>
    <h3>INSIRA A DATA DA CONSULTA A EXCLUIR</h3>
    <input type="text" name="date" >
    <br><br>
    <input type="submit" value="Enviar">
</form>
<a href="/clinica/front.php/data">voltar</a><br/><br/>
</body>
</html>