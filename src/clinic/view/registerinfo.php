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

    //cpf,rg,primeiro_nome,segundo_nome,sexo,data_nasc,endereco,cidade,estado,cep,contatos,email) values('$cpf','$rg','$primeiro_nome','$segundo_nome','$sexo','$data_nasc','$endereco','$cidade','$estado','$cep','$contatos','$email');");

    echo "</br>";

    echo "Informações do paciente"."<br>";
    echo "";
    echo "<table id='tabela' style='border: solid cornflowerblue'>";
    echo "<caption>informações de paciente</caption>";
    while($row = pg_fetch_array($this->consults,null,PGSQL_ASSOC)) {
        echo "<tr style='color: black'>";
        echo "<td style='background-color: cornflowerblue'>" . $row["primeiro_nome"] . "</td>";
        echo "<td style='background-color: cornflowerblue'>" . $row["segundo_nome"] . "</td>";
        echo "<td style='background-color: cornflowerblue'>" . $row["sexo"] . "</td>";
        echo "<td style='background-color: cornflowerblue'>" . $row["data_nasc"] . "</td>";
        echo "<td style='background-color: cornflowerblue'>" . $row["endereco"] . "</td>";
        echo "<td style='background-color: cornflowerblue'>" . $row["cidade"] . "</td>";
        echo "<td style='background-color: cornflowerblue'>" . $row["estado"] . "</td>";
        echo "<td style='background-color: cornflowerblue'>" . $row["cep"] . "</td>";
        echo "<td style='background-color: cornflowerblue'>" . $row["contatos"] . "</td>";
        echo "<td style='background-color: cornflowerblue'>" . $row["email"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";


    ?>
</div>
<a href="/clinica/front.php/data">voltar</a><br/><br/>
</body>
</html>