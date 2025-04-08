<?php 
// incluir classe conexão
include_once 'Conexao.class.php';

// classe bandeira
class Banco extends Conexao
{
    // atributos
    private $id_cad_banco;
    private $nome_banco;
    private $num_agencia;
    private $num_conta;

    // getters & setters
    public function getIdCadBanco()
    {
        return $this->id_cad_banco;
    }

    public function setIdCadBanco($id_cad_banco)
    {
        $this->id_cad_banco = $id_cad_banco;
    }

    public function getNomeBanco()
    {
        return $this->nome_banco;
    }

    public function setNomeBanco($nome_banco)
    {
        $this->nome_banco = $nome_banco;
    }

    public function getNumAgencia()
    {
        return $this->num_agencia;
    }

    public function setNumAgencia($num_agencia)
    {
        $this->num_agencia = $num_agencia;
    }

    public function getNumConta()
    {
        return $this->num_conta;
    }

    public function setNumConta($num_conta)
    {
        $this->num_conta = $num_conta;
    }

     //método inserir Bandeira
     public function inserirBanco($nome_banco, $num_agencia, $num_conta)
     {
         //setar os atributos
         $this->setNomeBanco($nome_banco);
         $this->setNumAgencia($num_agencia);
         $this->setNumConta($num_conta);
 
         //montar query
         $sql = "INSERT INTO tb_cad_banco (id_cad_banco, nome_banco, num_agencia, num_conta) 
        VALUES (NULL, :nome_banco, :num_agencia, :num_conta)";
 
         //executa a query
         try {
             //conectar com o banco
             $bd = $this->conectar();
             //preparar o sql
             $query = $bd->prepare($sql);
             //blidagem dos dados
             $query->bindValue(':nome_banco', $this->getNomeBanco(), PDO::PARAM_STR);
             $query->bindValue(':num_agencia', $this->getNumAgencia(), PDO::PARAM_STR);
             $query->bindValue(':num_conta', $this->getNumConta(), PDO::PARAM_STR);
             
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
}
?>