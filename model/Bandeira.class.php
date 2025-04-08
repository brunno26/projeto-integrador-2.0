<?php
//incluir classe conexao
include_once 'Conexao.class.php';

//classe Bandeira
class Bandeira extends Conexao
{
    //atributos
    private $id_bandeira;
    private $nome_bandeira;

    //getters e setters
    public function getIdBandeira()
    {
        return $this->id_bandeira;
    }

    public function setIdBandeira($id_bandeira)
    {
        $this->id_bandeira = $id_bandeira;
    }

    public function getNomeBandeira()
    {
        return $this->nome_bandeira;
    }

    public function setNomeBandeira($nome_bandeira)
    {
        $this->nome_bandeira = $nome_bandeira;
    }

    //método inserir Bandeira
    public function inserirBandeira($nome_bandeira)
    {
        //setar os atributos
        $this->setNomeBandeira($nome_bandeira);

        //montar query
        $sql = "INSERT INTO tb_cad_bandeira (id_cad_band, nome_band) VALUES (NULL, :nome_bandeira)";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            $query->bindValue(':nome_bandeira', $this->getNomeBandeira(), PDO::PARAM_STR);
            //excutar a query
            $query->execute();
            //retorna o resultado
            //print "Inserido";
            return true;

        } catch (PDOException $e) {
            //print "Erro ao inserir";
            return false;
        }
    }

    //metodo consultar bandeira
    public function consultarBandeira($nome_bandeira)
    {
        //setar os atributos
        $this->setNomeBandeira($nome_bandeira);

        //montar query
        $sql = "SELECT * FROM tb_cad_bandeira where true ";

        //vericar se o nome é nulo
        if ($this->getNomeBandeira() != null) {
            $sql .= " and nome_band like :nome_bandeira";
        }

        //ordenar a tabela
        $sql .= " order by nome_band ";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            if ($this->getNomeBandeira() != null) {
                $this->setNomeBandeira("%" . $nome_bandeira . "%");
                $query->bindValue(':nome_bandeira', $this->getNomeBandeira(), PDO::PARAM_STR);
            }
            //excutar a query
            $query->execute();
            //retorna o resultado
            $resultado = $query->fetchAll(PDO::FETCH_OBJ);
            return $resultado;

        } catch (PDOException $e) {
            //print "Erro ao consultar";
            return false;
        }

    }

    //método alterar bandeira
    public function alterarBandeira($id_cad_band, $nome_band)
    {
        //setar os atributos
        $this->setIdBandeira($id_cad_band);
        $this->setNomeBandeira($nome_band);

        //montar query
        $sql = "UPDATE tb_cad_bandeira SET nome_band = :nome_bandeira WHERE id_cad_band = :id_cad_band";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            $query->bindValue(':id_cad_band', $this->getIdBandeira(), PDO::PARAM_INT);
            $query->bindValue(':nome_bandeira', $this->getNomeBandeira(), PDO::PARAM_STR);
            //excutar a query
            $query->execute();
            //retorna o resultado
            //print "Alterado";
            return true;

        } catch (PDOException $e) {
            //print "Erro ao alterar";
            return false;
        }
    }

    //método excluir bandeira
    public function excluirBandeira($id_cad_band)
    {
        //setar os atributos
        $this->setIdBandeira($id_cad_band);

        //montar query
        $sql = "DELETE FROM tb_cad_bandeira WHERE id_cad_band = :id_cad_band";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blindagem dos dados
            $query->bindValue(':id_cad_band', $this->getIdBandeira(), PDO::PARAM_INT);
            //excutar a query
            $query->execute();
            //retorna o resultado
            print "Excluido";
            return true;

        } catch (PDOException $e) {
            // print "Erro ao excluir: " . $e->getMessage();
            return false;
        }
    }

}

// //testar a classe
// $objEditora = new Editora();
// //inserir
// //$objEditora->inserirEditora('Maria Vai com as Outras');
// //consultar
// //$Editoraes = $objEditora->consultarEditora('');
// //alterar
// //$objEditora->alterarEditora(1, "Pedro Dev");
// //excluir
// $objEditora->excluirEditora(12);

// //mostrar dados
// foreach ($Editoraes as $key => $valor) {
//     print "id = {$valor->id_editora} / nome = {$valor->nome}";
//     print "<br>";
// }

// // //tabela
// // print '<table border="1">';
// // print '  <tr>';
// // print '   <td>ID</td>';
// // print '   <td>Nome</td>';
// // print '  </tr>';
// // foreach ($Editoraes as $key => $valor) {
// //     print '  <tr>';
// //     print '   <td>' . $valor->id_editora . '</td>';
// //     print '   <td>' . $valor->nome . '</td>';
// //     print '  </tr>';
// // }
// // print '</table>';

// //select
// print '<select name="nome_editora">';
// foreach ($Editoraes as $key => $valor) {
//     print '<option value="' . $valor->id_editora . '">' . $valor->nome . '</option>';
// }
// print '</select>';
