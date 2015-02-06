<?php

namespace Lonestar\Controller;

class Speaker extends \SlimController\SlimController
{
    public function indexAction()
    {
        $speakerMapper = $this->app->spot->mapper('Lonestar\Entity\Speaker');
        $speakers = $speakerMapper->all()
            ->with(['talks'])
            ->order(['last_name' => 'ASC']);

        $results = [];
        foreach ($speakers as $id => $speaker) {
            $results[$id] = $speaker->toArray();
            $results[$id]['talks'] = $speaker->talks->toArray();
        }

        $this->render(200, $results);
    }

    public function showAction($id)
    {
        $speakerMapper = $this->app->spot->mapper('Lonestar\Entity\Speaker');

        $results = $speakerMapper->all()
            ->where(['id' => (int) $id])
            ->toArray();

        $this->render(200, $results);
    }

    public function talksAction($id)
    {
        $talkMapper = $this->app->spot->mapper('Lonestar\Entity\Talk');
        $results = $talkMapper->all()
            ->where(['speaker_id' => (int) $id])
            ->toArray();

        $this->render(200, $results);
    }

    public function createAction()
    {
        throw new \Exception('Not currently impelmented');
    }
}