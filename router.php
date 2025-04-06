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

//excluir cartão
if (isset($_POST['excluir_cartao'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_cad_cartao = htmlspecialchars($_POST['id_cad_cartao']);
    //invocar o método de excluir cartão
    $objController->excluir_cartao($id_cad_cartao);
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

//excluir bandeira
if (isset($_POST['excluir_bandeira'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_cad_band = htmlspecialchars($_POST['id_cad_band']);
    //invocar o método de excluir bandeira
    $objController->excluir_bandeira($id_cad_band);
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

//excluir bandeira
if (isset($_POST['excluir_forma'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_cad_forma = htmlspecialchars($_POST['id_cad_forma']);
    //invocar o método de excluir bandeira
    $objController->excluir_forma($id_cad_forma);
}
#GENERO
//inserir_genero
if (isset($_POST['inserir_genero'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $descricao_genero = htmlspecialchars($_POST['descricao_genero']);
    //invocar o método de _editora
    $objController->inserir_genero($descricao_genero);
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
