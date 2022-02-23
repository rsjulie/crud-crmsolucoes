<?php
class Lista
{
    public static function selectAll()
    {
        $con = Connection::getConn();
        $sql = "SELECT * FROM lista_tarefas";
        $sql = $con->prepare($sql);
        $sql->execute();

        $result = array();

        while ($row = $sql->fetchObject('Lista')) {
            $result[] = $row;
        };

        return $result;
    }

    public static function create($titulo, $descricao)
    {
        $con = Connection::getConn();
        $sql = "INSERT INTO lista_tarefas (titulo, descricao) VALUES (:titulo, :descricao)";
        $sql = $con->prepare($sql);
        $sql->bindValue(':titulo', $titulo);
        $sql->bindValue(':descricao', $descricao);
        $sql->execute();
    }

    public static function update($titulo, $descricao, $id)
    {
        $con = Connection::getConn();
        $sql = "UPDATE lista_tarefas SET titulo = :titulo, descricao = :descricao WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':titulo', $titulo);
        $sql->bindValue(':descricao', $descricao);
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public static function delete($id)
    {
        $con = Connection::getConn();
        $sql = "DELETE FROM lista_tarefas WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();
    }
}
