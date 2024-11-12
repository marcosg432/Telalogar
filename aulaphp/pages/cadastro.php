<?php
// require_once: acessar outro arquivo.
  require_once '../classes/usuario.php'; 
  $usuario = new Usuario();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>TELA DE CADASTRO</h2>
    <form method="post">
        <label for="">NOME:</label>
        <input type="text" name="nome" id="nome"  placeholder="Digite o nome completo.">
        <br>
        <label for="">EMAIL:</label>
        <input type="text" name="email" id="email"  placeholder="Digite o email do usuario.">
        <br>
        <label for="">TELEFONE:</label>
        <input type="tel" name="telefone" id="telefone"  placeholder="Digite o telefone do usuario.">
        <br>
        <label for="">SENHA:</label>
        <input type="password" name="senha" id="senha"  placeholder="Digite a senha do usuario.">
        <br>
        <label for="">CONFIRMAR SENHA:</label>
        <input type="password" name="confsenha" id="senha"  placeholder="Confirmar senha.">
        <input type="submit" value="CADASTRAR">
        
        <p>Ja cadastrado? Clique <a href="login.php">Aqui</a>para acessar.</p>

    </form>

   <?php
if (isset($_POST['nome'])) {

    // Corrigindo a atribuição de variáveis
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    $confirmarSenha = addslashes($_POST['confsenha']); //addslashes: pra verificaçao. Nao manda pro banco  de dados.
    
    // Verificando se todos os campos foram preenchidos
    if (!empty($nome) && !empty($email) && !empty($telefone) && !empty($senha) && !empty($confirmarSenha)) {
        $usuario->conectar("cadastro140", "localhost", "devweb", "suporte@22");

        ECHO 'LOGINS ';

        // Checando se houve algum erro na conexão
        if ($usuario->msgErro == "") {
            if ($senha == $confirmarSenha) {
                echo 'senha ok';
                if ($usuario->cadastroUsuario($nome, $email, $telefone, $senha)) {
                    ?>
                    <div class="msg-sucesso">
                        <p>Cadastro realizado com sucesso.</p>
                        <p>Clique aqui para <a href="login.php">logar.</a></p>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="msg-erro">
                        <p>Erro ao cadastrar usuário.</p>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="msg-erro">
                    <p>As senhas não coincidem.</p>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="msg-erro">
                <?php echo "Erro: " . $usuario->msgErro; ?>
            </div>
            <?php
        }
    } else {
        ?>
        <div class="msg-erro">
            <p>Preencha todos os campos.</p>
        </div>
        <?php
    }
}
?>

    
</body>
</html>