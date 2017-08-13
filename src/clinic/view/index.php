<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>indexDentist</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/clinica/css2/home.css"/>
</head>
<body>
<div id="interface">
    <header id="cabecalho">
        <hgroup>
            <h1>Ferreira Ortodontia</h1>
        </hgroup>
        <nav>
            <li><a href="/clinica/front.php/login">logar</a></li><br/>
            <li><a href="/clinica/front.php/data">clientes</a></li><br/>
            <li><a href="/clinica/front.php/exit">sair</a></li><br/>
        </nav>
    </header>
</div>
<br/>
<br/>
<br/>
<br/>
<li>
<?php
foreach ($this->session->getFlashBag()->all() as $type => $messages) {
    foreach ($messages as $message) {
        echo '<div class="alert alert-'.$type.'">'.$message.'</div>';
    }
}
?>
</li>
</body>
</html>