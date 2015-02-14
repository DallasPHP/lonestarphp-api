<?php

namespace Lonestar\Controller;

class Talk extends \SlimController\SlimController
{
    public function indexAction()
    {
        $talkMapper = $this->app->spot->mapper('Lonestar\Entity\Talk');
        $talks = $talkMapper->all()
            ->with(['speakers'])
            ->order(['title' => 'ASC']);

        $results = [];
        foreach ($talks as $id => $talk) {
            $results[$id] = $talk->toArray();
            $results[$id]['speakers'] = $talk->speakers->toArray();
        }

        $this->render(200, $results);
    }

    public function showAction($id)
    {
        $talkMapper = $this->app->spot->mapper('Lonestar\Entity\Talk');
        $talk = $talkMapper->all()
            ->where(['id' => (int) $id])
            ->with(['speakers'])
            ->first();

        $this->render(200, $talk->toArray());
    }

    public function speakerAction($id)
    {
        $talkMapper = $this->app->spot->mapper('Lonestar\Entity\Talk');
        $talk = $talkMapper->all()
            ->where(['id' => (int) $id])
            ->with(['speakers'])
            ->first();

        $this->render(200, $talk->speakers->toArray());
    }
}