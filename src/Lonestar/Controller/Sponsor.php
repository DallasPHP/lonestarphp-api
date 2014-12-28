<?php

namespace Lonestar\Controller;

class Sponsor extends \SlimController\SlimController
{

    /**
     * Mapping of sponsor level ID to sponsor level name
     * @var array
     */
    protected $sponsorLevelMap = [
        4 => 'platinum',
        3 => 'gold',
        2 => 'silver',
        1 => 'bronze',
        0 => 'community',
    ];

    /**
     * List of sponsors
     */
    public function indexAction()
    {
        $sponsorMapper = $this->app->spot->mapper('Lonestar\Entity\Sponsor');

        $results = $sponsorMapper->all()
            ->order(['sponsor_level' => 'DESC', 'created_at' => 'ASC'])
            ->toArray();

        $sponsors = array_map(function($row) {
            $row['sponsor_level'] = $this->getSponsorshipName($row['sponsor_level']);

            return $row;
        }, $results);

        $this->render(200, $sponsors);
    }

    /**
     * Show sponsor details
     * @param  integer $id Sponsor ID
     */
    public function showAction($id)
    {
        $sponsorMapper = $this->app->spot->mapper('Lonestar\Entity\Sponsor');

        $results = $sponsorMapper->all()
            ->where(['id' => (int) $id])
            ->toArray();

        $this->render(200, $results);
    }

    /**
     * Get the sponsorship name that corresponds with the sponsor level ID
     *
     * @param  integer $sponsorLevel Sponsor Level ID
     * @throws \InvalidArgumentException If sponsor level does not exist in sponsor level map
     * @return string
     */
    protected function getSponsorshipName($sponsorLevel)
    {
        if (!isset($this->sponsorLevelMap[$sponsorLevel])) {
            throw new \InvalidArgumentException('Unknown Sponsorship Level');
        }

        return $this->sponsorLevelMap[$sponsorLevel];
    }
}