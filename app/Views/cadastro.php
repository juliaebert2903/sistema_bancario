<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBank</title>
</head>
<body>
    <h1>Fazer cadastro</h1>
    <form action="/fazerCadastro" method="post">
        <div>
            <label for="nome">Nome</label>
            <input type="nome" id="nome" name="name" required>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Senha</label>
            <input type="password" id="password" name="password" required>
        </div>
        <?= session("error") ?>
        <br>
        <input type="submit" value="Cadastrar">
    </form>
    <a href="/login">Já possui conta? Faça o login</a>
</body>
</html>