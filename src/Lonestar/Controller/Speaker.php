<?php

namespace Lonestar\Controller;

use League\Fractal;
use Lonestar\Serializer\NoRootArray as NoRootArraySerializer;
use Lonestar\Transformer\Talk as TalkTransformer;
use Lonestar\Transformer\Speaker as SpeakerTransformer;

class Speaker extends \SlimController\SlimController
{
    public function indexAction()
    {
        $manager = (new Fractal\Manager)
            ->setSerializer(new NoRootArraySerializer)
            ->parseIncludes(['talks']);

        $speakerMapper = $this->app->spot->mapper('Lonestar\Entity\Speaker');
        $results = $speakerMapper->all()
            ->with(['talks'])
            ->order(['last_name' => 'ASC']);
        $speakers = new Fractal\Resource\Collection($results, new SpeakerTransformer);

        $this->render(200, $manager->createData($speakers)->toArray());
    }

    public function showAction($id)
    {
        $manager = (new Fractal\Manager)
            ->setSerializer(new NoRootArraySerializer)
            ->parseIncludes(['talks']);

        $speakerMapper = $this->app->spot->mapper('Lonestar\Entity\Speaker');

        $results = $speakerMapper->all()
            ->where(['id' => (int) $id])
            ->first();
        $speaker = new Fractal\Resource\Item($results, new SpeakerTransformer);

        $this->render(200, $manager->createData($speaker)->toArray());
    }

    public function talksAction($id)
    {
        $manager = (new Fractal\Manager)
            ->setSerializer(new NoRootArraySerializer);

        $talkMapper = $this->app->spot->mapper('Lonestar\Entity\Speaker');
        $speaker = $talkMapper->all()
            ->where(['id' => (int) $id])
            ->first();
        $talks = new Fractal\Resource\Collection($speaker->talks, new TalkTransformer);

        $this->render(200, $manager->createData($talks)->toArray());
    }

    public function createAction()
    {
        throw new \Exception('Not currently impelmented');
    }
}
