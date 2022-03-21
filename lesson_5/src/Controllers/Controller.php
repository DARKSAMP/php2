<?php

namespace MyApp\Controllers;

use MyApp\App;
use MyApp\Auth;
use MyApp\Basket;

class Controller
{
    private $twig;

    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader(App::getInstance()->getConfig()['templates']);
        $this->twig = new \Twig\Environment($loader);
    }

    protected function redirect($url = null)
    {
        if( null === $url){
            $url = $_SERVER['REQUEST_URI'];
        }

        header('Location: ' . $url);
        exit;
    }

    protected function render($templates, $data = [])
    {
        $data['_user'] = Auth::getUser();
        $data['_basket'] = Basket::get();

        echo $this->twig->render($templates, $data);
    }
}