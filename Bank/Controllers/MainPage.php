<?php

namespace Bank\Controllers;

use Bank\Services\ControllerInterface;
use Bank\Services\DiContainer;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class MainPage implements ControllerInterface
{
    public function execute($request, $response)
    {


        $twig = DiContainer::getInstance()->get(Environment::class);
        $template = $twig->load('index.html');
        return $template->display();
    }
}