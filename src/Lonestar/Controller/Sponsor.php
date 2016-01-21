<?php

namespace Lonestar\Controller;

use League\Fractal;
use Lonestar\Serializer\NoRootArray as NoRootArraySerializer;
use Lonestar\Transformer\Sponsor as SponsorTransformer;

class Sponsor extends \SlimController\SlimController
{
    /**
     * List of sponsors
     */
    public function indexAction()
    {
        $manager = (new Fractal\Manager)
            ->setSerializer(new NoRootArraySerializer);

        $sponsorMapper = $this->app->spot->mapper('Lonestar\Entity\Sponsor');
        $results = $sponsorMapper->all()
            ->order(['sponsor_level' => 'DESC', 'created_at' => 'ASC']);

        $sponsors = new Fractal\Resource\Collection($results, new SponsorTransformer);

        $this->render(200, $manager->createData($sponsors)->toArray());
    }

    /**
     * Show sponsor details
     * @param  integer $id Sponsor ID
     */
    public function showAction($id)
    {
        $manager = (new Fractal\Manager)
            ->setSerializer(new NoRootArraySerializer);

        $sponsorMapper = $this->app->spot->mapper('Lonestar\Entity\Sponsor');
        $results = $sponsorMapper->all()
            ->where(['id' => (int) $id])
            ->first();

        $sponsor = new Fractal\Resource\Item($results, new SponsorTransformer);

        $this->render(200, $manager->createData($sponsor)->toArray());
    }
}
