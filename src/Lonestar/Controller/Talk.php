<?php

namespace Lonestar\Controller;

use League\Fractal;
use Lonestar\Serializer\NoRootArray as NoRootArraySerializer;
use Lonestar\Transformer\Talk as TalkTransformer;
use Lonestar\Transformer\Speaker as SpeakerTransformer;

class Talk extends \SlimController\SlimController
{
    public function indexAction()
    {
        $manager = (new Fractal\Manager)
            ->setSerializer(new NoRootArraySerializer)
            ->parseIncludes(['speakers']);

        $talkMapper = $this->app->spot->mapper('Lonestar\Entity\Talk');
        $results = $talkMapper->all()
            ->with(['speakers'])
            ->order(['title' => 'ASC']);
        $talks = new Fractal\Resource\Collection($results, new TalkTransformer);

        $this->render(200, $manager->createData($talks)->toArray());
    }

    public function showAction($id)
    {
      $manager = (new Fractal\Manager)
          ->setSerializer(new NoRootArraySerializer)
          ->parseIncludes(['speakers']);

        $talkMapper = $this->app->spot->mapper('Lonestar\Entity\Talk');
        $results = $talkMapper->all()
            ->where(['id' => (int) $id])
            ->with(['speakers'])
            ->first();

        $talk = new Fractal\Resource\Item($results, new TalkTransformer);

        $this->render(200, $manager->createData($talk)->toArray());
    }

    public function speakersAction($id)
    {
        $manager = (new Fractal\Manager)
            ->setSerializer(new NoRootArraySerializer);

        $talkMapper = $this->app->spot->mapper('Lonestar\Entity\Talk');
        $talk = $talkMapper->all()
            ->with(['speakers'])
            ->where(['id' => (int) $id])
            ->first();

        $speakers = new Fractal\Resource\Collection($talk->speakers, new SpeakerTransformer);

        $this->render(200, $manager->createData($speakers)->toArray());
    }
}
