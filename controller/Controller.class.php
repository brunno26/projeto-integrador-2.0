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
        echo '  <div class="container-fluid">';
        echo '      <a class="navbar-brand mx-auto fs-4" href="#">SFP-GZ</a>';
        echo '      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">';
        echo '       <span class="navbar-toggler-icon"></span>';
        echo '      </button>';
        echo '      <div class="collapse navbar-collapse" id="navbarResponsive">';
        echo '          <ul class="navbar-nav mx-auto fs-5">';
        //Principal
        echo '              <li class="nav-item">';
        echo '                  <a class="nav-link" href="index.php?principal">Dashboard</a>';
        echo '              </li>';
        //Lançamentos
        echo '              <li class="nav-item">';
        echo '                  <a class="nav-link" href="index.php?inserir_lancamento">Lançamentos</a>';
        echo '              </li>';
        //Ação
        echo '              <li class="nav-item dropdown">';
        echo '                  <a class="nav-link dropdown-toggle" data-bs-auto-close="outside" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Cadastros</a>';
        echo '                  <ul class="dropdown-menu">';
        echo '                      <li><a href="index.php?inserir_banco" class="dropdown-item">Bancos</a></li>';
        echo '                          <li><a href="index.php?inserir_bandeira" class="dropdown-item">Bandeiras de cartões</a></li>';
        echo '                          <li><a href="index.php?inserir_cartao" class="dropdown-item">Cartões</a></li>';
        echo '                          <li><a href="index.php?inserir_forma" class="dropdown-item">Formas de rec/pag</a></li>';
        echo '                          <li><a href="index.php?inserir_plano" class="dropdown-item">Plano de contas</a></li>';
        echo '                  </ul>';
        echo '              </li>';
        echo '              <li class="nav-item dropdown">';
        echo '                  <a class="nav-link dropdown-toggle" data-bs-auto-close="outside" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Consultas</a>';
        echo '                  <ul class="dropdown-menu">';
        echo '                      <li><a href="index.php?consultar_banco" class="dropdown-item">Bancos</a></li>';
        echo '                      <li><a href="index.php?consultar_bandeira" class="dropdown-item">Bandeiras de cartões</a></li>';
        echo '                      <li><a href="index.php?consultar_cartao" class="dropdown-item">Cartões</a></li>';
        echo '                      <li><a href="index.php?consultar_forma" class="dropdown-item">Formas de rec/pag</a></li>';
        echo '                      <li><a href="index.php?consultar_plano" class="dropdown-item">Plano de contas</a></li>';
        echo '                  </ul>';
        echo '              </li>';
        //Relatórios
        echo '              <li class="nav-item dropdown">';
        echo '                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Relatórios';
        echo '                  </a>';
        echo '                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
        echo '                      <li><a class="dropdown-item" href="index.php?consultar_editora">Receitas/mês</a></li>';
        echo '                      <li><a class="dropdown-item" href="index.php?inserir_editora">Despesas/mês</a></li>';
        echo '                      <li><a class="dropdown-item" href="index.php?inserir_editora">Saldo/mês</a></li>';
        echo '                  </ul>';
        echo '              </li>';
        echo '          </ul>';
        echo '          <ul class="navbar-nav fs-5">';
        //Sair
        echo '              <li class="nav-item dropdown">';
        echo '                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-fill"></i>' . $_SESSION['email'];
        echo '                  </a>';
        echo '                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">';
        echo '                      <li><a class="dropdown-item" href="index.php?sair"><i class="bi bi-box-arrow-right"></i> Sair</a></li>';
        echo '                  </ul>';
        echo '              </li>';
        echo '          </ul>';
        echo '      </div>';
        echo '  </div>';
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

    #Cartão
    //inserir cartão
    public function inserir_cartao($id_cad_band, $nome_cartao, $num_cartao)
    {
        //instanciar a classe Cartão
        $objCartao = new Cartao();
        //invocar o método
        if ($objCartao->inserirCartao($id_cad_band, $nome_cartao, $num_cartao) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu      = $this->menu();
            $resultado = $objCartao->consultarCartao(null);
            //incluir a view
            include_once 'view/consultar_cartao.php';
            //mostrar mensagem
            $this->mostrarMensagem("Cartão inserido com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_cartao.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao inserir cartão!");
        }
    }

    //consultar cartão
    public function consultar_cartao($nome_cartao)
    {
        //instanciar a classe Cartão
        $objCartao = new Cartao();
        //invocar o método
        if ($objCartao->consultarCartao($nome_cartao) == false) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_cartao.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao consultar!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //resultado da consulta
            $resultado = $objCartao->consultarCartao($nome_cartao);
            //incluir a view
            include_once 'view/consultar_cartao.php';
        }
    }

    //alterar cartão
    public function alterar_cartao($id_cad_cartao, $nome_cartao)
    {
        //instanciar a classe Cartão
        $objCartao = new Cartao();
        //invocar o método
        if ($objCartao->alterarCartao($id_cad_cartao, $nome_cartao) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_cartao.php';
            //mostrar mensagem
            $this->mostrarMensagem("Cartão alterado com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_cartao.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao alterar cartão!");
        }
    }

    //excluir cartão
    public function excluir_cartao($id_cad_cartao)
    {
        //instanciar a classe Cartão
        $objCartao = new Cartao();
        //invocar o método
        if ($objCartao->excluirCartao($id_cad_cartao) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_cartao.php';
            //mostrar mensagem
            $this->mostrarMensagem("Cartão excluído com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_cartao.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao excluir cartão!");
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
            $menu      = $this->menu();
            $resultado = $objBandeira->consultarBandeira(null);
            //incluir a view
            include_once 'view/consultar_bandeira.php';
            //mostrar mensagem
            $this->mostrarMensagem("Bandeira inserida com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_bandeira.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao inserir bandeira!");
        }
    }

    //consultar bandeira
    public function consultar_bandeira($nome_bandeira)
    {
        //instanciar a classe Autor
        $objBandeira = new Bandeira();
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
            //resultado da consulta
            $resultado = $objBandeira->consultarBandeira($nome_bandeira);
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_bandeira.php';
        }
    }

    //alterar bandeira
    public function alterar_bandeira($id_cad_band, $nome_band)
    {
        //instanciar a classe bandeira
        $objBandeira = new Bandeira();
        //invocar o método
        if ($objBandeira->alterarBandeira($id_cad_band, $nome_band) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_bandeira.php';
            //mostrar mensagem
            $this->mostrarMensagem("Bandeira alterada com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_bandeira.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao alterar Bandeira!");
        }
    }

    //excluir bandeira
    public function excluir_bandeira($id_cad_band)
    {
        //instanciar a classe Bandeira
        $objBandeira = new Bandeira();
        //invocar o método
        if ($objBandeira->excluirBandeira($id_cad_band) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_bandeira.php';
            //mostrar mensagem
            $this->mostrarMensagem("Bandeira excluída com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_bandeira.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao excluir Bandeira!");
        }
    }

    #Forma Pagamento ou Recebimento
    //inserir forma
    public function inserir_forma($desc_forma)
    {
        //instanciar a classe forma
        $objForma = new Forma();
        //invocar o método
        if ($objForma->inserirForma($desc_forma) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu      = $this->menu();
            $resultado = $objForma->consultarForma(null);
            //incluir a view
            include_once 'view/consultar_forma.php';
            //mostrar mensagem
            $this->mostrarMensagem("Forma inserida com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_forma.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao inserir forma!");
        }
    }

    //consultar forma
    public function consultar_forma($desc_forma)
    {
        //instanciar a classe Autor
        $objForma = new Forma();
        //invocar o método
        if ($objForma->consultarForma($desc_forma) == false) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_forma.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao consultar forma!");
        } else {
            //iniciar sessao
            session_start();
            //resultado da consulta
            $resultado = $objForma->consultarForma($desc_forma);
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_forma.php';
        }
    }

    //alterar forma
    public function alterar_forma($id_cad_forma, $desc_forma)
    {
        //instanciar a classe forma
        $objForma = new Forma();
        //invocar o método
        if ($objForma->alterarForma($id_cad_forma, $desc_forma) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_forma.php';
            //mostrar mensagem
            $this->mostrarMensagem("Forma alterada com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_forma.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao alterar forma!");
        }
    }

    //excluir forma
    public function excluir_forma($id_cad_forma)
    {
        //instanciar a classe Bandeira
        $objForma = new Forma();
        //invocar o método
        if ($objForma->excluirForma($id_cad_forma) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_forma.php';
            //mostrar mensagem
            $this->mostrarMensagem("Forma excluída com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_forma.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao excluir forma!");
        }
    }

    #Plano de contas
    //inserir plano
    public function inserir_plano($desc_plano)
    {
        //instanciar a classe forma
        $objPlano = new Plano();
        //invocar o método
        if ($objPlano->inserirPlano($desc_plano) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            $resultado = $objPlano->consultarPlano(null);
            //incluir a view
            include_once 'view/consultar_plano.php';
            //mostrar mensagem
            $this->mostrarMensagem("Plano de contas inserido com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_plano.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao inserir plano de contas!");
        }
    }

    //consultar plano
    public function consultar_plano($desc_plano)
    {
        //instanciar a classe plano
        $objPlano = new Plano();
        //invocar o método
        if ($objPlano->consultarPlano($desc_plano) == false) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_plano.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao consultar plano de contas!");
        } else {
            //iniciar sessao
            session_start();
            //resultado da consulta
            $resultado = $objPlano->consultarPlano($desc_plano);
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_plano.php';
        }
    }

    //alterar forma
    public function alterar_plano($id_cad_plano, $desc_plano)
    {
        //instanciar a classe plano
        $objPlano = new Plano();
        //invocar o método
        if ($objPlano->alterarPlano($id_cad_plano, $desc_plano) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_plano.php';
            //mostrar mensagem
            $this->mostrarMensagem("Plano de contas alterado com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_plano.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao alterar plano de contas!");
        }
    }

    //excluir plano
    public function excluir_plano($id_cad_plano)
    {
        //instanciar a classe Plano
        $objPlano = new Plano();
        //invocar o método
        if ($objPlano->excluirPlano($id_cad_plano) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_plano.php';
            //mostrar mensagem
            $this->mostrarMensagem("Plano de contas excluído com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_plano.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao excluir plano de contas!");
        }
    }

    #Banco
    //inserir Banco
    public function inserir_banco($nome_banco, $num_agencia, $num_conta)
    {
        //instanciar a classe Autor
        $objBanco = new Banco();
        //invocar o método
        if ($objBanco->inserirBanco($nome_banco, $num_agencia, $num_conta) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            // $resultado = $objBanco->consultarBanco(null);
            //incluir a view
            include_once 'view/consultar_banco.php';
            //mostrar mensagem
            $this->mostrarMensagem("Banco inserido com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_banco.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao inserir banco!");
        }
    }

    //consultar banco
    public function consultar_banco($nome_banco)
    {
        //instanciar a classe Autor
        $objBanco = new Banco();
        //invocar o método
        if ($objBanco->consultarBanco($nome_banco) == false) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_banco.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao consultar banco!");
        } else {
            //iniciar sessao
            session_start();
            //resultado da consulta
            $resultado = $objBanco->consultarBanco($nome_banco);
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_banco.php';
        }
    }

    //alterar banco
    public function alterar_banco($id_cad_banco, $nome_banco, $num_agencia, $num_conta)
    {
        //instanciar a classe plano
        $objBanco = new Banco();
        //invocar o método
        if ($objBanco->alterarBanco($id_cad_banco, $nome_banco, $num_agencia, $num_conta) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_banco.php';
            //mostrar mensagem
            $this->mostrarMensagem("Banco alterado com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_banco.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao alterar Banco!");
        }
    }

    //excluir plano
    public function excluir_banco($id_cad_banco)
    {
        //instanciar a classe Plano
        $objBanco = new Banco();
        //invocar o método
        if ($objBanco->excluirBanco($id_cad_banco) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_banco.php';
            //mostrar mensagem
            $this->mostrarMensagem("Banco excluído com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_banco.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao excluir Banco!");
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

    public function modal_excluir_cartao($id_cad_cartao, $nome_cartao)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="excluir_cartao' . $id_cad_cartao . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Excluir Cartão</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '  <div class="modal-body">';
        echo $nome_cartao;
        echo '  </div>';
        echo '<form method="post" action="index.php">';
        echo ' <div class="modal-footer">';
        echo '    <input type="hidden" name="id_cad_cartao" value="' . $id_cad_cartao . '">';
        echo '    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="excluir_cartao" class="btn btn-danger">Excluir</button>';
        echo ' </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function modal_alterar_cartao($id_cad_cartao, $nome_cartao)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="alterar_cartao' . $id_cad_cartao . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Alterar Cartão</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '<form method="post" action="index.php">';
        echo '  <div class="modal-body">';
        echo '     <input type="text" class="form-control" name="nome_cartao" value="' . $nome_cartao . '">';
        echo '  </div>';
        echo '  <div class="modal-footer">';
        echo '    <input type="hidden" name="id_cad_cartao" value="' . $id_cad_cartao . '">';
        echo '    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="alterar_cartao" class="btn btn-primary">Alterar</button>';
        echo '  </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function modal_excluir_bandeira($id_cad_band, $nome_band)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="excluir_bandeira' . $id_cad_band . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Excluir Bandeira</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '  <div class="modal-body">';
        echo $nome_band;
        echo '  </div>';
        echo '<form method="post" action="index.php">';
        echo ' <div class="modal-footer">';
        echo '    <input type="hidden" name="id_cad_band" value="' . $id_cad_band . '">';
        echo '    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="excluir_bandeira" class="btn btn-danger">Excluir</button>';
        echo ' </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function modal_alterar_bandeira($id_cad_band, $nome_band)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="alterar_bandeira' . $id_cad_band . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Alterar Bandeira</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '<form method="post" action="index.php">';
        echo '  <div class="modal-body">';
        echo '     <input type="text" class="form-control" name="nome_band" value="' . $nome_band . '">';
        echo '  </div>';
        echo '  <div class="modal-footer">';
        echo '    <input type="hidden" name="id_cad_band" value="' . $id_cad_band . '">';
        echo '    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="alterar_bandeira" class="btn btn-primary">Alterar</button>';
        echo '  </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    //select de bandeira
    public function selectBandeira()
    {
        //instanciar a classe Bandeira
        $objBandeira = new Bandeira();
        //invocar o método
        $resultado = $objBandeira->consultarBandeira(null);
        //montar o select dinamicamente
        echo '<label for="id_cad_band" class="form-label">Bandeira do cartão:</label>';
        echo '<select name="id_cad_band" class="form-select" aria-label="Default select example" required>';
        echo '    <option value="" selected>Selecione a bandeira do cartão</option>';
        foreach ($resultado as $key => $valor) {
            echo '<option value="' . $valor->id_cad_band . '">' . $valor->nome_band . '</option>';
        }
        echo '</select>';
    }

    //select de plano
    public function selectPlano()
    {
        //instanciar a classe Plano
        $objPlano = new Plano();
        //invocar o método
        $resultado = $objPlano->consultarPlano(null);
        //montar o select dinamicamente
        echo '<label for="id_cad_plano" class="form-label">Plano de contas:</label>';
        echo '<select name="id_cad_plano" class="form-select" aria-label="Default select example" required>';
        echo '    <option value="" selected>Selecione o plano de contas</option>';
        foreach ($resultado as $key => $valor) {
            echo '<option value="' . $valor->id_cad_plano . '">' . $valor->desc_plano . '</option>';
        }
        echo '</select>';
    }

    //select de forma
    public function selectForma()
    {
        //instanciar a classe Forma
        $objForma = new Forma();
        //invocar o método
        $resultado = $objForma->consultarForma(null);
        //montar o select dinamicamente
        echo '<label for="id_cad_forma" class="form-label">Forma de Rec/Pag:</label>';
        echo '<select name="id_cad_forma" class="form-select" aria-label="Default select example" required>';
        echo '    <option value="" selected>Selecione a forma de rec/pag</option>';
        foreach ($resultado as $key => $valor) {
            echo '<option value="' . $valor->id_cad_forma . '">' . $valor->desc_forma . '</option>';
        }
        echo '</select>';
    }

    //select de tipo
    public function selectTipo()
    {
        //instanciar a classe Tipo
        $objTipo = new Tipo();
        //invocar o método
        $resultado = $objTipo->consultarTipo(null);
        //montar o select dinamicamente
        echo '<label for="id_cad_tipo" class="form-label">Tipo:</label>';
        echo '<select name="id_cad_tipo" class="form-select" aria-label="Default select example" required>';
        echo '    <option value="" selected>Selecione o tipo</option>';
        foreach ($resultado as $key => $valor) {
            echo '<option value="' . $valor->id_cad_tipo . '">' . $valor->desc_tipo . '</option>';
        }
        echo '</select>';
    }

    //select de banco
    public function selectBanco()
    {
        //instanciar a classe Banco
        $objBanco = new Banco();
        //invocar o método
        $resultado = $objBanco->consultarBanco(null);
        //montar o select dinamicamente
        echo '<label for="id_cad_banco" class="form-label">Banco:</label>';
        echo '<select name="id_cad_banco" class="form-select" aria-label="Default select example" required>';
        echo '    <option value="" selected>Selecione o banco</option>';
        foreach ($resultado as $key => $valor) {
            echo '<option value="' . $valor->id_cad_banco . '">' . $valor->nome_banco . '</option>';
        }
        echo '</select>';
    }

    //select de cartão
    public function selectCartao()
    {
        //instanciar a classe Cartao
        $objCartao = new Cartao();
        //invocar o método
        $resultado = $objCartao->consultarCartao(null);
        //montar o select dinamicamente
        echo '<label for="id_cad_cartao" class="form-label">Cartão:</label>';
        echo '<select name="id_cad_cartao" class="form-select" aria-label="Default select example" required>';
        echo '    <option value="" selected>Selecione o cartão</option>';
        foreach ($resultado as $key => $valor) {
            echo '<option value="' . $valor->id_cad_cartao . '">' . $valor->nome_cartao . '</option>';
        }
        echo '</select>';
    }

    public function modal_alterar_forma($id_cad_forma, $desc_forma)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="alterar_forma' . $id_cad_forma . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Alterar Forma</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '<form method="post" action="index.php">';
        echo '  <div class="modal-body">';
        echo '     <input type="text" class="form-control" name="desc_forma" value="' . $desc_forma . '">';
        echo '  </div>';
        echo '  <div class="modal-footer">';
        echo '    <input type="hidden" name="id_cad_forma" value="' . $id_cad_forma . '">';
        echo '    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="alterar_forma" class="btn btn-primary">Alterar</button>';
        echo '  </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function modal_excluir_forma($id_cad_forma, $desc_forma)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="excluir_forma' . $id_cad_forma . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Excluir Forma</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '  <div class="modal-body">';
        echo $desc_forma;
        echo '  </div>';
        echo '<form method="post" action="index.php">';
        echo ' <div class="modal-footer">';
        echo '    <input type="hidden" name="id_cad_forma" value="' . $id_cad_forma . '">';
        echo '    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="excluir_forma" class="btn btn-danger">Excluir</button>';
        echo ' </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function modal_alterar_plano($id_cad_plano, $desc_plano)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="alterar_plano' . $id_cad_plano . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Alterar Plano</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '<form method="post" action="index.php">';
        echo '  <div class="modal-body">';
        echo '     <input type="text" class="form-control" name="desc_plano" value="' . $desc_plano . '">';
        echo '  </div>';
        echo '  <div class="modal-footer">';
        echo '    <input type="hidden" name="id_cad_plano" value="' . $id_cad_plano . '">';
        echo '    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="alterar_plano" class="btn btn-primary">Alterar</button>';
        echo '  </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function modal_excluir_plano($id_cad_plano, $desc_plano)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="excluir_plano' . $id_cad_plano . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Excluir Plano</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '  <div class="modal-body">';
        echo $desc_plano;
        echo '  </div>';
        echo '<form method="post" action="index.php">';
        echo ' <div class="modal-footer">';
        echo '    <input type="hidden" name="id_cad_plano" value="' . $id_cad_plano . '">';
        echo '    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="excluir_plano" class="btn btn-danger">Excluir</button>';
        echo ' </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function modal_alterar_banco($id_cad_banco, $nome_banco, $num_agencia, $num_conta)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="alterar_banco' . $id_cad_banco . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Alterar Banco</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '<form method="post" action="index.php">';
        echo '  <div class="modal-body">';
        echo '     <label for="nome_banco" class="form-label">Banco:</label>';
        echo '     <input type="text" class="form-control" name="nome_banco" value="' . $nome_banco . '">';
        echo '     <label for="num_agencia" class="form-label">Agência:</label>';
        echo '     <input type="text" class="form-control" name="num_agencia" value="' . $num_agencia . '">';
        echo '     <label for="num_conta" class="form-label">Conta:</label>';
        echo '     <input type="text" class="form-control" name="num_conta" value="' . $num_conta . '">';
        echo '  </div>';
        echo '  <div class="modal-footer">';
        echo '    <input type="hidden" name="id_cad_banco" value="' . $id_cad_banco . '">';
        echo '    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="alterar_banco" class="btn btn-primary">Alterar</button>';
        echo '  </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function modal_excluir_banco($id_cad_banco, $nome_banco)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="excluir_banco' . $id_cad_banco . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Excluir Banco</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '  <div class="modal-body">';
        echo $nome_banco;
        echo '  </div>';
        echo '<form method="post" action="index.php">';
        echo ' <div class="modal-footer">';
        echo '    <input type="hidden" name="id_cad_banco" value="' . $id_cad_banco . '">';
        echo '    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="excluir_banco" class="btn btn-danger">Excluir</button>';
        echo ' </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
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
