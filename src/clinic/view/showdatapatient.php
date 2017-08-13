<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>indexDentist</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/clinica/css2/deletepatient.css"/>
</head>
<body>
<div id="interface" class="container">
    <?php
    foreach ($this->session->getFlashBag()->all() as $type => $messages) {
        foreach ($messages as $message) {
            echo '<div class="alert alert-'.$type.'">'.$message.'</div>';
        }
    }

    echo "";
    echo "<table id='tabela' style='border: solid black'>";
    echo "<caption> tabela 2 </caption>";
    while($row = pg_fetch_array($this->consults,null,PGSQL_ASSOC)) {
        echo "<tr style='color: black'>";
        echo "<td style='background-color: cornflowerblue'>" . $row["primeiro_nome"] . "</td>";
        echo "<td style='background-color: cornflowerblue'>" . $row["data_nasc"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    ?>


    <form name="excluir" action="/clinica/front.php/deletepatient" method="POST">
        <h2>INSIRA O CPF PARA CONFIRMAR, CASO QUEIRA EXCLUIR PACIENTE:</h2><br>
        <input type="text" name="cpf" >
        <br><br>
        <input type="submit" value="Enviar">
    </form>
</div>
 </div>
<a href="/clinica/front.php/showpatient">voltar</a><br/><br/>
</body>
</html>