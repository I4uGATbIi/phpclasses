<?php

namespace Bank\Controllers;
use Bank\Services\DiContainer;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class NotFound implements \Bank\Services\ControllerInterface
{
    public function execute($request, $response)
    {
        $loader = DiContainer::getInstance()->get(FilesystemLoader::class);
        $twig = DiContainer::getInstance()->get(Environment::class);
        $template = $twig->load('noresults.html');
        echo $template->display();
    }
}