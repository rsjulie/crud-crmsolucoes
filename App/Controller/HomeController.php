<?php
class HomeController
{
    public function index()
    {
        try {
            $listas = Lista::selectAll();

            $loader = new \Twig\Loader\FilesystemLoader('App/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('home.html');

            $parameters = array();
            $parameters['listas'] = $listas;
            $content = $template->render($parameters);
            echo $content;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function insert()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            Lista::create($_POST['titulo'], $_POST['descricao']);
        }
    }

    public function update()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            Lista::update($_POST['titulo'], $_POST['descricao'], $_POST['id']);
        }
    }

    public function delete()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            Lista::delete($_POST['id']);
        }
    }
}
