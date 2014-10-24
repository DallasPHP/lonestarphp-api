<?php

namespace Lonestar\Controller;

class Sponsor extends \SlimController\SlimController
{
    public function indexAction()
    {
        $this->render(200, ['message' => 'index']);
    }

    public function showAction($id)
    {
        $this->render(200, ['message' => 'show']);
    }
}