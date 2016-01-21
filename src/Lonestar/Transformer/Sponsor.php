<?php
namespace Lonestar\Transformer;

use Lonestar\Entity\Sponsor as SponsorEntity;
use League\Fractal\TransformerAbstract;

class Sponsor extends TransformerAbstract
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
     * Turn this item object into a generic array
     *
     * @param Lonestar\Entity\Sponsor $sponsor sponsor entity
     * @return array
     */
    public function transform(SponsorEntity $sponsor)
    {
        return [
            'id'            => (int) $sponsor->id,
            'name'          => $sponsor->name,
            'url'           => $sponsor->url,
            'sponsor_level' => $this->getSponsorshipName($sponsor->sponsor_level),
            'description'   => $sponsor->description,
            'logo_path'     => $sponsor->logo_path,
        ];
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
