<?php
//pegar a url
$url = explode('?', $_SERVER['REQUEST_URI']);
//escolher na variável $url do link desejado
$pagina = $url[1];

#ROTAS DE REDIRECIONAMENTO
//redirecionar para pagina informada
if (isset($pagina)) {
    $objController = new Controller();
    $objController->redirecionar($pagina);
}

#ROTAS DE ACAO
//verificar o botao login foi acionado
if (isset($_POST['login'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $email = htmlspecialchars($_POST['email']);
    $senha = htmlspecialchars($_POST['senha']);
    //invocar o método de validar
    $objController->validar($email, $senha);
}

//recuperar_senha
if (isset($_POST['recuperar_senha'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $email = htmlspecialchars($_POST['email']);
    //invocar o método recuperar senha
    $objController->recuperarSenha($email);
}

#CARTÃO
//inserir cartão
if (isset($_POST['inserir_cartao'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_cad_band = htmlspecialchars($_POST['id_cad_band']);
    $nome_cartao = htmlspecialchars($_POST['nome_cartao']);
    $num_cartao = htmlspecialchars($_POST['num_cartao']);
    //invocar o método de inserir cartão
    $objController->inserir_cartao($id_cad_band, $nome_cartao, $num_cartao);
}

//consultar cartão
if (isset($_POST['consultar_cartao'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $nome_cartao = htmlspecialchars($_POST['nome_cartao']);
    //invocar o método de consultar cartao
    $objController->consultar_cartao($nome_cartao);
}

//alterar cartão
if (isset($_POST['alterar_cartao'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_cad_cartao = htmlspecialchars($_POST['id_cad_cartao']);
    $nome_cartao = htmlspecialchars($_POST['nome_cartao']);
    //invocar o método de alterar cartão
    $objController->alterar_cartao($id_cad_cartao, $nome_cartao);
}

//excluir cartão
if (isset($_POST['excluir_cartao'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_cad_cartao = htmlspecialchars($_POST['id_cad_cartao']);
    //invocar o método de excluir cartão
    $objController->excluir_cartao($id_cad_cartao);
}

#Bandeira
//inserir bandeira
if (isset($_POST['inserir_bandeira'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $nome_bandeira = htmlspecialchars($_POST['nome_bandeira']);
    //invocar o método de inserir bandeira
    $objController->inserir_bandeira($nome_bandeira);
}

//consultar bandeira
if (isset($_POST['consultar_bandeira'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $nome_bandeira = htmlspecialchars($_POST['nome_bandeira']);
    //invocar o método de consultar bandeira
    $objController->consultar_bandeira($nome_bandeira);
}

//alterar bandeira
if (isset($_POST['alterar_bandeira'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_cad_band = htmlspecialchars($_POST['id_cad_band']);
    $nome_band = htmlspecialchars($_POST['nome_band']);
    //invocar o método de alterar bandeira
    $objController->alterar_bandeira($id_cad_band, $nome_band);
}

//excluir bandeira
if (isset($_POST['excluir_bandeira'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_cad_band = htmlspecialchars($_POST['id_cad_band']);
    //invocar o método de excluir bandeira
    $objController->excluir_bandeira($id_cad_band);
}

#Forma
//inserir forma
if (isset($_POST['inserir_forma'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $desc_forma = htmlspecialchars($_POST['desc_forma']);
    //invocar o método de inserir bandeira
    $objController->inserir_forma($desc_forma);
}

//consultar forma
if (isset($_POST['consultar_forma'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $desc_forma = htmlspecialchars($_POST['desc_forma']);
    //invocar o método de consultar bandeira
    $objController->consultar_forma($desc_forma);
}

//alterar forma
if (isset($_POST['alterar_forma'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_cad_forma = htmlspecialchars($_POST['id_cad_forma']);
    $desc_forma = htmlspecialchars($_POST['desc_forma']);
    //invocar o método de alterar forma
    $objController->alterar_forma($id_cad_forma, $desc_forma);
}

//excluir forma
if (isset($_POST['excluir_forma'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_cad_forma = htmlspecialchars($_POST['id_cad_forma']);
    //invocar o método de excluir bandeira
    $objController->excluir_forma($id_cad_forma);
}

#Plano
//inserir plano
if (isset($_POST['inserir_plano'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $desc_plano = htmlspecialchars($_POST['desc_plano']);
    //invocar o método de inserir plano
    $objController->inserir_plano($desc_plano);
}

//consultar plano
if (isset($_POST['consultar_plano'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $desc_plano = htmlspecialchars($_POST['desc_plano']);
    //invocar o método de consultar plano
    $objController->consultar_plano($desc_plano);
}

//alterar plano
if (isset($_POST['alterar_plano'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_cad_plano = htmlspecialchars($_POST['id_cad_plano']);
    $desc_plano = htmlspecialchars($_POST['desc_plano']);
    //invocar o método de alterar plano
    $objController->alterar_plano($id_cad_plano, $desc_plano);
}

//excluir plano
if (isset($_POST['excluir_plano'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_cad_plano = htmlspecialchars($_POST['id_cad_plano']);
    //invocar o método de excluir plano
    $objController->excluir_plano($id_cad_plano);
}

#Plano
//inserir plano
if (isset($_POST['inserir_banco'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $nome_banco = htmlspecialchars($_POST['nome_banco']);
    $num_agencia = htmlspecialchars($_POST['num_agencia']);
    $num_conta= htmlspecialchars($_POST['num_conta']);
    //invocar o método de inserir plano
    $objController->inserir_banco($nome_banco, $num_agencia, $num_conta);
}

#TIPO
//consultar tipo
if (isset($_POST['consultar_tipo'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $desc_tipo = htmlspecialchars($_POST['desc_tipo']);
    //invocar o método de consultar plano
    $objController->consultar_tipo($desc_tipo);
}

#LIVRO
//inserir_livro
if (isset($_POST['inserir_livro'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $titulo = htmlspecialchars($_POST['titulo']);
    $id_editora = htmlspecialchars($_POST['id_editora']);
    $id_genero = htmlspecialchars($_POST['id_genero']);
    $preco = htmlspecialchars($_POST['preco']);
    //aautores do livro
    $autor = $_POST['autor'];
    //imagem do livro
    $imagem = $_FILES['imagem'];
    //invocar o método de inserir_livro
    $objController->inserir_livro($preco, $id_editora, $id_genero, $titulo, $autor, $imagem);
}

//consultar_livro
if (isset($_POST['consultar_livro'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $titulo = htmlspecialchars($_POST['titulo']);
    $id_genero = htmlspecialchars($_POST['id_genero']);
    //invocar o método de consultar_livro
    $objController->consultar_livro($titulo, $id_genero);
}

//excluir_livro
if (isset($_POST['excluir_livro'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_livro = htmlspecialchars($_POST['id_livro']);
    //invocar o método de excluir_livro
    $objController->excluir_livro($id_livro);
}

//alterar_livro
if (isset($_POST['alterar_livro'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_livro = htmlspecialchars($_POST['id_livro']);
    $titulo = htmlspecialchars($_POST['titulo']);
    //invocar o método alterar_livro
    $objController->alterar_livro($id_livro, $titulo);
}

//consultar_geral
if (isset($_POST['consultar_geral'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $palavra = htmlspecialchars($_POST['palavra']);
    //invocar o método alterar_livro
    $objController->consultar_geral($palavra);
}

//gerar_pdf
if (isset($_POST['gerar_pdf'])) {
    //instanciar controller
    $objController = new Controller();
    //invocar o método gerar pdf
    $objController->gerar_pdf();
}
