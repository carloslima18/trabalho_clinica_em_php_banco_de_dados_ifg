<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html" charset="utf-8">
    <link rel="stylesheet" type="text/css" href="http://localhost/clinica/css2/deletepatient.css"/>
    <title>ler</title>
</head>
<body>
<div class="container">
    <h2><?php
         /*foreach ($this->consults as $messages) {
            echo $messages."<BR>";
        }*/
        ?>

    </h2>
    <br>
</div>
<div class="container">
    <h3><?php foreach ($this->session->getFlashBag()->all() as $type => $messages) {
            foreach ($messages as $message) {
                echo '<div class="alert alert-'.$type.'">'.$message.'</div>';
            }
        }
       // echo $error;


        echo "";
        echo "<table id='tabela' style='border: solid black'>";
        echo "<caption> nome\data </caption>";
        if($this->consults != NULL) {
            while ($row = pg_fetch_array($this->consults, null, PGSQL_ASSOC)) {
                echo "<tr style='color: black'>";
                echo "<td style='background-color: cornflowerblue'>" . $row["primeiro_nome"] . "</td>";
                echo "<td style='background-color: cornflowerblue'>" . $row["cdata"] . "</td>";
                echo "</tr>";
            }
        }
        echo "</table>";


        ?></h3>


    <br>
</div>
 <form name="todas consultas" action="/clinica/front.php/allconsults"  method="POST">
    <label><h3>CONSULTAS DO DIA:</h3></label>
    <input type="text" name="date" >
    <br/><br/>
    <input type="submit" value="CONSULTAR">
</form>
<a href="/clinica/front.php/data">voltar</a><br/><br/>
</body>
</html>
