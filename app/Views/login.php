<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBank</title>
</head>
<body>
    <h1>Fazer login</h1>
    <form action="/fazerLogin" method="post">
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
        <input type="submit" value="Entrar">
    </form>
    <a href="/cadastro">Não possui uma conta? Cadastre-se</a>
</body>
</html>