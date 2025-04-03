<?php
//classe de controle
class Controller
{
    //redirecionar pagina
    public function redirecionar($pagina)
    {
        //iniciar sessao
        session_start();
        //incluir menu
        $menu = $this->menu();
        //incluir a view
        require_once 'view/' . $pagina . '.php';
    }

    //validar login
    public function validar($email, $senha)
    {
        //instanciar a classe Usuário
        $objUsuario = new Usuario();
        //validar usuario
        if ($objUsuario->validarLogin($email, $senha) == true) {
            //iniciar sessao
            session_start();
            //iniciar variaves de sessao
            $_SESSION['email']  = $email;
            $_SESSION['perfil'] = $objUsuario->perfilUsuario($email);
            //menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/principal.php';
        } else {
            include_once 'login.php';
            $this->mostrarMensagem("Login ou senha inválidos!");
        }
    }

    public function validarSessao()
    {
        //verificar variaveis de sessao
        if (! isset($_SESSION['email']) and ! isset($_SESSION['perfil'])) {
            //acesso negado
            header("location: login.php");
        }
    }

    public function recuperarSenha($email)
    {
        //instanciar a classe Usuário
        $objUsuario = new Usuario();
        //verificar se email existe
        if ($objUsuario->validarEmail($email) == true) {
            //gerar nova senha
            $senha = md5('12345678');
            //$senha = md5(substr(md5(date("YmdHis")), 1, 6));

            //atualizar senha
            $objUsuario->alterarSenha($email, $senha);

            //definir o servidor
            define('HOST', 'smtp.gmail.com');
            define('PORT', '587');
            define('USERNAME', 'senacdf.operadormicro@gmail.com');
            define('PASSWORD', 'uetz ezsn jjuy klyo');
            define('FROM', 'senacdf.operadormicro@gmail.com');

            //dados do envio
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = "TLS";
            $mail->Host       = HOST;
            $mail->Port       = PORT;
            $mail->Username   = USERNAME;
            $mail->Password   = PASSWORD;

            //dados do remetente
            $mail->setFrom(FROM, 'SISTEMA SGL');
            $mail->addAddress($email);

            //dados do email
            $mail->IsHTML(true);
            $mail->Subject = ('Recuperação de Senha - SGL');
            $mail->Body    = ('<br>Sua nova senha é: <b>12345678</b>');
            $mail->Charset = 'UTF-8';

            //eviar email
            if (! $mail->Send()) {
                include_once 'recuperar.php';
                $this->mostrarMensagem("Erro ao enviar e-mail! $mail->ErrorInfo");
            } else {
                include_once 'login.php';
                $this->mostrarMensagem("A nova senha foi enviada para o e-mail informado!");
            }

        } else {
            include_once 'recuperar.php';
            $this->mostrarMensagem("E-mail não cadastrado!");
        }
    }

    //consultar_geral
    public function consultar_geral($palavra)
    {
        //instanciar a classe Livro
        $objLivro = new Livro();
        //iniciar sessao
        session_start();
        //invocar o método
        $_SESSION['resultado'] = $objLivro->consultarGeral($palavra);
        header("location: livro.php");
    }

    //mostrar menu
    public function menu()
    {
        echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">';
        echo '<div class="container-fluid">';
        echo '    <a class="navbar-brand" href="#">SFP-GZ</a>';
        echo '    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">';
        echo '        <span class="navbar-toggler-icon"></span>';
        echo '    </button>';
        echo '    <div class="collapse navbar-collapse" id="navbarNav">';
        echo '        <ul class="navbar-nav me-auto">';
        //Principal
        echo '            <li class="nav-item justify-content-center">';
        echo '                <a class="nav-link" href="index.php?principal">Início</a>';
        echo '            </li>';
        //Lançamentos
        echo '            <li class="nav-item">';
        echo '                <a class="nav-link" href="index.php?principal">Lançamentos</a>';
        echo '            </li>';
        //Cadastros
        echo '            <li class="nav-item dropdown">';
        echo '                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
        echo '                    <i class="bi bi-people-fill"></i> Cadastros';
        echo '                </a>';
        echo '                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
        echo '                    <li><a class="dropdown-item" href="index.php?inserir_forma"> <i class="bi bi-search"></i> Formas de rec/pag</a></li>';
        echo '                    <li><a class="dropdown-item" href="index.php?inserir_plano"><i class="bi bi-file-earmark-plus"></i> Planos de contas</a></li>';
        echo '                    <li><a class="dropdown-item" href="index.php?inserir_banco"><i class="bi bi-file-earmark-plus"></i> Bancos</a></li>';
        echo '                    <li><a class="dropdown-item" href="index.php?inserir_cartao"><i class="bi bi-file-earmark-plus"></i> Cartões</a></li>';
        echo '                    <li><a class="dropdown-item" href="index.php?inserir_bandeira"><i class="bi bi-file-earmark-plus"></i> Bandeiras de Cartões</a></li>';
        echo '                </ul>';
        echo '            </li>';
        //Relatórios
        echo '            <li class="nav-item dropdown">';
        echo '                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
        echo '                    <i class="bi bi-journal-album"></i> Relatórios';
        echo '                </a>';
        echo '                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
        echo '                    <li><a class="dropdown-item" href="index.php?consultar_editora"> <i class="bi bi-search"></i> Receitas/mês</a></li>';
        echo '                    <li><a class="dropdown-item" href="index.php?inserir_editora"><i class="bi bi-file-earmark-plus"></i> Despesas/mês</a></li>';
        echo '                    <li><a class="dropdown-item" href="index.php?inserir_editora"><i class="bi bi-file-earmark-plus"></i> Saldo/mês</a></li>';
        echo '                </ul>';
        echo '            </li>';

        echo '        </ul>';
        echo '        <ul class="navbar-nav ms-auto">';
        echo '            <li class="nav-item dropdown">';
        echo '                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
        echo '                    <i class="bi bi-person-fill"></i>' . $_SESSION['email'];
        echo '                </a>';
        echo '                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">';
        echo '                    <li><a class="dropdown-item" href="index.php?sair"><i class="bi bi-box-arrow-right"></i> Sair</a></li>';
        echo '                </ul>';
        echo '            </li>';
        echo '        </ul>';
        echo '    </div>';
        echo '</div>';
        echo '</nav>';
    }

    public function mostrarMensagem($mensagem)
    {
        //<!-- Modal -->
        echo '<div class="modal fade" id="mensagem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo '  <div class="modal-dialog">';
        echo '    <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '        <h5 class="modal-title" id="exampleModalLabel">Informação</h5>';
        echo '        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '      <div class="modal-body">';
        echo '        <div class="alert alert-warning" role="alert">';
        echo $mensagem;
        echo '        </div>';
        echo '      </div>';
        echo '      <div class="modal-footer">';
        echo '        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">X</button>';
        echo '      </div>';
        echo '    </div>';
        echo '  </div>';
        echo '</div>';

        //JS
        echo '<script>';
        echo '    document.addEventListener("DOMContentLoaded", function() {';
        echo '    var myModal = new bootstrap.Modal(document.getElementById("mensagem"));';
        echo '    myModal.show();});';
        echo '</script>';
    }

    //inserir autor
    public function inserir_autor($nome_autor)
    {
        //instanciar a classe Autor
        $objAutor = new Autor();
        //invocar o método
        if ($objAutor->inserirAutor($nome_autor) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar.php';
            //mostrar mensagem
            $this->mostrarMensagem("Autor inserido com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao inserir autor!");
        }
    }

    //consultar autor
    public function consultar_autor($nome_autor)
    {
        //instanciar a classe Autor
        $objAutor = new Autor();
        //invocar o método
        if ($objAutor->consultarAutor($nome_autor) == false) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao consultar!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //resultado da consulta
            $resultado = $objAutor->consultarAutor($nome_autor);
            //incluir a view
            include_once 'view/consultar.php';
        }
    }

    //excluir autor
    public function excluir_autor($id_autor)
    {
        //instanciar a classe Autor
        $objAutor = new Autor();
        //invocar o método
        if ($objAutor->excluirAutor($id_autor) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar.php';
            //mostrar mensagem
            $this->mostrarMensagem("Autor excluído com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao excluir autor!");
        }
    }

    //alterar autor
    public function alterar_autor($id_autor, $nome_autor)
    {
        //instanciar a classe Autor
        $objAutor = new Autor();
        //invocar o método
        if ($objAutor->alterarAutor($id_autor, $nome_autor) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar.php';
            //mostrar mensagem
            $this->mostrarMensagem("Autor alterado com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao alterar autor!");
        }
    }

    #Bandeira
    //inserir Bandeira
    public function inserir_bandeira($nome_bandeira)
    {
        //instanciar a classe Autor
        $objBandeira = new Bandeira();
        //invocar o método
        if ($objBandeira->inserirBandeira($nome_bandeira) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/inserir_bandeira.php';
            //mostrar mensagem
            $this->mostrarMensagem("Bandeira inserida com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/inserir_bandeira.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao inserir bandeira!");
        }
    }

    //consultar editora
    public function consultar_bandeira($nome_bandeira)
    {
        //instanciar a classe Autor
        $objbandeira = new Bandeira();
        //invocar o método
        if ($objBandeira->consultarBandeira($nome_bandeira) == false) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_bandeira.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao consultar!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //resultado da consulta
            $resultado = $objBandeira->consultarBandeira($nome_bandeira);
            //incluir a view
            include_once 'view/consultar_bandeira.php';
        }
    }

    //excluir editora
    public function excluir_editora($id_editora)
    {
        //instanciar a classe Autor
        $objEditora = new Editora();
        //invocar o método
        if ($objEditora->excluirEditora($id_editora) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_editora.php';
            //mostrar mensagem
            $this->mostrarMensagem("Editora excluída com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_editora.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao excluir Editora!");
        }
    }

    //alterar editora
    public function alterar_editora($id_editora, $nome_editora)
    {
        //instanciar a classe Autor
        $objEditora = new Editora();
        //invocar o método
        if ($objEditora->alterarEditora($id_editora, $nome_editora) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_editora.php';
            //mostrar mensagem
            $this->mostrarMensagem("Editora alterado com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_editora.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao alterar Editora!");
        }
    }

    #genero
    public function inserir_genero($nome_genero)
    {
        //instanciar a classe Genero
        $objGenero = new Genero();
        //invocar o método
        if ($objGenero->inserirGenero($nome_genero) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_genero.php';
            //mostrar mensagem
            $this->mostrarMensagem("Genero inserido com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_genero.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao inserir genero!");
        }
    }

    #livro
    //inserir livro
    public function inserir_livro($preco, $id_editora, $id_genero, $titulo, $autor, $imagem)
    {
        //pasta onde o arquivo será salvo
        $local = "assets/img/";
        //nome da imagem
        $nome_arquivo = $imagem['name'];
        //gerar codigo aleatrorio
        $codigo = strtoupper(substr(md5(date("YmdHis")), 1, 7));
        //caminho da imagem
        $caminho_imagem = $local . $codigo . $nome_arquivo;
        //mover para pasta assets/img
        move_uploaded_file($imagem['tmp_name'], $local . $codigo . $nome_arquivo);

        //instanciar a classe Livro
        $objLivro = new Livro();
        //invocar o método
        if ($objLivro->inserirLivro($preco, $id_editora, $id_genero, $titulo, $autor, $caminho_imagem) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_livro.php';
            //mostrar mensagem
            $this->mostrarMensagem("Livro inserido com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_livro.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao inserir Livro!");
        }
    }

    //consultar livro
    public function consultar_livro($titulo, $id_genero)
    {
        //instanciar a classe Livro
        $objLivro = new Livro();
        //invocar o método consultar
        if ($objLivro->consultarLivro($titulo, $id_genero) == false) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_livro.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao consultar!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //resultado da consulta
            $resultado = $objLivro->consultarLivro($titulo, $id_genero);
            //incluir a view
            include_once 'view/consultar_livro.php';
        }
    }

    //excluir livro
    public function excluir_livro($id_livro)
    {
        //instanciar a classe Livro
        $objLivro = new Livro();
        //invocar o método
        if ($objLivro->excluirLivro($id_livro) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_livro.php';
            //mostrar mensagem
            $this->mostrarMensagem("Livro excluído com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_livro.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao excluir Livro!");
        }
    }

    //alterar livro
    public function alterar_livro($id_livro, $titulo)
    {
        //instanciar a classe Livro
        $objLivro = new Livro();
        //invocar o método
        if ($objLivro->alterarLivro($id_livro, $titulo) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_livro.php';
            //mostrar mensagem
            $this->mostrarMensagem("Livro alterado com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_livro.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao alterar Livro!");
        }
    }

    public function modal_excluir_autor($id_autor, $nome_autor)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="excluir_autor' . $id_autor . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Excluir Autor</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '  <div class="modal-body">';
        echo $nome_autor;
        echo '  </div>';
        echo '<form method="post" action="index.php">';
        echo ' <div class="modal-footer">';
        echo '    <input type="hidden" name="id_autor" value="' . $id_autor . '">';
        echo '    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="excluir_autor" class="btn btn-danger">Excluir</button>';
        echo ' </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function modal_alterar_autor($id_autor, $nome_autor)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="alterar_autor' . $id_autor . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Alterar Autor</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '<form method="post" action="index.php">';
        echo '  <div class="modal-body">';
        echo '     <input type="text" class="form-control" name="nome_autor" value="' . $nome_autor . '">';
        echo '  </div>';
        echo '  <div class="modal-footer">';
        echo '    <input type="hidden" name="id_autor" value="' . $id_autor . '">';
        echo '    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="alterar_autor" class="btn btn-primary">Alterar</button>';
        echo '  </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function modal_excluir_editora($id_editora, $nome_editora)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="excluir_editora' . $id_editora . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Excluir Editora</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '  <div class="modal-body">';
        echo $nome_editora;
        echo '  </div>';
        echo '<form method="post" action="index.php">';
        echo ' <div class="modal-footer">';
        echo '    <input type="hidden" name="id_editora" value="' . $id_editora . '">';
        echo '    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="excluir_editora" class="btn btn-danger">Excluir</button>';
        echo ' </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function modal_alterar_editora($id_editora, $nome_editora)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="alterar_editora' . $id_editora . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Alterar Editora</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '<form method="post" action="index.php">';
        echo '  <div class="modal-body">';
        echo '     <input type="text" class="form-control" name="nome_editora" value="' . $nome_editora . '">';
        echo '  </div>';
        echo '  <div class="modal-footer">';
        echo '    <input type="hidden" name="id_editora" value="' . $id_editora . '">';
        echo '    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="alterar_editora" class="btn btn-primary">Alterar</button>';
        echo '  </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    //select de editora
    public function selectBandeira()
    {
        //instanciar a classe Editora
        $objBandeira = new Bandeira();
        //invocar o método
        $resultado = $objBandeira->consultarBandeira(null);
        //montar o select dinamicamente
        echo '<label for="bandeira" class="form-label">Bandeira do cartão</label>';
        echo '<select name="id_cad_band" class="form-select" aria-label="Default select example" required>';
        echo '    <option value="" selected>Selecione a bandeira do cartão</option>';
        foreach ($resultado as $key => $valor) {
            echo '<option value="' . $valor->id_cad_band . '">' . $valor->nome_band . '</option>';
        }
        echo '</select>';
    }

    //select de genero
    public function selectGenero()
    {
        //instanciar a classe Generro
        $objGenero = new Genero();
        //invocar o método
        $resultado = $objGenero->consultarGenero(null);
        //montar o select dinamicamente
        echo '<label for="genero" class="form-label">Genero</label>';
        echo '<select name="id_genero" class="form-select" aria-label="Default select example">';
        echo '    <option value="" selected>Selecine o genero</option>';
        foreach ($resultado as $key => $valor) {
            echo '<option value="' . $valor->id_genero . '">' . $valor->descricao . '</option>';
        }
        echo '</select>';
    }

    //selec autor
    public function selectAutor()
    {
        //instanciar a classe Autor
        $objAutor = new Autor();
        //invocar o método
        $resultado = $objAutor->consultarAutor(null);
        echo '<select class="form-select" multiple aria-label="multiple select example" name="autor[]">';
        foreach ($resultado as $key => $valor) {
            echo '<option value="' . $valor->id_autor . '">' . $valor->nome . '</option>';
        }
        echo '</select>';
    }

    public function modal_excluir_livro($id_livro, $titulo)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="excluir_livro' . $id_livro . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Excluir Editora</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '  <div class="modal-body">';
        echo 'Deseja excluir o livro ' . $titulo . '?';
        echo '  </div>';
        echo '<form method="post" action="index.php">';
        echo ' <div class="modal-footer">';
        echo '    <input type="hidden" name="id_livro" value="' . $id_livro . '">';
        echo '    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="excluir_livro" class="btn btn-danger">Excluir</button>';
        echo ' </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function modal_alterar_livro($id_livro, $titulo)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="alterar_livro' . $id_livro . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Alterar Livro</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '<form method="post" action="index.php">';
        echo '  <div class="modal-body">';
        echo '     <label for="titulo" class="form-label">Titulo</label>';
        echo '     <input type="text" class="form-control" name="titulo" value="' . $titulo . '">';
        echo '  </div>';
        echo '  <div class="modal-footer">';
        echo '    <input type="hidden" name="id_livro" value="' . $id_livro . '">';
        echo '    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="alterar_livro" class="btn btn-primary">Alterar</button>';
        echo '  </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function nomeAutorLivro($id_livro)
    {
        ///instanciar a classe Autor
        $objAutor = new Autor();
        //invocar o método
        $resultado = $objAutor->nomeAutorLivro($id_livro);
        //mostrar autores do livro
        foreach ($resultado as $key => $valor) {
            echo $valor->nome . '<br>';
        }
    }

    public function gerar_pdf()
    {
        //iniciar sessao
        session_start();

        //pegar dos dados para inserir no pdf
        foreach ($_SESSION['resultado'] as $key => $valor) {
            $titulo .= '' . $valor->titulo;
        }

        //montar o relatorio
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(70, 10, 'Relatorio de Livros');
        $data = date('d/m/Y');
        $pdf->Cell(10, 35, $data);
        $pdf->Cell(70, 50, $titulo);
        $pdf->Output();
    }
}
