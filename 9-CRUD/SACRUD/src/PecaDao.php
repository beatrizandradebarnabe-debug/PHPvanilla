<?php
declare(strict_types=1);

//Camada de acesso a dados (Data Access Object) para a entidade Peças.
//esta Camada é responsável por encapsular toda a lógica de acesso ao banco de dados para a entidade Peças, fornecendo métodos para realizar operações CRUD (Create, Read, Update, Delete) de forma organizada e reutilizável.

final class PecaDao {
    //atributos da classe 
    private PDO $pdo;

    //método da classe 
    //construtor -> é o método que permite criar objetos desta classe 

    public function __construct(PDO $pdo) {
        // ao chamar o construtor, o objeto PDO é passado como parâmetro e atribuído ao atributo $pdo da classe PecaDao.
        $this->pdo = $pdo;
    }

    //para criar um obj da classe PecaDao, é necessário passar um objeto PDO como argumento, que será usado para interagir com o banco de dados.

    // criar os métodos do CRUD 
    //READ -> listar todas as peças em ordem decrescente 
    public function listarTodos(): array {
        $sql = "SELECT * FROM pecas_industriais ORDER BY id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);//criar uma lista de produtos associando os valores ao nomes das colunas do banco de dados
    }
    
}