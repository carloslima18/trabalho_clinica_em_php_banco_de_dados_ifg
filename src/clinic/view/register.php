<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html" charset="utf-8">
    <link rel="stylesheet" type="text/css" href="http://localhost/clinica/css2/register.css"/>
    <title>ler</title>
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
<h2>Novo paciente</h2>

<li class="form1">
    <h3>Informações pessoais</h3>
    <form name="cadastro" action="/clinica/front.php/register"  method="POST">
        <label>nome</label><br/>
        <input type="text" name="firstName" value=<?=$request->request->get("firstName")?>>
        <br><br/>
        <label>segundo nome</label><br/>
        <input type="text" name="lastName" value=<?=$request->request->get("lastName")?>>
        <br><br>
        <label>rg</label><br/>
        <input type="text" name="rg" value=<?=$request->request->get("rg")?>>
        <br><br>
        <label>data de nascimento</label><br/>
        <input type="text" name="date" value=<?=$request->request->get("date")?>>
        <br><br>
        <label>CPF</label><br/>
        <input type="text" name="cpf" value=<?=$request->request->get("cpf")?>>
        <br><br>
        <label>sexo</label><br/>
        <input type="text" name="sex" value=<?=$request->request->get("sex")?>>
        <br><br>
</li>
<li class="form3">
    <h3>endereço</h3>

    <label>rua</label><br/>
    <input type="text" name="rua" value=<?=$request->request->get("rua")?>>
    <br><br>
    <label>numero</label><br/>
    <input type="text" name="numero" value=<?=$request->request->get("numero")?>>
    <br><br>
    <label>complemento</label><br/>
    <input type="text" name="complemento" value=<?=$request->request->get("complemento")?>>
    <br><br>
    <label>bairro</label><br/>
    <input type="text" name="bairro" value=<?=$request->request->get("bairro")?>>
    <br><br>
    <label>cidade</label><br/>
    <input type="text" name="cidade" value=<?=$request->request->get("cidade")?>>
    <br><br>
    <label>estado</label><br/>
    <input type="text" name="estado" value=<?=$request->request->get("estado")?>>
    <br><br>
    <label>cep</label><br/>
    <input type="text" name="cep" value=<?=$request->request->get("cep")?>>
    <br><br>
</li>
<li class="form2">
    <h3>informações adicionais</h3>

    <label>celular</label><br/>
    <input type="text" name="phone" value=<?=$request->request->get("phone")?>>
    <br><br>

    <label>email</label><br/>
     <input type="text" name="email" value=<?=$request->request->get("email")?>>
    <br><br>
    <?php
    foreach ($this->session->getFlashBag()->all() as $type => $messages) {
        foreach ($messages as $message) {
            echo '<div class="alert alert-'.$type.'">'.$message.'</div>';
        }
    }
    echo $error;
    ?>
</li>
<input type="submit" value="Cadastrar paciente">
</form>
<a href="/clinica/front.php/data">voltar</a><br/><br/>
</body>
</html>