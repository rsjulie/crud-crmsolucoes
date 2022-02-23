<?php
class HomeController
{
    public $model;

    public function __construct()
    {
        $database = new Connection();
        $this->model = new Lista($database->getConn());
    }

    public function index()
    {
        try {
            $lista = $this->model->selectAll();

            $loader = new \Twig\Loader\FilesystemLoader('App/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('home.html');

            $parameters = array();
            $parameters['listas'] = $lista;
            $content = $template->render($parameters);
            echo $content;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function insert()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->model->create($_POST['titulo'], $_POST['descricao']);
        }
    }

    public function update()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->model->update($_POST['titulo'], $_POST['descricao'], $_POST['id']);
        }
    }

    public function delete()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->model->delete($_POST['id']);
        }
    }
}
