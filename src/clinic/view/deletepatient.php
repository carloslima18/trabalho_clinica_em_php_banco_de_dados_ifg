<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html" charset="utf-8">
    <title>ler</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/clinica/css2/deletepatient.css"/>
</head>
<body>
<div class="container">
    <h2><?php foreach ($this->session->getFlashBag()->all() as $type => $messages) {
            foreach ($messages as $message) {
                echo '<div class="alert alert-'.$type.'">'.$message.'</div>';
            }
        }
        ?></h2>
    <br>

</div>

 </div>
<form name="excluir" action="/clinica/front.php/deletepatient" method="POST">
    <h2>INSIRA O CPF DO CLIENTE A EXCLUIR:</h2><br>
    <input type="text" name="cpf" >
    <br><br>
    <input type="submit" value="Enviar">
</form>
<a href="/clinica/front.php/data">voltar</a><br/><br/>
</body>
</html>