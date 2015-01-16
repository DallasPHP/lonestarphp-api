<?php

namespace Lonestar\Controller;

class Talk extends \SlimController\SlimController
{
    public function indexAction()
    {
        $talkMapper = $this->app->spot->mapper('Lonestar\Entity\Talk');
        $talks = $talkMapper->all()
            ->with(['speaker'])
            ->order(['title' => 'ASC']);

        $results = [];
        foreach ($talks as $id => $talk) {
            $results[$id] = $talk->toArray();
            $results[$id]['speaker'] = $talk->speaker->toArray();
        }

        $this->render(200, $results);
    }

    public function showAction($id)
    {
        $talkMapper = $this->app->spot->mapper('Lonestar\Entity\Talk');
        $talk = $talkMapper->all()
            ->where(['id' => (int) $id])
            ->with(['speaker'])
            ->first();

        $this->render(200, $talk->toArray());
    }

    public function speakerAction($id)
    {
        $talkMapper = $this->app->spot->mapper('Lonestar\Entity\Talk');
        $talk = $talkMapper->all()
            ->where(['id' => (int) $id])
            ->with(['speaker'])
            ->first();

        $this->render(200, $talk->speaker->toArray());
    }
}