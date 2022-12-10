<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBank</title>
</head>
<body>
    <h1>Dashboard</h1>
    <a href="/logout">Sair</a>

    <section>
        <h1>Sua conta</h1>
        <p>Agência: <?php echo $account['agency'] ?></p>
        <p>N° da conta: <?php echo $account['accountNumber'] ?></p>
        <p>Total: R$ <?php echo $account['money'] ?></p>
    </section>
    
    <section>
        <h1>Transferência</h1>
        <form action="/fazerTransferencia" method="post">
            <div>
                <label for="agency">Agência</label>
                <input type="number" id="agency" name="agency" required>
            </div>
            <div>
                <label for="account">Conta</label>
                <input type="number" id="account" name="account" required>
            </div>
            <div>
                <label for="value">Valor</label>
                <input type="number" id="value" name="value" required>
            </div>
            <?= session("error-transfer") ?>
            <br>
            <input type="submit" value="Fazer transferência">
        </form>
    </section>

    <section>
        <h1>Pagamentos</h1>
        <?php for ($i = 0; $i < count((is_countable($levies)?$levies:[])); $i++): ?>
            <form action="/pagarCobranca/<?php echo $levies[$i]['id']?>" method="post">
                <div>
                    <p>Valor da cobrança: <?php echo $levies[$i]['money']?></p>
                </div>
                <div>
                    <label for="typePayment">Método de pagamento</label>
                    <select name="typePayment" id="typePayment" required>
                        <option value="">Selecione</option>
                        <option value="0">Boleto</option>
                        <option value="1">Débito</option>
                        <option value="2">Pix</option>
                    </select>
                </div>
                <?= session("error-payment-" . $levies[$i]['id']) ?>
                <br>
                <input type="submit" value="Pagar">
            </form>
        <?php endfor ?>
        <?php if (count((is_countable($levies)?$levies:[])) == 0): ?>
            <p>Nenhuma cobrança registrada.</p>
        <?php endif ?>
    </section>

    <section>
        <h1>Poupança</h1>
        <div>
            <h3>Aplicação</h3>
            <form action="/fazerAplicacao" method="post">
                <div>
                    <label for="value">Valor</label>
                    <input type="number" id="value" name="value" required>
                </div>
                <?= session("error-applique") ?>
                <br>
                <input type="submit" value="Fazer aplicação">
            </form>
        </div>
        <div>
            <h3>Resgate</h3>
            <?php for ($j = 0; $j < count((is_countable($appliquies)?$appliquies:[])); $j++): ?>
                <form action="/resgatarAplicacao/<?php echo $appliquies[$j]['id']?>" method="post">
                    <div>
                        <p>Valor da cobrança: <?php echo $appliquies[$j]['money']?></p>
                    </div>
                    <?= session("error-payment-" . $appliquies[$j]['id']) ?>
                    <br>
                    <input type="submit" value="Resgatar">
                </form>
            <?php endfor ?>
            <?php if (count((is_countable($appliquies)?$appliquies:[])) == 0): ?>
                <p>Nenhum resgate registrado.</p>
            <?php endif ?>
        </div>
    </section>
</body>
</html>