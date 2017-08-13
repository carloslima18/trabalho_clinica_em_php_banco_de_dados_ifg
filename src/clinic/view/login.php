<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>login</title>
</head>
<style>
    body{
        font-family: Arial,sans-serif;
        background: url("http://localhost/clinica/css2/imagens/dente.jpg") no-repeat;
        background-size: 100%;
    }
    h2{
        font-family: "Comic Sans MS";
        color: rgba(26,162,141,1);
        font-size: 30pt;
        text-align: center;
    }
    a{
        font-size: 20px;
        color:#006600 ;
        text-decoration: none;
    }
    form{
        display: block;
        margin-left: 300px;
    }

    label{
        color: #2ca02c;

    }
    b{
        font-size: 20pt;
        font-family: Arial;
        text-align: center;
    }
    input[type=text]{
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    input[type=password]{
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    button {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    div {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 10px;
        display: block;
        margin-left: 100px;
        margin-right: 400px;
    }
    nav#meng{
        font-size: 25px;
        display: block;
        margin-left: 300px;
        text-align: center;
        font-family: Arial;
        color: red;

    }

</style>
<body>

<h2>Clinica ferreira</h2>
<form action="/clinica/front.php/login" method="POST">
    <div>
        <label><b>Username</b></label><br/>
        <input type="text" placeholder="Enter Username" name="uname" required><br/><br/>
        <label><b>Password</b></label><br/>
        <input type="password" placeholder="Enter Password" name="psw" required><br/>
        <button type="submit">Login</button><br/>


    </div>
</form>
<br/>
 <br/>
<br/>
<br/>
<nav class="meng" id="meng">
    <br/>
    <?php
    foreach ($this->session->getFlashBag()->all() as $type => $messages) {
        foreach ($messages as $message) {
            echo '<div class="alert alert-'.$type.'">'.$message.'</div>';
        }
    }
    ?>
</nav>

<a href="/clinica/front.php/index">Pagina inicial</a>

</body>
</html>