<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html" charset="utf-8">
    <link rel="stylesheet" type="text/css" href="http://localhost/clinica/css2/deletepatient.css"/>
    <title>ler</title>
</head>
<body>
<div class="container">
    <h2><?php foreach ($this->session->getFlashBag()->all() as $type => $messages) {
            foreach ($messages as $message) {
                echo '<div class="alert alert-'.$type.'">'.$message.'</div>';
            }
        }
        echo $error;
        ?></h2>
    <br>
</div>
 <form name="cadastro" action="/clinica/front.php/showall"  method="POST">
    <label><h3>CONSULTAR PACIENTE DO CPF:</h3></label>
    <input type="text" name="cpf" >
    <br><br>
    <input type="submit" value="CONSULTAR">
</form>
<a href="/clinica/front.php/data">voltar</a><br/><br/>
</body>
</html>