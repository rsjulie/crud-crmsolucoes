<?php
class Lista
{
    private $conn;
    private $table_name = "lista_tarefas";

    public $id;
    public $username;
    public $password;

    public function __construct($db){
        $this->conn = $db;

        $create_table = "
            CREATE TABLE IF NOT EXISTS " . $this->table_name . " (
                id INT AUTO_INCREMENT PRIMARY KEY,
                titulo VARCHAR(255) NOT NULL,
                descricao VARCHAR(255) NOT NULL
            );
        ";
        $this->conn->exec($create_table);
    }

    public function selectAll()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $sql = $this->conn->prepare($query);
        $sql->execute();

        $result = array();

        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        };

        return $result;
        // return array();
    }

    public function create($titulo, $descricao)
    {
        try {
            $query = "INSERT INTO " . $this->table_name . " (titulo, descricao) VALUES (:titulo, :descricao)";
            $sql = $this->conn->prepare($query);
            $sql->bindValue(':titulo', $titulo);
            $sql->bindValue(':descricao', $descricao);
            $sql->execute();
        }
        catch(Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }

    public function update($titulo, $descricao, $id)
    {
        try{
            $query = "UPDATE " . $this->table_name . " SET titulo = :titulo, descricao = :descricao WHERE id = :id";
            var_dump($query);
            $sql = $this->conn->prepare($query);
            $sql->bindValue(':titulo', $titulo);
            $sql->bindValue(':descricao', $descricao);
            $sql->bindValue(':id', $id);
            $sql->execute();
        }
        catch(Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }

    public function delete($id)
    {
        try{
            $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
            $sql = $this->conn->prepare($query);
            $sql->bindValue(':id', $id);
            $sql->execute();
        }
        catch(Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
}
