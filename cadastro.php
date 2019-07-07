<!DOCTYPE html>
<html>
<head>
    <title>Storm - Cadastro Usuário</title>
    <?php include_once('view/head.php'); ?>
    <link rel="stylesheet" type="text/css" href="css/cadastroUsuario.css">
    <script src="js/main.js"></script>
</head>
<body>

    <?php include_once('view/header.php'); ?>

    <main>

        <div class="tituloForm cor4"><h1>Crie sua conta</h1></div>

        <section class="formulario">

            <form method="post" action="cadastrar.php" onsubmit="return verifyForm()">
                <label for="nome"><p>Nome completo: </p></label>
                <input type="text" name="nome" class="inputText" placeholder="Digite seu nome aqui..." required> <br /><br />
                
                <label for="usuario"><p>Nome de usuário: </p></label>
                <input type="text" name="usuario" class="inputText" placeholder="Digite o nome de usuário..." required> <br /><br />
                <div class="usuarioErro">
                    <span for="lblErro">Nome de usuário já utilizado</span>
                </div>

                <label for="email"><p>Seu e-mail: </p></label>
                <input type="email" name="email" class="inputText" placeholder="Digite seu e-mail..." required> <br /><br />
                <div class="emailErro_1">
                    <span for="lblErro">Esse e-mail já é utilizado</span>
                </div>

                <label for="email2"><p>Insira seu e-mail novamente: </p></label>
                <input type="email" name="email2" class="inputText" placeholder="Repita o email..." required> <br /><br />
                <div class="emailErro_2">
                    <span for="lblErro">Os e-mails não condizem</span>
                </div>

                <label for="senha"><p>Digite sua senha: </p></label>
                <input type="password" name="senha" class="inputText" placeholder="Digite sua senha..." required> <br /><br />

                <label for="senha2"><p>Insira sua senha novamente: </p></label>
                <input type="password" name="senha2" class="inputText" placeholder="Repita a senha..." required> <br /><br />
                <div class="senhaErro">
                    <span for="lblErro">As senhas não condizem</span>
                </div>

                <label for="dateNasc"><p>Data de nascimento: </p></label>
                <input type="date" class="inputDate" name="dateNasc" required> <br /><br />

                <label for="sexo"><p>Sexo: </p></label>
                <select name="sexo" class="selectSexo" required>
                    <option value="-1">Escolha seu Sexo</option>
                    <option value="1">Masculino</option>
                    <option value="2">Feminino</option>
                    <option value="3">Indefinido</option>
                </select><br /><br /><br /><br /><br />

                <input type="submit" name="enviar" id="btnEnviar" value="Inscreva-se">
            </form>
            
        </section>

    </main>

    <?php include_once('view/footer.php') ?>

</body>
</html>