<?php

namespace Lonestar\Controller;

class Talk extends \SlimController\SlimController
{
    public function indexAction()
    {
        $this->render(200, ['message' => 'index']);
    }

    public function showAction($id)
    {
        $this->render(200, ['message' => 'show']);
    }

    public function speakerAction($id)
    {
        $this->render(200, ['message' => 'speaker']);
    }
}