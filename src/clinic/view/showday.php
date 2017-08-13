<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>indexDentist</title>
     <link rel="stylesheet" type="text/css" href="http://localhost/clinica/css2/home.css"/>
</head>
<body>
<div class="container">
    <h2><?php foreach ($this->session->getFlashBag()->all() as $type => $messages) {
            foreach ($messages as $message) {
                echo '<div class="alert alert-' . $type . '">' . $message . '</div>';
            }
        }


            echo"informacao da seguinte consulta pesquisada";
           echo "</br>";
            echo "<table id='tabela' style='border: solid black'>";
            echo "<caption> cpf/data/hora </caption>";
            while($row = pg_fetch_array($this->consults,null,PGSQL_ASSOC)) {
                echo "<tr style='color: black'>";
                echo "<td style='background-color: cornflowerblue'>" . $row["pcpf"] . "</td>";
                echo "<td style='background-color: cornflowerblue'>" . $row["cdata"] . "</td>";
                echo "<td style='background-color: cornflowerblue'>" . $row["hora"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";


        ?></h2>

</div>
<a href="/clinica/front.php/data">voltarrr</a><br/><br/>
</body>
</html>